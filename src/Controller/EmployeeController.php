<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

/**
 * Employee Controller
 *
 * @property \App\Model\Table\EmployeeTable $Employee
 */
class EmployeeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */  
    var $helpers = array('Html', 'Form','Csv'); 

    public function index()
    {
        $this->paginate = array(
        'limit' => 10);
        $employee = $this->paginate($this->Employee->find('all',['conditions' => ['Employee.isdeleted' => '0']])->contain(['rank','department','jobposition']));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('employee','menuAry','headerAry'));
        $this->set('_serialize', ['employee']);
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Users = TableRegistry::get('Users');

        $employee = $this->Employee->get($id, [
            'contain' => []
        ]);

        $department = $this->Employee->department->find('list', array('fields' => array('id', 'departmentname')));
        $rank = $this->Employee->rank->find('list', array('fields' => array('id', 'rank')));
        $jobposition = $this->Employee->jobposition->find('list', array('fields' => array('id', 'jobtitle')));
        $userlist = $this->Users->find('list');
        
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('department','rank','jobposition','employee','userlist','headerAry','menuAry'));
        $this->set('_serialize',['department','rank','jobposition','employee','userlist']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Users = TableRegistry::get('Users');

        $employee = $this->Employee->newEntity();

        if ($this->request->is('post')) 
        {
           //chek that employee is existing or not,,
            $check = $this->Employee
                    ->find()
                    ->where(['name' => $this->request->data('name'),'departmentid' => $this->request->data('departmentid'),'rankid' => $this->request->data('rankid'),'isdeleted' =>0])
                    ->first();            
         
            if($check == null)
            {
                $employee = $this->Employee->patchEntity($employee, $this->request->data);
                if ($this->Employee->save($employee)) 
                {
                    $this->Flash->success(__('The employee has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('Employee could not be saved. Please, try again.'));
        }
        
        $department = $this->Employee->department->find('list', array('fields' => array('id', 'departmentname')));
        $rank = $this->Employee->rank->find('list', array('fields' => array('id', 'rank')));
        $jobposition = $this->Employee->jobposition->find('list', array('fields' => array('id', 'jobtitle')));
        $userlist = $this->Users->find('list');

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('employee','department','rank','jobposition','userlist','menuAry','headerAry'));
        $this->set('_serialize', ['employee','department','rank','jobposition','userlist']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
       // echo "$id";
        $this->Users = TableRegistry::get('Users');

        $employee = $this->Employee->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $check = $this->Employee
                    ->find()
                    ->where(['name' => $this->request->data('name'),'departmentid' => $this->request->data('departmentid'),'rankid' => $this->request->data('rankid'),'isdeleted' =>0,'id !='=> $id])
                    ->first();

            if($check == null)
            { 
                $employee = $this->Employee->patchEntity($employee, $this->request->data);
                if ($this->Employee->save($employee)) 
                {
                    $this->Flash->success(__('The employee has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }

            $this->Flash->error(__('Employee could not be saved. Please, try again.'));
        }

        $department = $this->Employee->department->find('list', array('fields' => array('id', 'departmentname')));
        $rank = $this->Employee->rank->find('list', array('fields' => array('id', 'rank')));
        $jobposition = $this->Employee->jobposition->find('list', array('fields' => array('id', 'jobtitle')));
        $userlist = $this->Users->find('list');
       
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;
        
        $this->set(compact('employee','department','rank','jobposition','userlist','menuAry','headerAry'));
        $this->set('_serialize', ['employee','department','rank','userlist','jobposition']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $employee = $this->Employee->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put','delete'])) 
        {
            $employee = $this->Employee->patchEntity($employee, $this->request->data);
            $employee->isdeleted = 1;
            if ($this->Employee->save($employee)) 
            {
                $this->Flash->success(__('The employee has been deleted.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    //CSV excel file export 
    //excel format for date must be Y-m-d
    public function import() 
    {
        if(isset($this->request->data['csv']))
        {
            $data = $this->request->data['csv'];
            $file = $data['tmp_name'];   

            $filename = $data['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);                 

            if($file == null)
            {
                $this->Flash->error(__('Please Choose A File To Upload.'));
                return $this->redirect(['action' => 'index']);
            }
            if($fileExt2 != csv)
            {
                $this->Flash->error(__('Please Choose CSV File To Upload.'));
                return $this->redirect(['action' => 'index']);
            }

            $handle = fopen($file, "r");
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                if($row[0] == 'name') 
                {
                    continue;
                }

                //$emp = $this->Employee->get($row[0]);
                $emp = TableRegistry::get('Employee');
                $employees = $emp->newEntity();

                $employees->name = $row[0];
                $employees->fimalyname = $row[1];
                $employees->empoyeenumber = $row[2];
                $employees->socialsecuritynumber = $row[3];                
                $employees->departmentid = $row[4];
                $employees->jobpostionid = $row[5];
                $employees->rankid = $row[6];
                $employees->userid = $row[7];
                $employees->dateofbirth = $row[8];
                $employees->dateofemployment = $row[9];
                $employees->nrcnumber = $row[10];
                $employees->registered = $row[11];
                $employees->modified = $row[12];               

                $ee = $this->Employee
                    ->find()
                    ->where(['name' => $row[0],'departmentid' => $row[4],'rankid' => $row[6]])
                    ->first();

                if($ee == null )
                {                    
                    echo "Employee".json_encode($employees);
                    if($emp->save($employees))
                    {
                       // echo "successfully inserted";
                    }
                    else
                    {
                        echo "<br/> Error -> Employee".json_encode($employees);
                        die();
                    }
                }                
            }
            fclose($handle);
        }
       return $this->redirect(['action' => 'index']);
    }

    public function export()
    {
        $this->response->download('export.csv');
        $data = $this->Employee->find('all')->toArray();
        echo $data;
        $_serialize = 'data';
        $_header = ['ID', 'Name', 'Email'];
        $_extract = ['name', 'departmentid', 'jobpostionid'];
        $this->set(compact('data', '_serialize', '_header', '_extract'));
        $this->viewBuilder()->className('CsvView.Csv');
        return;
    }

    public function list()
    {
        $employee = $this->Employee->find('all')->contain(['rank','department','jobposition']);
        $util=new Utility();
        $empdata =  $util->GetJOSNForDataGrid($employee);
        echo $empdata;
        die();        
    }

    public function popup()
    {
        $employee = $this->Employee->find('all')->contain(['rank','department','jobposition']);
        $util=new Utility();
        $empdata =  $util->GetJOSNForDataGrid($employee);
        //echo "string".$empdata;
        $this->set(compact('empdata','employee'));
        $this->set('_serialize', ['empdata','employee']);
    }
}
