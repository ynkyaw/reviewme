<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Services Controller
 *
 * @property \App\Model\Table\ServicesTable $Services
 */
class ServicesController extends AppController
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
       
        $services = $this->paginate($this->Services->find('all',['conditions' => ['isdeleted' => '0']]));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('services','menuAry','headerAry'));
        $this->set('_serialize', ['services']);
    }

    /**
     * View method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $service = $this->Services->get($id, [
            'contain' => []
        ]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('service','menuAry','headerAry'));
        $this->set('_serialize', ['service']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $service = $this->Services->newEntity();
        if ($this->request->is('post')) 
        {
            $check = $this->Services
                    ->find()
                    ->where(['servicename' => $this->request->data('servicename'),'description' => $this->request->data('description'),'isdeleted' => 0])
                    ->first();

            if($check == null)
            {
                $service = $this->Services->patchEntity($service, $this->request->data);
                if ($this->Services->save($service)) 
                {
                    $this->Flash->success(__('The service has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }

            $this->Flash->error(__('Duplicated service could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('service','menuAry','headerAry'));
        $this->set('_serialize', ['service']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $service = $this->Services->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $check = $this->Services
                    ->find()
                    ->where(['servicename' => $this->request->data('servicename'),'description' => $this->request->data('description'),'id !=' =>$id,'isdeleted' => 0])
                    ->first();

            if($check == null)
            {
                $service = $this->Services->patchEntity($service, $this->request->data);
                if ($this->Services->save($service)) {
                    $this->Flash->success(__('The service has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            
            $this->Flash->error(__('Duplicated service could not be saved. Please, try again.'));            
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('service','menuAry','headerAry'));
        $this->set('_serialize', ['service']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $service = $this->Services->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put','delete'])) 
        {
            $service = $this->Services->patchEntity($service, $this->request->data);
            $service->isdeleted = 1;
            if ($this->Services->save($service)) 
            {
                $this->Flash->success(__('The service has been deleted.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
