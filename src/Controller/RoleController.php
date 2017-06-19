<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Role Controller
 *
 * @property \App\Model\Table\RoleTable $Role
 */
class RoleController extends AppController
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

        $role = $this->paginate($this->Role->find('all',['conditions' => ['isDeleted' => 0]]));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('role','menuAry','headerAry'));
        $this->set('_serialize', ['role']);
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->headermenu = TableRegistry::get('Headermenu');
        $this->menu = TableRegistry::get('Menu');

        $role = $this->Role->get($id, [
            'contain' => ['Menu']
        ]);

        $headermenu = $this->headermenu->find('all')->where(['isdeleted' => 0]);

        $mymenu = $this->menu->find('all')->where(['isdeleted' => 0]);

        $util=new Utility();
        $yuistring =  $util->GetMenuYUIString($headermenu,$mymenu);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $menu = $this->Role->Menu->find('list', ['limit' => 200]);

        $this->set(compact('role', 'menu','menuAry','headerAry','yuistring'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->headermenu = TableRegistry::get('Headermenu');
        $this->menu = TableRegistry::get('Menu');

        $role = $this->Role->newEntity();
        if ($this->request->is('post')) 
        {
            $role = $this->Role->patchEntity($role, $this->request->data);
            //echo "Obj:".json_encode($role);
            //die();
            if ($this->Role->save($role)) 
            {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }

        //$role = $this->RoleMenu->Role->find('list', ['limit' => 200]);

        $headermenu = $this->headermenu->find('all')->where(['isdeleted' => 0]);

        $mymenu = $this->menu->find('all')->where(['isdeleted' => 0]);

        $util=new Utility();
        $yuistring =  $util->GetMenuYUIString($headermenu,$mymenu);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $menu = $this->Role->Menu->find('list', ['limit' => 200]);

        $this->set(compact('role', 'menu','menuAry','headerAry','yuistring'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->headermenu = TableRegistry::get('Headermenu');
        $this->menu = TableRegistry::get('Menu');

        $role = $this->Role->get($id, [
            'contain' => ['Menu']
        ]);

        if($this->request->is(['patch', 'post', 'put'])) 
        {
            $role = $this->Role->patchEntity($role, $this->request->data);
            if ($this->Role->save($role)) 
            {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }

        $headermenu = $this->headermenu->find('all')->where(['isdeleted' => 0]);

        $mymenu = $this->menu->find('all')->where(['isdeleted' => 0]);

        $util=new Utility();
        $yuistring =  $util->GetSelectedMenuYUIString($headermenu,$mymenu,$role->menu);
        //echo "yui ".json_encode($yuistring);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $menu = $this->Role->Menu->find('list', ['limit' => 200]);

        $this->set(compact('role', 'menu','menuAry','headerAry','yuistring'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Role->get($id);
        if ($this->Role->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
