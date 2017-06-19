<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Jobposition Controller
 *
 * @property \App\Model\Table\JobpositionTable $Jobposition
 */
class JobpositionController extends AppController
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
        //$jobposition = $this->paginate($this->Jobposition);
        $jobposition = $this->paginate($this->Jobposition->find('all',['conditions' => ['isdeleted' => '0']]));

        //$layout = $this->getauthorization();
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;
        

        $this->set(compact('jobposition','layout','menuAry','headerAry'));
        $this->set('_serialize', ['jobposition']);
    }

    /**
     * View method
     *
     * @param string|null $id Jobposition id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $jobposition = $this->Jobposition->get($id, [
            'contain' => []
        ]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('jobposition','menuAry','headerAry'));
        $this->set('_serialize', ['jobposition']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $jobposition = $this->Jobposition->newEntity();
        if ($this->request->is('post')) 
        {
            $check = $this->Jobposition
                    ->find()
                    ->where(['jobtitle' => $this->request->data('jobtitle'),'jobdescription' => $this->request->data('jobdescription'),'isdeleted'=>0])
                    ->first();

            if($check == null)
            {
                $jobposition = $this->Jobposition->patchEntity($jobposition, $this->request->data);
                if ($this->Jobposition->save($jobposition)) 
                {
                    $this->Flash->success(__('The jobposition has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('Duplicated jobposition could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('jobposition','menuAry','headerAry'));
        $this->set('_serialize', ['jobposition']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Jobposition id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $jobposition = $this->Jobposition->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $check = $this->Jobposition
                    ->find()
                    ->where(['jobtitle' => $this->request->data('jobtitle'),'jobdescription' => $this->request->data('jobdescription'),'isdeleted' => 0,'id !=' => $id])
                    ->first();

            if($check == null)
            {
                $jobposition = $this->Jobposition->patchEntity($jobposition, $this->request->data);
                if ($this->Jobposition->save($jobposition)) 
                {
                    $this->Flash->success(__('The jobposition has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('Duplicated jobposition could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('jobposition','menuAry','headerAry'));
        $this->set('_serialize', ['jobposition']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Jobposition id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $jobposition = $this->Jobposition->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put','delete'])) 
        {
            $jobposition = $this->Jobposition->patchEntity($jobposition, $this->request->data);
            $jobposition->isdeleted = 1;
            if ($this->Jobposition->save($jobposition)) 
            {
                $this->Flash->success(__('The jobposition has been deleted.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The jobposition could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    //CSV excel file export 
    //excel format for date must be Y-m-d
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
                $this->Flash->error(__('Please Choose A File To Upload.'));
                return $this->redirect(['action' => 'index']);
            }
            if($fileExt2 != csv)
            {
                $this->Flash->error(__('Please Choose CSV File To Upload.'));
                return $this->redirect(['action' => 'index']);
            }
            
            $handle = fopen($file, "r");
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                if($row[0] == 'JobTitle') 
                {
                    continue;
                }

                //$emp = $this->Employee->get($row[0]);
                $pos = TableRegistry::get('Jobposition');
                $positions = $pos->newEntity();

                $positions->jobtitle = $row[0];
                $positions->jobdescription = $row[1];  
                
                $pp = $this->Jobposition
                    ->find()
                    ->where(['jobtitle' => $row[0]])
                    ->first();

                if($pp == null)
                {
                    if($pos->save($positions))
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
