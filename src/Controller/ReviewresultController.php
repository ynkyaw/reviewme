<?php
namespace App\Controller;

use App\Controller\AppController;
use  Cake\Cache\Cache;
/**
 * Reviewresult Controller
 *
 * @property \App\Model\Table\ReviewresultTable $Reviewresult
 */
class ReviewresultController extends AppController
{

    public $components = array('RequestHandler');

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $reviewresult = $this->Reviewresult->find('all',['conditions' => ['finish' => '1']]);
        $this->set(array(
            'reviewresult' => $reviewresult,
            '_serialize' => array('reviewresult')
        ));
    }

    /**
     * View method
     *
     * @param string|null $id Reviewresult id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reviewresult = $this->Reviewresult->get($id,['contain'=>['Reviewresultdetail']]);
        $this->set(array(
            'reviewresult' => $reviewresult,
            '_serialize' => array('reviewresult')
        ));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reviewresult = $this->Reviewresult->newEntity();
        if ($this->request->is('post')) 
        {
            //debug($this->request->data);
            $reviewresult = $this->Reviewresult->patchEntity($reviewresult, $this->request->data);            
            
            if ($this->Reviewresult->save($reviewresult)) 
            {
                echo "Save Success";
               // echo "review : ".$reviewresult->reviewid."/"."reviewee :".$reviewresult->revieweeid."/"."reviewerid : ".$reviewresult->reviewerid."/";
                $cacheonekey = $reviewresult->reviewid.'_'.$reviewresult->revieweeid;
                $cachetwokey = $reviewresult->reviewerid;

                $cache1 = Cache::read($cacheonekey,'long');  
                //echo "c1 is :".$cache1;
                $cache2 = Cache::read($cachetwokey,'long');
                  
               // echo "c1 found and reduce count";
                $cache1count = $cache1 - 1;
                Cache::write($cacheonekey,$cache1count,'long');
                $cache11 = Cache::read($cacheonekey,'long');
               // echo "c1 is :".$cache11;

                Cache::delete($cachetwokey,'long');
                die();
            }
            else
            {
               echo "Failed";
               die();
            }
            
            $this->Flash->error(__('The reviewresult could not be saved. Please, try again.'));
        }   
        $this->set(compact('reviewresult'));
        $this->set('_serialize', ['reviewresult']);
    }
   

    /**
     * Edit method
     *
     * @param string|null $id Reviewresult id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reviewresult = $this->Reviewresult->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $reviewresult = $this->Reviewresult->patchEntity($reviewresult, $this->request->data);
            if ($this->Reviewresult->save($reviewresult)) 
            {
                echo "save success";
                die();
            }
            else
            {
                echo "fail";
                die();
            }

            $this->Flash->error(__('The reviewresult could not be saved. Please, try again.'));
        }
        $this->set(compact('reviewresult'));
        $this->set('_serialize', ['reviewresult']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Reviewresult id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reviewresult = $this->Reviewresult->get($id);
        if ($this->Reviewresult->delete($reviewresult)) {
            $this->Flash->success(__('The reviewresult has been deleted.'));
        } else {
            $this->Flash->error(__('The reviewresult could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
