<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Reviewresultdetail Controller
 *
 * @property \App\Model\Table\ReviewresultdetailTable $Reviewresultdetail
 */
class ReviewresultdetailController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $reviewresultdetail = $this->paginate($this->Reviewresultdetail);

        $this->set(compact('reviewresultdetail'));
        $this->set('_serialize', ['reviewresultdetail']);
    }

    /**
     * View method
     *
     * @param string|null $id Reviewresultdetail id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reviewresultdetail = $this->Reviewresultdetail->get($id, [
            'contain' => []
        ]);

        $this->set('reviewresultdetail', $reviewresultdetail);
        $this->set('_serialize', ['reviewresultdetail']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reviewresultdetail = $this->Reviewresultdetail->newEntity();
        if ($this->request->is('post')) {
            $reviewresultdetail = $this->Reviewresultdetail->patchEntity($reviewresultdetail, $this->request->data);
            if ($this->Reviewresultdetail->save($reviewresultdetail)) {
                $this->Flash->success(__('The reviewresultdetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reviewresultdetail could not be saved. Please, try again.'));
        }
        $this->set(compact('reviewresultdetail'));
        $this->set('_serialize', ['reviewresultdetail']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Reviewresultdetail id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reviewresultdetail = $this->Reviewresultdetail->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reviewresultdetail = $this->Reviewresultdetail->patchEntity($reviewresultdetail, $this->request->data);
            if ($this->Reviewresultdetail->save($reviewresultdetail)) {
                $this->Flash->success(__('The reviewresultdetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reviewresultdetail could not be saved. Please, try again.'));
        }
        $this->set(compact('reviewresultdetail'));
        $this->set('_serialize', ['reviewresultdetail']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Reviewresultdetail id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reviewresultdetail = $this->Reviewresultdetail->get($id);
        if ($this->Reviewresultdetail->delete($reviewresultdetail)) {
            $this->Flash->success(__('The reviewresultdetail has been deleted.'));
        } else {
            $this->Flash->error(__('The reviewresultdetail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
