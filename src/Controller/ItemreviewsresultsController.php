<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Itemreviewsresult Controller
 *
 * @property \App\Model\Table\ItemreviewsresultTable $Itemreviewsresult
 */
class ItemreviewsresultsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Itemreviews', 'Products']
        ];
        $itemreviewsresult = $this->paginate($this->Itemreviewsresults);

        $this->set(compact('itemreviewsresult'));
        $this->set('_serialize', ['itemreviewsresult']);
    }

    /**
     * View method
     *
     * @param string|null $id Itemreviewsresult id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemreviewsresult = $this->Itemreviewsresults->get($id, [
            'contain' => ['Itemreviews', 'Products', 'ItemreviewsresultDetail']
        ]);

        $this->set('itemreviewsresult', $itemreviewsresult);
        $this->set('_serialize', ['itemreviewsresult']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemreviewsresult = $this->Itemreviewsresults->newEntity();
        if ($this->request->is('post')) 
        {
            $itemreviewsresult = $this->Itemreviewsresults->patchEntity($itemreviewsresult, $this->request->data);
           // echo json_encode($itemreviewsresult);
            //die();
            if ($this->Itemreviewsresults->save($itemreviewsresult)) 
            {                
                echo "Save Success";
                die();
                $this->Flash->success(__('The itemreviewsresult has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            else
            {
               echo "Failed";
               die();
            }

            $this->Flash->error(__('The itemreviewsresult could not be saved. Please, try again.'));
        }

        $itemreviews = $this->Itemreviewsresults->Itemreviews->find('list', ['limit' => 200]);
        $products = $this->Itemreviewsresults->Products->find('list', ['limit' => 200]);
        $this->set(compact('itemreviewsresult', 'itemreviews', 'products'));
        $this->set('_serialize', ['itemreviewsresult']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Itemreviewsresult id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemreviewsresult = $this->Itemreviewsresults->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemreviewsresult = $this->Itemreviewsresults->patchEntity($itemreviewsresult, $this->request->data);
            if ($this->Itemreviewsresults->save($itemreviewsresult)) {
                $this->Flash->success(__('The itemreviewsresult has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The itemreviewsresult could not be saved. Please, try again.'));
        }
        $itemreviews = $this->Itemreviewsresults->Itemreviews->find('list', ['limit' => 200]);
        $products = $this->Itemreviewsresults->Products->find('list', ['limit' => 200]);
        $this->set(compact('itemreviewsresult', 'itemreviews', 'products'));
        $this->set('_serialize', ['itemreviewsresult']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Itemreviewsresult id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemreviewsresult = $this->Itemreviewsresults->get($id);
        if ($this->Itemreviewsresults->delete($itemreviewsresult)) {
            $this->Flash->success(__('The itemreviewsresult has been deleted.'));
        } else {
            $this->Flash->error(__('The itemreviewsresult could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
