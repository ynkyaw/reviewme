<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Employeegroup Controller
 *
 * @property \App\Model\Table\EmployeegroupTable $Employeegroup
 */
class EmployeegroupController extends AppController
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

        //$employeegroup = $this->paginate($this->Employeegroup);
        $employeegroup = $this->paginate($this->Employeegroup->find('all',['conditions' => ['isdeleted' => '0']]));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('employeegroup','menuAry','headerAry'));
        $this->set('_serialize', ['employeegroup']);
    }

    /**
     * View method
     *
     * @param string|null $id Employeegroup id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Department = TableRegistry::get('Department');
        $this->Employee = TableRegistry::get('Employee');
        $this->EmployeeEmployeegroup = TableRegistry::get('EmployeeEmployeegroup');

        $employees= $this->Employee->find('all');
        $departments = $this->Department->find('all');
        $myReviewees = null;

        $util=new Utility();
        $yuistring =  $util->GetYUIString($departments,$employees);

        $employee = $this->Employee->find('list', ['limit' => 200]);

        $employeegroup = $this->Employeegroup->get($id, [
            'contain' => ['Employee']
        ]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('employeegroup', 'employee','departments','yuistring','myReviewees','menuAry','headerAry'));
        $this->set('_serialize', ['employeegroup','departments','myReviewees','employee']);
    }

    public function getemployeebygroupid($id=null)
    {
        $this->Employee = TableRegistry::get('Employee');
        $this->Department = TableRegistry::get('Department');
        $departments = $this->Department->find('all');
        
        if($id!=null)
        {
            $employeegroup = $this->Employeegroup->get($id, [
            'contain' => ['Employee']
            ]);
            $employees =  $employeegroup->employee;
        }
        else
            $employees = $this->Employee->find('all')->where(['isdeleted'=>0]);

        if(count($employees)==0)
            die();

        $util=new Utility();
        $yuistring =  $util->GetYUIString2($departments,$employees);
        echo $yuistring;
        die();
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Department = TableRegistry::get('Department');
        $this->Employee = TableRegistry::get('Employee');

        $employees= $this->Employee->find('all')->where(['isdeleted'=>0]);
        $departments = $this->Department->find('all')->where(['isdeleted'=>0]);
        $myReviewees = null;

        $util=new Utility();
        $yuistring =  $util->GetYUIString($departments,$employees);
        //echo "yui is ".$yuistring;
        $employeegroup = $this->Employeegroup->newEntity();
        if ($this->request->is('post')) 
        {
            $employeegroup = $this->Employeegroup->patchEntity($employeegroup, $this->request->data);
            //echo "Obj:".$employeegroup;
            //die();
            if ($this->Employeegroup->save($employeegroup)) 
            {
                $this->Flash->success(__('The employeegroup has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Duplicated employeegroup could not be saved. Please, try again.'));
        }
        $employee = $this->Employee->find('list', ['limit' => 200]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('employeegroup', 'employee','departments','yuistring','myReviewees','menuAry','headerAry'));
        $this->set('_serialize', ['employeegroup','departments','myReviewees']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Employeegroup id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Department = TableRegistry::get('Department');
        $this->Employee = TableRegistry::get('Employee');

        $employees= $this->Employee->find('all')->where(['isdeleted'=>0]);
        $departments = $this->Department->find('all')->where(['isdeleted'=>0]);
        $myReviewees = null;
        
        $employeegroup = $this->Employeegroup->get($id, [
            'contain' => ['Employee']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $employeegroup = $this->Employeegroup->patchEntity($employeegroup, $this->request->data);
            if ($this->Employeegroup->save($employeegroup)) 
            {
                $this->Flash->success(__('The employeegroup has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Duplicated employeegroup could not be saved. Please, try again.'));
        }       
        
        $util=new Utility();
        $yuistring =  $util->GetYUIStringSelectedEmployee($departments,$employees,$employeegroup->employee);
        //echo "YUI".$yuistring;
        
        $employee = $this->Employeegroup->Employee->find('list', ['limit' => 200])->where(['isdeleted'=>0]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('employeegroup', 'employee','departments','yuistring','myReviewees','menuAry','headerAry'));
        $this->set('_serialize', ['employeegroup','departments','myReviewees']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Employeegroup id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $employeegroup = $this->Employeegroup->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put','delete'])) 
        {
            $employeegroup = $this->Employeegroup->patchEntity($employeegroup, $this->request->data);
            $employeegroup->isdeleted = 1;
            if ($this->Employeegroup->save($employeegroup)) 
            {
                $this->Flash->success(__('The employeegroup has been deleted.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The employeegroup could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
