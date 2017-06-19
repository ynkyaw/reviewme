<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Subcategory Controller
 *
 * @property \App\Model\Table\SubcategoryTable $Subcategory
 */
class SubcategoryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function index()
    {
        $subcategory = $this->paginate($this->Subcategory->find('all',['conditions' => ['Subcategory.isdeleted' => '0']])->contain(['questioncategory']));//
        
        $questiontype = $this->Subcategory->questioncategory->find('all', array('fields' => array('id', 'questioncategoryname')));
    
        if(isset($questiontype))
        {
            $count = 1;
            foreach($questiontype as $qt)
            {
                $name = 'q'.$count;
                $questioncategoryid = $qt->id; 
                //echo "qcid ".$questioncategoryid;

                $eachsubcategory[$name] = $this->Subcategory->find('all',array('conditions' => array('questioncategoryid' => $questioncategoryid,'isdeleted' => 0)));
                
                $count++;
                $this->set(compact('eachsubcategory'));
                $this->set('_serialize', ['subcategory']);  
            }         
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('subcategory','questiontype','menuAry','headerAry'));
        $this->set('_serialize', ['subcategory','questiontype']);
    }

    /**
     * View method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subcategory = $this->Subcategory->get($id, [
            'contain' => ['questioncategory']
        ]);
        //'questioncategory'
        $questioncategory = $this->Subcategory->questioncategory->find('list', array('fields' => array('id', 'questioncategoryname')));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('subcategory','menuAry','headerAry','questioncategory'));
        $this->set('_serialize', ['subcategory','questioncategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subcategory = $this->Subcategory->newEntity();
        if ($this->request->is('post')) 
        {
            $check = $this->Subcategory
                    ->find()
                    ->where(['questioncategoryid' => $this->request->data('questioncategoryid'),'name'=> $this->request->data('name'),'subcategoryweight'=> $this->request->data('subcategoryweight'),'isdeleted' => 0])
                    ->first();

            if($check == null)
            {
                $subcategory = $this->Subcategory->patchEntity($subcategory, $this->request->data);
                if ($this->Subcategory->save($subcategory)) 
                {
                    $this->Flash->success(__('The subcategory has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The subcategory could not be saved. Please, try again.'));
        }
        //$questioncategory = $this->Subcategory->questioncategory->find('list', ['limit' => 200]);
        $questioncategory = $this->Subcategory->questioncategory->find('list', array('fields' => array('id', 'questioncategoryname')));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('subcategory', 'questioncategory','menuAry','headerAry'));
        $this->set('_serialize', ['subcategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subcategory = $this->Subcategory->get($id, [
            'contain' => ['questioncategory']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $check = $this->Subcategory
                    ->find()
                    ->where(['questioncategoryid' => $this->request->data('questioncategoryid'),'name'=> $this->request->data('name'),'subcategoryweight'=> $this->request->data('subcategoryweight'),'id !=' =>$id,'isdeleted' => 0])
                    ->first();

            if($check == null)
            {
                $subcategory = $this->Subcategory->patchEntity($subcategory, $this->request->data);
                if ($this->Subcategory->save($subcategory)) {
                    $this->Flash->success(__('The subcategory has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The subcategory could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $questioncategory = $this->Subcategory->questioncategory->find('list', array('fields' => array('id', 'questioncategoryname')));

        $this->set(compact('subcategory', 'questioncategory','menuAry','headerAry'));
        $this->set('_serialize', ['subcategory','questioncategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $subcategory = $this->Subcategory->get($id, [
            'contain' => ['questioncategory']
        ]);
        if ($this->request->is(['patch', 'post', 'put','delete'])) 
        {
            $subcategory = $this->Subcategory->patchEntity($subcategory, $this->request->data);
            $subcategory->isdeleted = 1;
            if ($this->Subcategory->save($subcategory)) {
                $this->Flash->success(__('The subcategory has been deleted.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subcategory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function import()
    {
        if(isset($this->request->data['csv']))
        {
            $data = $this->request->data['csv'];
            $file = $data['tmp_name'];

            $filename = $data['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);                 

            if($file == null)
            {
                $this->Flash->error(__('Please Choose A CSV File To Upload.'));
                return $this->redirect(['action' => 'index']);
            }
            if($fileExt2 != csv)
            {
                $this->Flash->error(__('Please Choose CSV File To Upload.'));
                return $this->redirect(['action' => 'index']);
            }

            $handle = fopen($file, "r");
            $data = fgets($handle);
            
            while (($data = fgets($handle)) !== FALSE)
            {
                //$row = array_map("utf8_encode", $row); //added
                try{
                    $row = Text::tokenize($data, ',','','');
                }
                catch(Exception $e)
                {

                }
                
                $sub = TableRegistry::get('Subcategory');
                $subcategory = $sub->newEntity();
                
                $num = count($row);
               
                $subcategory->name = $row[0];
                $subcategory->description = $row[1];
                $subcategory->subcategoryweight = $row[2];
                $subcategory->questioncategoryid = $row[3];

                $dd = $this->Subcategory
                    ->find()
                    ->where(['questioncategoryid' => $row[3] , 'name' => $row[0]])
                    ->first();

                if($dd == null)
                {
                    if($sub->save($subcategory))
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
