<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController
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
       
        $projects = $this->paginate($this->Projects->find('all',['conditions' => ['isdeleted' => '0']]));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('projects','menuAry','headerAry'));
        $this->set('_serialize', ['projects']);
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => []
        ]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('project','menuAry','headerAry'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project = $this->Projects->newEntity();
        if ($this->request->is('post')) 
        {
            $check = $this->Projects
                    ->find()
                    ->where(['projectname' => $this->request->data('projectname'),'description' => $this->request->data('description'),'isdeleted' => 0])
                    ->first();

            if($check == null)
            {
                $project = $this->Projects->patchEntity($project, $this->request->data);
                if ($this->Projects->save($project)) 
                {
                    $this->Flash->success(__('The project has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }

            $this->Flash->error(__('Duplicated project could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('project','menuAry','headerAry'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $check = $this->Projects
                    ->find()
                    ->where(['projectname' => $this->request->data('projectname'),'description' => $this->request->data('description'),'id !=' =>$id,'isdeleted' => 0])
                    ->first();

            if($check == null)
            {
                $project = $this->Projects->patchEntity($project, $this->request->data);
                if ($this->Projects->save($project)) 
                {
                    $this->Flash->success(__('The project has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('Duplicated project could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('project','menuAry','headerAry'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put','delete'])) 
        {
            $project = $this->Projects->patchEntity($project, $this->request->data);
            $project->isdeleted = 1;
            if ($this->Projects->save($project)) 
            {
                $this->Flash->success(__('The project has been deleted.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
