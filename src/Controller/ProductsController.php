<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
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
       
        $products = $this->paginate($this->Products->find('all',['conditions' => ['isdeleted' => '0']]));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('products','menuAry','headerAry'));
        $this->set('_serialize', ['products']);
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('product','menuAry','headerAry'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) 
        {
            $check = $this->Products
                    ->find()
                    ->where(['productname' => $this->request->data('productname'),'description' => $this->request->data('description'),'isdeleted' => 0])
                    ->first();

            if($check == null)
            {
                $product = $this->Products->patchEntity($product, $this->request->data);
                if ($this->Products->save($product)) 
                {
                    $this->Flash->success(__('The product has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }

            $this->Flash->error(__('Duplicated product could not be saved. Please, try again.'));
        }

       // $itemreviewsresults = $this->Products->itemreviewsresults->find('list', ['limit' => 200]);
        //$itemreviewsReviewees = $this->Products->ItemreviewsReviewees->find('list', ['limit' => 200]);
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('product','menuAry','headerAry'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $check = $this->Products
                    ->find()
                    ->where(['productname' => $this->request->data('productname'),'description' => $this->request->data('description'),'id !=' =>$id,'isdeleted' => 0])
                    ->first();

            if($check == null)
            {
                $product = $this->Products->patchEntity($product, $this->request->data);
                if ($this->Products->save($product)) 
                {
                    $this->Flash->success(__('The product has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }

            $this->Flash->error(__('Duplicated product could not be saved. Please, try again.'));
        }

       // $itemreviewsresults = $this->Products->itemreviewsresults->find('list', ['limit' => 200]);
       // $itemreviewsReviewees = $this->Products->ItemreviewsReviewees->find('list', ['limit' => 200]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;
        
        $this->set(compact('product', 'menuAry','headerAry'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put','delete'])) 
        {
            $product = $this->Products->patchEntity($product, $this->request->data);
            $product->isdeleted = 1;
            if ($this->Products->save($product)) 
            {
                $this->Flash->success(__('The product has been deleted.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
