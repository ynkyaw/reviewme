<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Question;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
/**
 * Question Controller
 *
 * @property \App\Model\Table\QuestionTable $Question
 */
class QuestionController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function index()
    {
        $question = $this->paginate($this->Question->find('all',['conditions' => ['Question.isdeleted' => '0']])->contain(['questioncategory']));
        
        $questiontype = $this->Question->questioncategory->find('all', array('fields' => array('id', 'questioncategoryname')));

        $subquestion = $this->Question->subcategory->find('all' ,array('fields' => array('id', 'name')));

        if(isset($subquestion))
        {
            $count = 1;
            foreach($subquestion as $qt)
            {
                $name = 'q'.$count;
                $questioncategoryid = $qt->id; 

                $eachquestion[$name] = $this->Question->find('all',array('conditions' => array('subcategoryid' => $questioncategoryid,'isdeleted' => 0)));
                
                $count++;
                $this->set(compact('eachquestion'));
                $this->set('_serialize', ['question']);  
            }         
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('question','questiontype','menuAry','headerAry','subquestion'));
        $this->set('_serialize', ['question','questiontype']);  
    }

    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Question->get($id, [
            'contain' => []
        ]);

        $questioncategory = $this->Question->questioncategory->find('list', array('fields' => array('id', 'questioncategoryname')));
        $subcategory = $this->Question->subcategory->find('list', array('fields' => array('id', 'name')));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('questioncategory','question','menuAry','headerAry','subcategory'));
        $this->set('_serialize', ['questioncategory','question']); 
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $question = $this->Question->newEntity();
        if ($this->request->is('post')) 
        {
            $check = $this->Question
                    ->find()
                    ->where(['questiontypeid' => $this->request->data('questiontypeid'),'questionname'=> $this->request->data('questionname'),'questionweight'=> $this->request->data('questionweight'),'isdeleted' =>0])
                    ->first();

            if($check == null)
            {
                $question = $this->Question->patchEntity($question, $this->request->data);
                if ($this->Question->save($question)) 
                {
                    $this->Flash->success(__('The question has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('Duplicated question could not be saved. Please, try again.'));
        }

        $questioncategory = $this->Question->questioncategory->find('list', array('fields' => array('id', 'questioncategoryname')));
        $subquestion = $this->Question->subcategory->find('list',array('fields' => array('id','name')));

        if(count($questioncategory->toArray())<1)
        {
            return $this->redirect([ 'controller'=>'Questioncategory','action' => 'index']);
        }
        //echo "This is count".count($questioncategory);
        
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('questioncategory','question','menuAry','headerAry','subquestion'));
        $this->set('_serialize', ['questioncategory','question']);    
    }

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Question->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $check = $this->Question
                    ->find()
                    ->where(['questiontypeid' => $this->request->data('questiontypeid'),'questionname'=> $this->request->data('questionname'),'questionweight'=> $this->request->data('questionweight'),'id !=' => $id,'isdeleted' =>0])
                    ->first();

            if($check == null)
            {
                $question = $this->Question->patchEntity($question, $this->request->data);
                if ($this->Question->save($question)) 
                {
                    $this->Flash->success(__('The question has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('Duplicated question could not be saved. Please, try again.'));
        }

        $questioncategory = $this->Question->questioncategory->find('list', array('fields' => array('id', 'questioncategoryname')));
        $subcategory = $this->Question->subcategory->find('list',array('fields' =>array('id', 'name')));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('question','questioncategory','menuAry','headerAry','subcategory'));
        $this->set('_serialize', ['question','questioncategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $question = $this->Question->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put','delete'])) 
        {
            $question = $this->Question->patchEntity($question, $this->request->data);
            $question->isdeleted = 1;
            if ($this->Question->save($question)) 
            {
                $this->Flash->success(__('The question has been deleted.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }

    public function list()
    {
        $questions = $this->Question->find('all')->where(['isdeleted'=>0])->toArray();
        $questioncategory = $this->Question->questioncategory->find('all')->where(['isdeleted'=>0])->toArray();
        $util=new Utility();

        $yuistring =  $util->GetYUIStringForQuestions($questions,$questioncategory);
        echo $yuistring;
        die();
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
                
                $que = TableRegistry::get('Question');
                $question = $que->newEntity();
                
                $num = count($row);
               
                $question->questiontypeid = $row[0];
                $question->questionname = $row[1];
                $question->questiontype =  $row[2];
                $question->questionweight = $row[3];

                $dd = $this->Question
                    ->find()
                    ->where(['questiontypeid' => $row[0] , 'questionname' => $row[1]])
                    ->first();

                if($dd == null)
                {
                    if($que->save($question))
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
