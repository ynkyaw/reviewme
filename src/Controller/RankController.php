<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Rank Controller
 *
 * @property \App\Model\Table\RankTable $Rank
 */
class RankController extends AppController
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
       // $rank = $this->paginate($this->Rank);
        $rank = $this->paginate($this->Rank->find('all',['conditions' => ['isdeleted' => '0']]));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('rank','menuAry','headerAry'));
        $this->set('_serialize', ['rank']);
    }

    /**
     * View method
     *
     * @param string|null $id Rank id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rank = $this->Rank->get($id, [
            'contain' => []
        ]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('rank','menuAry','headerAry'));
        $this->set('_serialize', ['rank']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rank = $this->Rank->newEntity();
        if ($this->request->is('post')) 
        {
            $check = $this->Rank
                    ->find()
                    ->where(['rank' => $this->request->data('rank'),'level' => $this->request->data('level'),'isdeleted' => 0])
                    ->first();

            if($check == null)
            {
                $rank = $this->Rank->patchEntity($rank, $this->request->data);
                if ($this->Rank->save($rank))
                {
                    $this->Flash->success(__('The rank has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }

            $this->Flash->error(__('Duplicated rank could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('rank','menuAry','headerAry'));
        $this->set('_serialize', ['rank']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Rank id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rank = $this->Rank->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $check = $this->Rank
                    ->find()
                    ->where(['rank' => $this->request->data('rank'),'level' => $this->request->data('level'),'id !=' =>$id,'isdeleted' =>0])
                    ->first();

            if($check == null)
            {
                $rank = $this->Rank->patchEntity($rank, $this->request->data);
                if ($this->Rank->save($rank)) 
                {
                    $this->Flash->success(__('The rank has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('Duplicated rank could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;
        
        $this->set(compact('rank','menuAry','headerAry'));
        $this->set('_serialize', ['rank']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Rank id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $rank = $this->Rank->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put','delete'])) 
        {
            $rank = $this->Rank->patchEntity($rank, $this->request->data);
            $rank->isdeleted = 1;
            if ($this->Rank->save($rank)) 
            {
                $this->Flash->success(__('The rank has been deleted.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The rank could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
