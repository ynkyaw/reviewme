<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
/**
 * Organizationreviews Controller
 *
 * @property \App\Model\Table\OrganizationreviewsTable $Organizationreviews
 */
class OrganizationreviewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->Employee = TableRegistry::get('Employee');
        $this->Users = TableRegistry::get('Users');

        $this->paginate = [
            'contain' => ['Reviewtype', 'Employee']
        ];
        //$organizationreviews = $this->paginate($this->Organizationreviews);        

        //get current login user from session
        $session = $this->request->session();
        $userid = $session->read('userid');
        
        $employee = $this->Employee->find('all')->where(['userid'=>$userid,'isdeleted' => 0])->first();
        $uid = 0;
        if($employee != null)
        {            
            $uid = $employee->id;
        }

        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute("SELECT r.id,r.title,r.goal,count(DISTINCT rrw.reviewerid) as reviewers,COUNT(DISTINCT rre.revieweeid) as reviewees,count(DISTINCT rr.id) as results FROM `organizationreviews` r LEFT JOIN organizationreviews_reviewees rre on rre.organizationreviews_id = r.id LEFT join organizationreviews_reviewers rrw on r.id= rrw.organizationreviews_id left JOIN organizationreviewsresults rr on rr.organizationreviews_id = r.id WHERE r.isdeleted =0 and r.reviewtype_id IN('8','9','10') and r.`owner_id` = ?  GROUP by r.id,r.title,r.goal", [$uid]);
        $rows = $stmt->fetchAll('assoc');            
        
        if(count($rows)>0)
        {       
            $jsonStr = "{\"result\":[";
            foreach ($rows as $row) {
                // Do work
                $jsonStr .= json_encode($row).",";
            }

            $jsonStr=substr_replace($jsonStr,"", strlen($jsonStr)-1);
            $jsonStr .="]}";
        //echo $jsonStr;     
            $organizationreviews = json_decode($jsonStr);   
        }
        else
        {
            $organizationreviews = null;
        }  

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('organizationreviews','menuAry','headerAry'));
        $this->set('_serialize', ['organizationreviews']);
    }

    /**
     * View method
     *
     * @param string|null $id Organizationreview id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $organizationreview = $this->Organizationreviews->get($id, [
            'contain' => ['Reviewtype', 'Employee']
        ]);

        $this->set('organizationreview', $organizationreview);
        $this->set('_serialize', ['organizationreview']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Department = TableRegistry::get('Department');
        $this->Employee = TableRegistry::get('Employee');
        $this->Question = TableRegistry::get('Question');
        $this->Questioncategory = TableRegistry::get('Questioncategory');
        $this->subcategory = TableRegistry::get('subcategory');
        $this->companies = TableRegistry::get('Companies');
        $this->Organization = TableRegistry::get('Organization');

        $organizationreview = $this->Organizationreviews->newEntity();

        if ($this->request->is('post')) 
        {
            $organizationreview = $this->Organizationreviews->patchEntity($organizationreview, $this->request->data);
           // echo json_encode($itemreview);

            $myReview = $this->Organizationreviews->newEntity();
            $myReview->title = $organizationreview->title; 
            $myReview->description = $organizationreview->description;
            $myReview->title = $organizationreview->title; 
            $myReview->goal = $organizationreview->goal;
            $myReview->owner_id = $organizationreview->owner_id;
            $myReview->Employee = $organizationreview->Employee;
            $myReview->startdate = $organizationreview->startdate; 
            $myReview->enddate = $organizationreview->enddate;
            $myReview->Reviewees = $organizationreview->Reviewees; 
            $myReview->Reviewees = $organizationreview->Reviewers; 
            $myReview->Question = $organizationreview->Question;
            $myReview->Employee = $organizationreview->Employee;
            $myReview->reviewtype_id = $organizationreview->reviewtype_id;
           
            if ($this->Organizationreviews->save($myReview))
            {            
                $this->Flash->success(__('The organizationreview has been saved.'));
   
                $this->organizationreviewsreviewees = TableRegistry::get('OrganizationreviewsReviewees');
                $myr_re = $this->organizationreviewsreviewees->newEntity();
                $myr_re->revieweeid = $organizationreview->revieweeid;//$reid;
                $myr_re->organizationreviews_id = $myReview->id;
                //echo "<br/> ReviewReviewee : ".json_encode($myr_re);

                if ($this->organizationreviewsreviewees->save($myr_re))
                {
                    echo "<br/>Status:Success";
                }
                else
                {
                    echo "<br/>Status:Failed";
                }

                $jsonStr =  json_encode($organizationreview->Reviewers);
               // echo "json ".json_encode($organizationreview->Reviewers);
                $jsonStr = str_replace('_', '', $jsonStr); //substr($jsonStr,2,1);
                $reviewersarray = json_decode($jsonStr);
                $rw_array = $reviewersarray->ids;
                foreach ($rw_array as $rwid) 
                {                    
                    $this->organizationreviewsreviewers = TableRegistry::get('OrganizationreviewsReviewers');
                    $myr_rw = $this->organizationreviewsreviewers->newEntity();
                    $myr_rw->reviewerid = $rwid;
                    $myr_rw->organizationreviews_id = $myReview->id;
                    //echo "<br/> ReviewReviewer : ".json_encode($myr_rw);

                    if ($this->organizationreviewsreviewers->save($myr_rw))
                    {
                        echo "<br/>Status:Success12";
                    }
                    else
                    {
                        echo "<br/>Status:Failed";
                    }
                }
                
                $jsonStr =  json_encode($organizationreview->Question_ids);               
                //echo "<br/>Question".$jsonStr;

                $questarray = $organizationreview->Question_ids;
                foreach ($questarray as $rqid) 
                {   
                    $this->organizationreviewsquestion = TableRegistry::get('OrganizationreviewsQuestion');
                    $myr_q = $this->organizationreviewsquestion->newEntity();
                    $myr_q->question_id = $rqid;
                    $myr_q->organizationreviews_id = $myReview->id;                    
                    
                    //echo "<br/> ReviewReviewer : ".json_encode($myr_q);

                    if ($this->organizationreviewsquestion->save($myr_q))
                    {
                        echo "<br/>Status:Success";
                    }
                    else
                    {
                        echo "<br/>Status:Failed";
                    }
                }

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The organizationreview could not be saved. Please, try again.'));
        }
        
        $reviewtype = $this->Organizationreviews->Reviewtype->find('list')->where(['isdeleted' =>0,'id >=' =>8]);
        $owner = $this->Organizationreviews->Employee->find('list')->where(['isdeleted' => 0])->toArray();
        $companylist = $this->companies->find('list')->where(['isdeleted' => 0])->toArray();
        
        $deptlist = $this->Department->find('list')->where(['isdeleted' => 0])->toArray();
        
        $orglist = $this->Organization->find('list')->where(['isdeleted' => 0])->toArray();       

        $reviewers = $this->Organizationreviews->Employee->find('list')->where(['isdeleted' =>0]);
        
        $employees= $this->Employee->find('all')->where(['isdeleted' => 0]);
        $employeepopup = $this->Employee->find('all')->contain(['rank','department','jobposition']);
        $departments = $this->Department->find('all')->where(['isdeleted' => 0]);
        
        $employeegroup = $this->Organizationreviews->Employee->EmployeeGroup->find('list',array('fields' => array('id', 'name')))->where(['isdeleted' => 0]);

        $util=new Utility();
        $yuistring =  $util->GetYUIString($departments,$employees);

        $question = $this->Organizationreviews->Question->find('list')->where(['isdeleted' => 0]);
        $questions = $this->Question->find('all')->where(['isdeleted' => 0])->toArray();
        $questioncategory = $this->Questioncategory->find('all')->where(['isdeleted' => 0])->toArray();
        $subcategory = $this->subcategory->find('all')->where(['isdeleted' => 0])->toArray();

        $util=new Utility();
        
        $yuistringDepartment =  $util->GetYUIStringForQuestions($questions,$questioncategory,$subcategory);
        //die();

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('organizationreview','reviewtype','owner','menuAry','headerAry','reviewers','question','yuistring','yuistringDepartment','employeepopup','companylist','deptlist','orglist','employeegroup','question'));
        $this->set('_serialize', ['itemreview']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Organizationreview id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $organizationreview = $this->Organizationreviews->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $organizationreview = $this->Organizationreviews->patchEntity($organizationreview, $this->request->data);
            if ($this->Organizationreviews->save($organizationreview)) 
            {
                $this->Flash->success(__('The organizationreview has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The organizationreview could not be saved. Please, try again.'));
        }

        $reviewtypes = $this->Organizationreviews->Reviewtype->find('list', ['limit' => 200]);
        $owners = $this->Organizationreviews->Employee->find('list', ['limit' => 200]);
        $this->set(compact('organizationreview', 'reviewtypes', 'owners'));
        $this->set('_serialize', ['organizationreview']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Organizationreview id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $organizationreview = $this->Organizationreviews->get($id);
        if ($this->Organizationreviews->delete($organizationreview)) 
        {
            $this->Flash->success(__('The organizationreview has been deleted.'));
        } 
        else 
        {
            $this->Flash->error(__('The organizationreview could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
