<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 */
class CompaniesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function index()
    {
        $this->paginate = [
            'contain' => ['Townships']
        ];
        $companies = $this->paginate($this->Companies);        

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        echo "".$layout;
        $this->set(compact('companies','menuAry','headerAry'));
        $this->set('_serialize', ['companies']);
    }

    /**
     * View method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $company = $this->Companies->get($id, [
            'contain' => ['Townships', 'Department', 'Organizationreviews', 'Products']
        ]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set('company', $company,'menuAry',$menuAry,'headerAry',$headerAry);
        $this->set('_serialize', ['company','menuAry','headerAry']);
    }



    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $company = $this->Companies->newEntity();
        if ($this->request->is('post')) {
            $company = $this->Companies->patchEntity($company, $this->request->data);
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The company could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $townships = $this->Companies->Townships->find('list', ['limit' => 200]);

        $this->set(compact('company', 'townships','menuAry','headerAry'));
        $this->set('_serialize', ['company']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $company = $this->Companies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {

            $company = $this->Companies->patchEntity($company, $this->request->data);
            // echo "Company".json_encode($company);
            // die();
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The company has been saved.'));
            }
            else{
            $this->Flash->error(__('The company could not be saved. Please, try again.'));
            }
        }

        $townships = $this->Companies->Townships->find('list', ['limit' => 200]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('company', 'townships','menuAry','headerAry'));
        $this->set('_serialize', ['company']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $company = $this->Companies->get($id);
        if ($this->Companies->delete($company)) {
            $this->Flash->success(__('The company has been deleted.'));
        } else {
            $this->Flash->error(__('The company could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
