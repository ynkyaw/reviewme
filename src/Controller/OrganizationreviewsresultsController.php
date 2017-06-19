<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Organizationreviewsresults Controller
 *
 * @property \App\Model\Table\OrganizationreviewsresultsTable $Organizationreviewsresults
 */
class OrganizationreviewsresultsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Organizationreviews']
        ];
        $organizationreviewsresults = $this->paginate($this->Organizationreviewsresults);

        $this->set(compact('organizationreviewsresults'));
        $this->set('_serialize', ['organizationreviewsresults']);
    }

    /**
     * View method
     *
     * @param string|null $id Organizationreviewsresult id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $organizationreviewsresult = $this->Organizationreviewsresults->get($id, [
            'contain' => ['Organizationreviews', 'Organizationreviewsresultdetail']
        ]);

        $this->set('organizationreviewsresult', $organizationreviewsresult);
        $this->set('_serialize', ['organizationreviewsresult']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $organizationreviewsresult = $this->Organizationreviewsresults->newEntity();
        if ($this->request->is('post')) 
        {
            $organizationreviewsresult = $this->Organizationreviewsresults->patchEntity($organizationreviewsresult, $this->request->data);
            echo json_encode($organizationreviewsresult);
            //die();
            if ($this->Organizationreviewsresults->save($organizationreviewsresult)) 
            {
                echo "Save Success";
                die();
                $this->Flash->success(__('The organizationreviewsresult has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            else
            {
               echo "Failed";
               die();
            }

            $this->Flash->error(__('The organizationreviewsresult could not be saved. Please, try again.'));
        }

        $organizationreviews = $this->Organizationreviewsresults->Organizationreviews->find('list', ['limit' => 200]);
        $this->set(compact('organizationreviewsresult', 'organizationreviews'));
        $this->set('_serialize', ['organizationreviewsresult']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Organizationreviewsresult id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $organizationreviewsresult = $this->Organizationreviewsresults->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $organizationreviewsresult = $this->Organizationreviewsresults->patchEntity($organizationreviewsresult, $this->request->data);
            if ($this->Organizationreviewsresults->save($organizationreviewsresult)) {
                $this->Flash->success(__('The organizationreviewsresult has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The organizationreviewsresult could not be saved. Please, try again.'));
        }
        $organizationreviews = $this->Organizationreviewsresults->Organizationreviews->find('list', ['limit' => 200]);
        $this->set(compact('organizationreviewsresult', 'organizationreviews'));
        $this->set('_serialize', ['organizationreviewsresult']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Organizationreviewsresult id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $organizationreviewsresult = $this->Organizationreviewsresults->get($id);
        if ($this->Organizationreviewsresults->delete($organizationreviewsresult)) {
            $this->Flash->success(__('The organizationreviewsresult has been deleted.'));
        } else {
            $this->Flash->error(__('The organizationreviewsresult could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
