<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Questioncategory Controller
 *
 * @property \App\Model\Table\QuestioncategoryTable $Questioncategory
 */
class QuestioncategoryController extends AppController
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
        //$questioncategory = $this->paginate($this->Questioncategory);
        $questioncategory = $this->paginate($this->Questioncategory->find('all',['conditions' => ['isdeleted' => '0']]));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('questioncategory','menuAry','headerAry'));
        $this->set('_serialize', ['questioncategory']);
    }

    /**
     * View method
     *
     * @param string|null $id Questioncategory id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Users = TableRegistry::get('Users');

        $questioncategory = $this->Questioncategory->get($id, [
            'contain' => []
        ]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

       // $this->set('questioncategory', $questioncategory);
        $this->set(compact('questioncategory','menuAry','headerAry'));
        $this->set('_serialize', ['questioncategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questioncategory = $this->Questioncategory->newEntity();
        if ($this->request->is('post')) 
        {
            $check = $this->Questioncategory
                    ->find()
                    ->where(['questioncategoryname' => $this->request->data('questioncategoryname'),'questioncategoryweight'=> $this->request->data('questioncategoryweight'),'isdeleted' =>0])
                    ->first();

            if($check == null)
            {
                $questioncategory = $this->Questioncategory->patchEntity($questioncategory, $this->request->data);
                if ($this->Questioncategory->save($questioncategory)) 
                {
                    $this->Flash->success(__('The questioncategory has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('Duplicated questioncategory could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('questioncategory','menuAry','headerAry'));
        $this->set('_serialize', ['questioncategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Questioncategory id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $questioncategory = $this->Questioncategory->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $check = $this->Questioncategory
                    ->find()
                    ->where(['questioncategoryname' => $this->request->data('questioncategoryname'),'questioncategoryweight'=> $this->request->data('questioncategoryweight'),'id !=' => $id,'isdeleted' =>0])
                    ->first();

            if($check == null)
            {
                $questioncategory = $this->Questioncategory->patchEntity($questioncategory, $this->request->data);
                if ($this->Questioncategory->save($questioncategory)) 
                {
                    $this->Flash->success(__('The questioncategory has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('Duplicated questioncategory could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('questioncategory','menuAry','headerAry'));
        $this->set('_serialize', ['questioncategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Questioncategory id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $questioncategory = $this->Questioncategory->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put','delete'])) 
        {
            $questioncategory = $this->Questioncategory->patchEntity($questioncategory, $this->request->data);
            $questioncategory->isdeleted = 1;
            if ($this->Questioncategory->save($questioncategory)) 
            {
                $this->Flash->success(__('The questioncategory has been deleted.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The questioncategory could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }

    public function import()
    {
        if(isset($this->request->data['csv']))
        {
            $data = $this->request->data['csv'];
            $file = $data['tmp_name'];
            $handle = fopen($file, "r");

            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                $quecat = TableRegistry::get('Questioncategory');
                $questioncategory = $quecat->newEntity();
                
                $questioncategory->questioncategoryname = $row[0];               
                $questioncategory->questioncategorydescription = $row[1];
                $questioncategory->questioncategoryweight = $row[2]; 

                $dd = $this->Questioncategory
                    ->find()
                    ->where(['questioncategoryname' => $row[0] , 'questioncategorydescription' => $row[1]])
                    ->first();

                if($dd == null)
                {
                    if($quecat->save($questioncategory))
                    {
                       /*echo "successfully inserted";*/
                    }
                }                
            }
            fclose($handle);
        }
       return $this->redirect(['action' => 'index']);
    }
}
