<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Department Controller
 *
 * @property \App\Model\Table\DepartmentTable $Department
 */
class DepartmentController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function index()
    {
        $this->paginate = array(
        'limit' => 10);
       // $department = $this->paginate($this->Department);
        $department = $this->paginate($this->Department->find('all',['conditions' => ['isdeleted' => '0']]));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('department','menuAry','headerAry'));
        $this->set('_serialize', ['department']);
    }

    /**
     * View method
     *
     * @param string|null $id Department id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $department = $this->Department->get($id, [
            'contain' => []
        ]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        //$this->set('department', $department,'layout',$layout);
        $this->set(compact('department','menuAry','headerAry'));
        $this->set('_serialize', ['department']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $department = $this->Department->newEntity();
        if ($this->request->is('post')) 
        {
            $check = $this->Department
                    ->find()
                    ->where(['departmentname' => $this->request->data('departmentname'),'isdeleted' => 0])
                    ->first();
            if($check == null)
            {
                $department = $this->Department->patchEntity($department, $this->request->data);
                if ($this->Department->save($department)) {
                    $this->Flash->success(__('The department has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }

            $this->Flash->error(__('Duplicated department could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;
        
        $this->set(compact('department','menuAry','headerAry'));
        $this->set('_serialize', ['department']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Department id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $department = $this->Department->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $check = $this->Department
                    ->find()
                    ->where(['departmentname' => $this->request->data('departmentname'),'id !=' => $id,'isdeleted' =>0])
                    ->first();
                    
            if($check == null)
            {
                $department = $this->Department->patchEntity($department, $this->request->data);

                if ($this->Department->save($department)) 
                    {
                        $this->Flash->success(__('The department has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    }
            }
            $this->Flash->error(__('Duplicated department could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;
        
        $this->set(compact('department','menuAry','headerAry'));
        $this->set('_serialize', ['department']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Department id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $department = $this->Department->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put','delete'])) 
        {
            $department = $this->Department->patchEntity($department, $this->request->data);
            $department->isdeleted = 1;
            if ($this->Department->save($department)) 
            {
                $this->Flash->success(__('The department has been deleted.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The department could not be deleted. Please, try again.'));
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
                $this->Flash->error(__('Please Choose A CSV File To Upload.'));
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
                if($row[0] == 'departmentname') 
                {
                    continue;
                }

                //$emp = $this->Employee->get($row[0]);
                $dept = TableRegistry::get('Department');
                $departments = $dept->newEntity();

                $departments->departmentname = $row[0];  
                
                $dd = $this->Department
                    ->find()
                    ->where(['departmentname' => $row[0]])
                    ->first();

                if($dd == null)
                {
                    if($dept->save($departments))
                    {
                       /*echo "successfully inserted";*/
                    }
                }                
            }
            fclose($handle);
        }
       return $this->redirect(['action' => 'index']);
    }
}
