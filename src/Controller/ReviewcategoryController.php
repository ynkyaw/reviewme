<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Reviewcategory Controller
 *
 * @property \App\Model\Table\ReviewcategoryTable $Reviewcategory
 */
class ReviewcategoryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $reviewcategory =$this->Reviewcategory->find('all')->contain( ['Question','Employee']);

        $this->set(compact('reviewcategory'));
        $this->set('_serialize', ['reviewcategory']);
    }

    /**
     * View method
     *
     * @param string|null $id Reviewcategory id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reviewcategory = $this->Reviewcategory->get($id, ['contain' => ['Questions','Reviewers']]);
        
        $this->set('reviewcategory', $reviewcategory);
        $this->set('_serialize', ['reviewcategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reviewcategory = $this->Reviewcategory->newEntity();

        if ($this->request->is('post')) {
             
            $reviewcategory = $this->Reviewcategory->patchEntity($reviewcategory, $this->request->data);
            $reviewcategory->isdeleted = 0 ;
            if ($this->Reviewcategory->save($reviewcategory)) {
                //$this->Flash->success(__('The reviewcategory has been saved.'));
                echo $reviewcategory;
                die();
                //return $this->redirect(['action' => 'index']);
            }
            
            echo "Failed".$reviewcategory.$this->request->data;
            die();
            $this->Flash->error(__('The reviewcategory could not be saved. Please, try again.'));

         
        }
        $this->Employee = TableRegistry::get('Employee');
        $employees = $this->Employee->find('all')->contain(['rank','department','jobposition']);
        $this->set(compact('reviewcategory','employees'));
        $this->set('_serialize', ['reviewcategory','employees']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Reviewcategory id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $reviewcategory = $this->Reviewcategory->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reviewcategory = $this->Reviewcategory->patchEntity($reviewcategory, $this->request->data);
            if ($this->Reviewcategory->save($reviewcategory)) {
                $this->Flash->success(__('The reviewcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reviewcategory could not be saved. Please, try again.'));
        }
        $this->set(compact('reviewcategory'));
        $this->set('_serialize', ['reviewcategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Reviewcategory id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
       
        $this->request->allowMethod(['post', 'delete','ajax']);
        
        $reviewcategory = $this->Reviewcategory->get($id);
        if ($this->Reviewcategory->delete($reviewcategory)) {
            echo "Success";
            die();
            $this->Flash->success(__('The reviewcategory has been deleted.'));
        } else {
            echo "Failed";
            die();
            $this->Flash->error(__('The reviewcategory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
