<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Questiontype Controller
 *
 * @property \App\Model\Table\QuestiontypeTable $Questiontype
 */
class QuestiontypeController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $questiontype = $this->paginate($this->Questiontype);
        //echo "question type in controller ".$questiontype;
        $this->set(compact('questiontype'));
        $this->set('_serialize', ['questiontype']);
    }

    /**
     * View method
     *
     * @param string|null $id Questiontype id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $questiontype = $this->Questiontype->get($id, [
            'contain' => []
        ]);

        $this->set('questiontype', $questiontype);
        //$this->set(compact('$questiontype'));
        $this->set('_serialize', ['questiontype']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questiontype = $this->Questiontype->newEntity();
        if ($this->request->is('post')) {
            $questiontype = $this->Questiontype->patchEntity($questiontype, $this->request->data);
            if ($this->Questiontype->save($questiontype)) {
                $this->Flash->success(__('The questiontype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The questiontype could not be saved. Please, try again.'));
        }
        $this->set(compact('questiontype'));
        $this->set('_serialize', ['questiontype']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Questiontype id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $questiontype = $this->Questiontype->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $questiontype = $this->Questiontype->patchEntity($questiontype, $this->request->data);
            if ($this->Questiontype->save($questiontype)) {
                $this->Flash->success(__('The questiontype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The questiontype could not be saved. Please, try again.'));
        }
        $this->set(compact('questiontype'));
        $this->set('_serialize', ['questiontype']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Questiontype id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $questiontype = $this->Questiontype->get($id);
        if ($this->Questiontype->delete($questiontype)) {
            $this->Flash->success(__('The questiontype has been deleted.'));
        } else {
            $this->Flash->error(__('The questiontype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
