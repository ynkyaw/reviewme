<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
/**
 * Itemreviews Controller
 *
 * @property \App\Model\Table\ItemreviewsTable $Itemreviews
 */
class ItemreviewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function index()
    {
        //$this->paginate = [
           // 'contain' => ['Reviewtypes', 'Owners']
       // ];
        //$itemreviews = $this->paginate($this->Itemreviews);
        $this->Employee = TableRegistry::get('Employee');
        $this->Users = TableRegistry::get('Users');

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
        $stmt = $conn->execute("SELECT r.id,r.title,r.goal,count(DISTINCT rrw.reviewerid) as reviewers,COUNT(DISTINCT rre.revieweeid) as reviewees,count(DISTINCT rr.id) as results FROM `itemreviews` r LEFT JOIN itemreviews_reviewees rre on rre.itemreviews_id = r.id LEFT join itemreviews_reviewers rrw on r.id= rrw.itemreviews_id left JOIN itemreviewsresults rr on rr.itemreviews_id = r.id WHERE r.isdeleted =0 and r.reviewtype_id IN('5','6','7') and r.`owner_id` = ?  GROUP by r.id,r.title,r.goal", [$uid]);
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
            $itemreviews = json_decode($jsonStr);   
        }
        else
        {
            $itemreviews = null;
        }  

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('itemreviews','menuAry','headerAry'));
        $this->set('_serialize', ['itemreviews']);
    }

    /**
     * View method
     *
     * @param string|null $id Itemreview id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemreview = $this->Itemreviews->get($id, [
            'contain' => ['Reviewtype', 'Owners', 'Question']
        ]);

        $this->set('itemreview', $itemreview);
        $this->set('_serialize', ['itemreview']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addproduct()
    {
        $this->Department = TableRegistry::get('Department');
        $this->Employee = TableRegistry::get('Employee');
        $this->Question = TableRegistry::get('Question');
        $this->Questioncategory = TableRegistry::get('Questioncategory');
        $this->Product = TableRegistry::get('Products');
        $this->Project = TableRegistry::get('Projects');
        $this->Service = TableRegistry::get('Services');
        $this->subcategory = TableRegistry::get('subcategory');        

        $itemreview = $this->Itemreviews->newEntity();

        if ($this->request->is('post')) 
        {
            $itemreview = $this->Itemreviews->patchEntity($itemreview, $this->request->data);
           // echo json_encode($itemreview);

            $myReview = $this->Itemreviews->newEntity();
            $myReview->title = $itemreview->title; 
            $myReview->description = $itemreview->description;
            $myReview->title = $itemreview->title; 
            $myReview->goal = $itemreview->goal;
            $myReview->owner_id = $itemreview->owner_id;
            $myReview->Employee = $itemreview->Employee;
            $myReview->startdate = $itemreview->startdate; 
            $myReview->enddate = $itemreview->enddate;
            $myReview->Reviewees = $itemreview->Reviewees; 
            $myReview->Reviewees = $itemreview->Reviewers; 
            $myReview->Question = $itemreview->Question;
            $myReview->Employee = $itemreview->Employee;
            $myReview->reviewtype_id = $itemreview->reviewtype_id;
           
            if ($this->Itemreviews->save($myReview))
            {            
                $this->Flash->success(__('The itemreview has been saved.'));
   
                $this->itemreviewsreviewees = TableRegistry::get('ItemreviewsReviewees');
                $myr_re = $this->itemreviewsreviewees->newEntity();
                $myr_re->revieweeid = $itemreview->revieweeid;//$reid;
                $myr_re->itemreviews_id = $myReview->id;
                //echo "<br/> ReviewReviewee : ".json_encode($myr_re);

                if ($this->itemreviewsreviewees->save($myr_re))
                {
                    echo "<br/>Status:Success";
                }
                else
                {
                    echo "<br/>Status:Failed";
                }

                $jsonStr =  json_encode($itemreview->Reviewers);
                $jsonStr = str_replace('_', '', $jsonStr); //substr($jsonStr,2,1);
                $reviewersarray = json_decode($jsonStr);
                $rw_array = $reviewersarray->ids;
                foreach ($rw_array as $rwid) 
                {                    
                    $this->itemreviewsreviewers = TableRegistry::get('ItemreviewsReviewers');
                    $myr_rw = $this->itemreviewsreviewers->newEntity();
                    $myr_rw->reviewerid = $rwid;
                    $myr_rw->itemreviews_id = $myReview->id;
                    //echo "<br/> ReviewReviewer : ".json_encode($myr_rw);

                    if ($this->itemreviewsreviewers->save($myr_rw))
                    {
                        echo "<br/>Status:Success12";
                    }
                    else
                    {
                        echo "<br/>Status:Failed";
                    }
                }
                
                $jsonStr =  json_encode($itemreview->Question_ids);               
                //echo "<br/>Question".$jsonStr;

                $questarray = $itemreview->Question_ids;
                foreach ($questarray as $rqid) 
                {   
                    $this->itemreviewsquestion = TableRegistry::get('ItemreviewsQuestion');
                    $myr_q = $this->itemreviewsquestion->newEntity();
                    $myr_q->question_id = $rqid;
                    $myr_q->itemreviews_id = $myReview->id;
                    //echo "<br/> ReviewReviewer : ".json_encode($myr_q);

                    if ($this->itemreviewsquestion->save($myr_q))
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
            $this->Flash->error(__('The itemreview could not be saved. Please, try again.'));
        }

        $reviewtype = $this->Itemreviews->Reviewtype->find('list')->where(['isdeleted' =>0,'id >=' =>5,'id <=' => 7]);
        $productlist = $this->Product->find('list')->where(['isdeleted' => 0])->toArray();
        $projectlist = $this->Project->find('list')->where(['isdeleted' => 0])->toArray();
        $servicelist = $this->Service->find('list')->where(['isdeleted' => 0])->toArray();

        $owner = $this->Itemreviews->Employee->find('list')->where(['isdeleted' => 0])->toArray();
        $reviewers = $this->Itemreviews->Employee->find('list')->where(['isdeleted' =>0]);
        
        $employees= $this->Employee->find('all')->where(['isdeleted' => 0]);
        $employeepopup = $this->Employee->find('all')->contain(['rank','department','jobposition']);
        $departments = $this->Department->find('all')->where(['isdeleted' => 0]);
        
        $employeegroup = $this->Itemreviews->Employee->EmployeeGroup->find('list',array('fields' => array('id', 'name')))->where(['isdeleted' => 0]);

        $util=new Utility();
        $yuistring =  $util->GetYUIString($departments,$employees);

        $question = $this->Itemreviews->Question->find('list')->where(['isdeleted' => 0]);
        $questions = $this->Question->find('all')->where(['isdeleted' => 0])->toArray();
        $questioncategory = $this->Questioncategory->find('all')->where(['isdeleted' => 0])->toArray();
        $subcategory = $this->subcategory->find('all')->where(['isdeleted' => 0])->toArray();
        //echo "sub ".$subcategory;

        $util=new Utility();
        
        $yuistringDepartment =  $util->GetYUIStringForQuestions($questions,$questioncategory,$subcategory);
        //die();

        //$layout = $this->getauthorization();
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('itemreview','reviewtype','owner','menuAry','headerAry','reviewers','question','yuistring','yuistringDepartment','employeepopup','servicelist','projectlist','productlist','employeegroup','question'));
        $this->set('_serialize', ['itemreview']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Itemreview id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemreview = $this->Itemreviews->get($id, [
            'contain' => ['Question']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemreview = $this->Itemreviews->patchEntity($itemreview, $this->request->data);
            if ($this->Itemreviews->save($itemreview)) {
                $this->Flash->success(__('The itemreview has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The itemreview could not be saved. Please, try again.'));
        }
        //$reviewtypes = $this->Itemreviews->Reviewtypes->find('list', ['limit' => 200]);
        $owners = $this->Itemreviews->Owners->find('list', ['limit' => 200]);
        $question = $this->Itemreviews->Question->find('list', ['limit' => 200]);
        $this->set(compact('itemreview', 'reviewtypes', 'owners', 'question'));
        $this->set('_serialize', ['itemreview']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Itemreview id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemreview = $this->Itemreviews->get($id);
        if ($this->Itemreviews->delete($itemreview)) {
            $this->Flash->success(__('The itemreview has been deleted.'));
        } else {
            $this->Flash->error(__('The itemreview could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
