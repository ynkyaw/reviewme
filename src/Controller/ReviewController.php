<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use App\Model\Entity\Device;
use Cake\Mailer\Email;
use Cake\Cache\Cache;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Log\Log;
use Cake\Routing\Router;
use Cake\Utility\Text;
use Cake\I18n\Time;

/**
 * Review Controller
 *
 * @property \App\Model\Table\ReviewTable $Review
 */
class ReviewController extends AppController
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
        $stmt = $conn->execute('SELECT r.id,r.title,r.goal,COUNT(DISTINCT rc.id) categories,count(DISTINCT rcrw.reviewer_id) as reviewers,COUNT(DISTINCT rre.revieweeid) as reviewees,count(DISTINCT rr.id) as results FROM `review` r left join reviewcategory rc on rc.reviewid =r.id LEFT JOIN review_reviewee rre on rre.reviewid = r.id LEFT join reviewcategory_reviewer rcrw on rc.id= rcrw.reviewcategory_id left  JOIN reviewresult rr on rr.reviewid = r.id WHERE r.reviewtype_id = 1 and r.isdeleted = 0 and rc.isdeleted = 0 and rr.finish = 1 and r.`owner_id` = ?  GROUP by r.id,r.title,r.goal', [$uid]);
        $rows = $stmt->fetchAll('assoc');            
        if(count($rows)>0)
        {       
            $jsonStr = "{\"result\":[";
            foreach ($rows as $row) 
            {
                // Do work
                $jsonStr .= json_encode($row).",";
            }

            $jsonStr=substr_replace($jsonStr,"", strlen($jsonStr)-1);
            $jsonStr .="]}";
            $topdown = json_decode($jsonStr);     
        }
        else
        {
            $topdown = null;
        }
        //echo $jsonStr;        
        
        //echo json_encode($topdown->result);

        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT r.id,r.title,r.goal,count(DISTINCT rrw.reviewerid) as reviewers,COUNT(DISTINCT rre.revieweeid) as reviewees,count(DISTINCT rr.id) as results FROM `review` r LEFT JOIN review_reviewee rre on rre.reviewid = r.id LEFT join review_reviewer rrw on r.id= rrw.reviewid left JOIN reviewresult rr on rr.reviewid = r.id WHERE r.isdeleted =0 and rr.finish=1 and r.reviewtype_id = 2 and r.`owner_id` = ?  GROUP by r.id,r.title,r.goal', [$uid]);
        $rows = $stmt->fetchAll('assoc');            
        
        if(count($rows)>0)
        {       
            $jsonStr = "{\"result\":[";
            foreach ($rows as $row) 
            {
                // Do work
                $jsonStr .= json_encode($row).",";
            }

            $jsonStr=substr_replace($jsonStr,"", strlen($jsonStr)-1);
            $jsonStr .="]}";
            //echo $jsonStr;     
            $bottomup = json_decode($jsonStr);   
        }
        else
        {
            $bottomup = null;
        }

        //echo $jsonStr;   

        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT r.id,r.title,r.goal,r.maxreview,r.minreview,r.maxreviewed,COUNT(DISTINCT rc.id) categories,count(DISTINCT rcrw.reviewer_id) as reviewers,COUNT(DISTINCT rre.revieweeid) as reviewees,count(DISTINCT rr.id) as results FROM `review` r left join reviewcategory rc on rc.reviewid =r.id LEFT JOIN review_reviewee rre on rre.reviewid = r.id LEFT join reviewcategory_reviewer rcrw on rc.id= rcrw.reviewcategory_id left  JOIN reviewresult rr on rr.reviewid = r.id WHERE  r.isdeleted =0 and rc.isdeleted = 0 and rr.finish=1 and r.reviewtype_id = 3 and r.`owner_id` = ? GROUP by r.id,r.title,r.goal,r.maxreview,r.minreview,r.maxreviewed', [$uid]);
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
            $review360 = json_decode($jsonStr); 
        }
        else
        {
            $review360 = null;
        }

        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT r.id,r.title,r.goal,count(DISTINCT rrw.reviewerid) as reviewers,COUNT(DISTINCT rre.revieweeid) as reviewees,count(DISTINCT rr.id) as results FROM `review` r LEFT JOIN review_reviewee rre on rre.reviewid = r.id LEFT join review_reviewer rrw on r.id= rrw.reviewid left JOIN reviewresult rr on rr.reviewid = r.id WHERE r.isdeleted =0 and rr.finish = 1 and r.reviewtype_id = 4 and r.`owner_id` = ?  GROUP by r.id,r.title,r.goal', [$uid]);

        $rows = $stmt->fetchAll('assoc');     
        if(count($rows)>0)
        {       
            $jsonStr = "{\"result\":[";
            foreach ($rows as $row) 
            {
                // Do work
                $jsonStr .= json_encode($row).",";
            }

            $jsonStr=substr_replace($jsonStr,"", strlen($jsonStr)-1);
            $jsonStr .="]}";
        //echo $jsonStr;       
            $performanceapprisal = json_decode($jsonStr); 
        }
        else
        {
            $performanceapprisal = null;
        }        
        
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('topdown','bottomup','review360','performanceapprisal','menuAry','headerAry'));
        $this->set('_serialize', ['topdown','bottomup','review360','performanceapprisal']);
    }

    public function organizationindex()
    {
        $this->Employee = TableRegistry::get('Employee');
        //get current login user from session
        $session = $this->request->session();
        $userid = $session->read('userid');
        
        $employee = $this->Employee->find('all')->where(['userid'=>$userid,'isdeleted' => 0])->first();
        $uid = 0;
        if($employee != null)
        {            
            $uid = $employee->id;
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('topdown','bottomup','review360','menuAry','headerAry'));
        $this->set('_serialize', ['topdown','bottomup','review360']);
    }


    /**
     * View method
     *
     * @param string|null $id Review id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $review = $this->Review->get($id, [
            'contain' => ['Question']
        ]);

        $this->set('review', $review);
        $this->set('_serialize', ['review']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Users = TableRegistry::get('Users');
        $this->Department = TableRegistry::get('Department');
        $this->Employee = TableRegistry::get('Employee');
        $this->Question = TableRegistry::get('Question');
        $this->Questioncategory = TableRegistry::get('Questioncategory');
        $this->subcategory = TableRegistry::get('subcategory');
        $this->ReviewCategory = TableRegistry::get('Reviewcategory');
        $review = $this->Review->newEntity();
        //$review->owner_id = 0;
        $myReviewees = null;
        if ($this->request->is('post')) 
        {
            $review = $this->Review->patchEntity($review, $this->request->data);
            //echo "Original Review:".json_encode($review);
            echo "Original Review:".json_encode($review);
            
            $myReview = $this->Review->newEntity();
            $myReview->title = $review->title; 
            $myReview->description = $review->description;
            $myReview->title = $review->title; 
            $myReview->goal = $review->goal;
            $myReview->owner_id = $review->owner_id;
            $myReview->Employee = $review->Employee;
            $myReview->startdate = $review->startdate; 
            $myReview->enddate = $review->enddate;
            $myReview->Reviewees = $review->Reviewees; 
            $myReview->Employee = $review->Employee;
            $myReview->reviewtype_id =1 ;
            $myReview->maxreview = null;
            $myReview->maxreviewed = null;
            $myReview->minreview = null;

            
            //eviewees = $review->reviewees;
            //echo "<br/> REVIEWEE:". json_encode($revieweesarray->ids);
            
            if ($this->Review->save($myReview)) 
            {
                $this->Flash->success(__('The review has been saved.'));

                $jsonStr =  json_encode($review->Reviewees);
                $jsonStr = str_replace('_', '', $jsonStr); //substr($jsonStr,2,1);
                $revieweesarray = json_decode($jsonStr);
                $re_array = $revieweesarray->ids;
                foreach ( $re_array as $reid) 
                {   
                    $this->ReviewReviewee = TableRegistry::get('ReviewReviewee');
                    $myr_re = $this->ReviewReviewee->newEntity();
                    $myr_re->revieweeid = $reid;
                    $myr_re->reviewid = $myReview->id;
                    echo "<br/> ReviewReviewee : ".json_encode($myr_re);

                    if ($this->ReviewReviewee->save($myr_re))
                    {
                        echo "<br/>Status:Success";
                    }
                    else
                    {
                        echo "<br/>Status:Failed";
                    }
                }
                //die();

                $reviewcategories = $review->reviewcategory;
                foreach ($reviewcategories as $rc) 
                {                   
                    $myreviewcategory = $this->ReviewCategory->get($rc->id);
                    $myreviewcategory->reviewid = $myReview->id;
                    //echo "<br/>RC_:".$myreviewcategory;

                    if ($this->ReviewCategory->save($myreviewcategory))
                    {
                        echo "<br/>Status:Success";
                    }
                    else
                    {
                        echo "<br/>Status:Failed";
                    }
                }

                $this->Flash->success(__('The review has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                echo "Error".$review;    
            }

            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        
        $reviewtype = $this->Review->Reviewtype->find('list')->where(['isdeleted' => 0]);
        //echo "sf ".$reviewtype;
        $owner= $this->Review->Employee->find('list')->where(['isdeleted' => 0])->toArray();
        $reviewers = $this->Review->Employee->find('list')->where(['isdeleted' => 0]);
        $reviewees = $this->Review->Employee->find('list')->where(['isdeleted' => 0]);
        $reviewcategories =  $this->ReviewCategory->find('list')->where(['isdeleted' => 0]);
        
        $employees= $this->Employee->find('all')->where(['isdeleted' => 0]);
        $departments = $this->Department->find('all')->where(['isdeleted' => 0]);        
        $employeegroup = $this->Review->Employee->EmployeeGroup->find('list',array('fields' => array('id', 'name')))->where(['isdeleted' => 0]);
        $questions = $this->Question->find('all')->where(['isdeleted' => 0])->toArray();
        $questioncategory = $this->Questioncategory->find('all')->where(['isdeleted' => 0])->toArray();
        $subcategory = $this->subcategory->find('all')->where(['isdeleted'=> 0 ])->toArray();
      
        if(count($employees)<1)
        {
            return $this->redirect([ 'controller'=>'Employee','action' => 'index']);
        }
        
        if(count($departments)<1)
        {
            return $this->redirect([ 'controller'=>'Department','action' => 'index']);
        }

        if(count($questions)<1)
        {
            return $this->redirect([ 'controller'=>'Question','action' => 'index']);
        }
        
        if(count($questioncategory)<1)
        {
            return $this->redirect([ 'controller'=>'Questioncategory','action' => 'index']);
        }

        $util=new Utility();
        $yuistring =  $util->GetYUIString($departments,$employees);
        
        $util=new Utility();

        if(count($questioncategory)>0 && count($questions)>0)
                $yuistringDepartment =  $util->GetYUIStringForQuestions($questions,$questioncategory,$subcategory);
        else $yuistringDepartment = "null";
        //echo json_encode($yuistring);
        
        $owner[0]="";

        $employeepopup = $this->Employee->find('all')->contain(['rank','department','jobposition']);
        $util=new Utility();
        //$empdata =  $util->GetJOSNForDataGrid($employee);
        
        $question = $this->Review->Question->find('list')->where(['isdeleted' => 0]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;
        
        $this->set(compact('review', 'question','reviewtype','owner','menuAry','headerAry','reviewers','reviewees','departments','myReviewees','yuistring','yuistringDepartment','employeegroup','employeepopup','reviewcategories'));
        
        $this->set('_serialize', ['review','departments','myReviewees','reviewcategories']);        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addbottomup()
    {
        $this->Department = TableRegistry::get('Department');
        $this->Employee = TableRegistry::get('Employee');
        $this->Question = TableRegistry::get('Question');
        $this->Questioncategory = TableRegistry::get('Questioncategory');
        $this->subcategory = TableRegistry::get('subcategory');
        $this->ReviewCategory = TableRegistry::get('Reviewcategory');
        $review = $this->Review->newEntity();
        $review->owner_id = 1;
        $myReviewees = null;
        if ($this->request->is('post')) 
        {
            $review = $this->Review->patchEntity($review, $this->request->data);
            echo "Original Review:".json_encode($review);
            
            $myReview = $this->Review->newEntity();
            $myReview->title = $review->title; 
            $myReview->description = $review->description;
            $myReview->title = $review->title; 
            $myReview->goal = $review->goal;
            $myReview->owner_id = $review->owner_id;
            $myReview->Employee = $review->Employee;
            $myReview->startdate = $review->startdate; 
            $myReview->enddate = $review->enddate;
            $myReview->Reviewees = $review->Reviewees; 
            $myReview->Reviewees = $review->Reviewers; 
            $myReview->Question = $review->Question;
            $myReview->Employee = $review->Employee;
            $myReview->reviewtype_id =2;
            $myReview->maxreview = null;
            $myReview->maxreviewed = null;
            $myReview->minreview = null;
           
            if ($this->Review->save($myReview)) 
            {
                $this->Flash->success(__('The review has been saved.'));
                $jsonStr =  json_encode($review->Reviewees);
                $jsonStr = str_replace('_', '', $jsonStr); //substr($jsonStr,2,1);
                $revieweesarray = json_decode($jsonStr);
                $re_array = $revieweesarray->ids;
                foreach ( $re_array as $reid) 
                {   
                    $this->ReviewReviewee = TableRegistry::get('ReviewReviewee');
                    $myr_re = $this->ReviewReviewee->newEntity();
                    $myr_re->revieweeid = $reid;
                    $myr_re->reviewid = $myReview->id;
                    echo "<br/> ReviewReviewee : ".json_encode($myr_re);

                    if ($this->ReviewReviewee->save($myr_re))
                    {
                        echo "<br/>Status:Success";
                    }else{
                        echo "<br/>Status:Failed";
                    }
                }

                $jsonStr =  json_encode($review->Reviewers);
                $jsonStr = str_replace('_', '', $jsonStr); //substr($jsonStr,2,1);
                $reviewersarray = json_decode($jsonStr);
                $rw_array = $reviewersarray->ids;
                foreach ( $rw_array as $rwid) 
                {   
                    $this->ReviewReviewer = TableRegistry::get('ReviewReviewer');
                    $myr_rw = $this->ReviewReviewer->newEntity();
                    $myr_rw->reviewerid = $rwid;
                    $myr_rw->reviewid = $myReview->id;
                    echo "<br/> ReviewReviewer : ".json_encode($myr_rw);

                    if ($this->ReviewReviewer->save($myr_rw))
                    {
                        echo "<br/>Status:Success";
                    }
                    else
                    {
                        echo "<br/>Status:Failed";
                    }
                }
                
                $jsonStr =  json_encode($review->Question_ids);
                //$jsonStr = str_replace('_', '', $jsonStr); 
                echo "<br/>Question".$jsonStr;
                // die();
                // $q_array = json_decode($jsonStr);
                $questarray = $review->Question_ids;
                foreach ( $questarray as $rqid) 
                {   
                    $this->ReviewQuestion = TableRegistry::get('Reviewquestion');
                    $myr_q = $this->ReviewQuestion->newEntity();
                    $myr_q->questionid = $rqid;
                    $myr_q->reviewid = $myReview->id;
                    echo "<br/> ReviewReviewer : ".json_encode($myr_q);

                    if ($this->ReviewQuestion->save($myr_q))
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
            else
            {
                echo "Error".$review;    
            }

            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        
        $reviewtype = $this->Review->Reviewtype->find('list')->where(['isdeleted' => 0]);
        $owner= $this->Review->Employee->find('list')->where(['isdeleted' =>0])->toArray();
        $reviewers = $this->Review->Employee->find('list')->where(['isdeleted' => 0]);
        $reviewees = $this->Review->Employee->find('list')->where(['isdeleted' => 0]);
        $reviewcategories =  $this->ReviewCategory->find('list')->where(['isdeleted' => 0]);
        
        $employees= $this->Employee->find('all')->where(['isdeleted' => 0]);
        $departments = $this->Department->find('all')->where(['isdeleted' => 0]);
        
        $employeegroup = $this->Review->Employee->EmployeeGroup->find('list',array('fields' => array('id', 'name')))->where(['isdeleted' => 0]);

        $util=new Utility();
        $yuistring =  $util->GetYUIString($departments,$employees);

        $questions = $this->Question->find('all')->where(['isdeleted' => 0])->toArray();
        $questioncategory = $this->Questioncategory->find('all')->where(['isdeleted' => 0])->toArray();
        $subcategory = $this->subcategory->find('all')->where(['isdeleted' => 0])->toArray();

        $util=new Utility();

        $yuistringDepartment =  $util->GetYUIStringForQuestions($questions,$questioncategory,$subcategory);
        //echo json_encode($yuistring);
        
        $owner[0]="";

        $employeepopup = $this->Employee->find('all')->contain(['rank','department','jobposition']);
        $util=new Utility();
        //$empdata =  $util->GetJOSNForDataGrid($employee);
        
        $question = $this->Review->Question->find('list')->where(['isdeleted' => 0]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('review','headerAry','menuAry','question','reviewtype','owner','reviewers','reviewees','departments','myReviewees','yuistring','yuistringDepartment','employeegroup','employeepopup','reviewcategories'));
        $this->set('_serialize', ['review','departments','myReviewees','reviewcategories']);        
    }

    public function doreview($dreviewee=null,$dreview=null,$dreviewer=null,$drevtype=null,$drevowner=null)
    {
        if($dreviewee != null && $dreview != null && $dreviewer != null && $drevtype != null && $drevowner!=null)
        {
            $plainreviewee = base64_decode($dreviewee);            
            $plainarrayreviewee = explode(",", $plainreviewee);
            $erevieweeid = $plainarrayreviewee[0];

            $plainreview = base64_decode($dreview);            
            $plainarrayreview = explode(",", $plainreview);
            $ereviewid = $plainarrayreview[0];

            $plainreviewer = base64_decode($dreviewer);            
            $plainarrayreviewer = explode(",", $plainreviewer);
            $ereviewerid = $plainarrayreviewer[0];

            $plainreviewtype = base64_decode($drevtype);            
            $plainarrayreviewtype = explode(",", $plainreviewtype);
            $ereviewertypeid = $plainarrayreviewtype[0];

            $plainreviewowner = base64_decode($drevowner);
            $plainarrayreviewowner = explode(",",$plainreviewowner);
            $ereviewowner = $plainarrayreviewowner[0];

            return $this->redirect(['controller'=>'reviewpage','action'=>'index',$erevieweeid,$ereviewid,0,0,$ereviewerid,$ereviewertypeid,$ereviewowner]);
        }
        else
        {
            echo "Access Denied!";
            die();
        }
    }

    public function doreviewmg($dreviewmg=null,$dreviewtitle=null,$dreviewer=null)
    {
        if($dreviewmg != null && $dreviewtitle != null && $dreviewer != null)
        {
            $plainreviewmg = base64_decode($dreviewmg);            
            $plainarrayreviewmg = explode(",", $plainreviewmg);
            $ereviewidmg = $plainarrayreviewmg[0];

            $plainreviewtitlemg = base64_decode($dreviewtitle);            
            $plainarrayreviewtitlemg = explode(",", $plainreviewtitlemg);
            $ereviewtitlemg = $plainarrayreviewtitlemg[0];  

            $plainreviewermg = base64_decode($dreviewer);            
            $plainarrayreviewermg = explode(",", $plainreviewermg);
            $ereviewermg = $plainarrayreviewermg[0];  

            /*$plainrevieweemg = base64_decode($dreviewee);
            $plainarrayrevieweemg = explode(",", $plainrevieweemg);
            $erevieweemg = $plainarrayrevieweemg[0]; */    

            return $this->redirect(['controller'=>'reviewlist','action'=>'indexpa',$ereviewidmg,$ereviewtitlemg,$ereviewermg,0]);
        }
        else
        {
            echo "Review Can't Available";
            die();
        }
    }

    public function mailToReviewer($revid,$reverid,$reveeid,$revtit,$uname,$uemail)
    {        
        try
        {                            
            $reviewplainmg = $revid;
            $encryptedreviewplainmg = base64_encode($reviewplainmg);

            $reviewtitleplain = $revtit;
            $encryptedreviewtitleplain = base64_encode($reviewtitleplain);

          /*  $revieweeplainmg = $reveeid;
            $encryptedrevieweeplainmg = base64_encode($revieweeplainmg); */           

            $reviewerplainmg = $reverid;
            $encryptedreviewerplainmg = base64_encode($reviewerplainmg);

            $body = 'Hi '.$uname;
            $body = $body.",<br/>";
            $body = $body."<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            $body = $body."Please REVIEW to your EMPLOYEES in ".$revtit." Review. <br/>";
            $body = $body."To Do Review, click ";
            $body = $body."<a href='".Router::url('/', true)."review/doreviewmg/";
            $body = $body.$encryptedreviewplainmg."/".$encryptedreviewtitleplain."/".$encryptedreviewerplainmg."' > here</a> or paste the following link ";
            $body = $body."into your browser <u>".Router::url('/', true);
            $body = $body."review/doreviewmg/".$encryptedreviewplainmg."/".$encryptedreviewtitleplain."/".$encryptedreviewerplainmg."</u>.<br/>";
            $body = $body ."Thanks for using ReviewMe!<br/>";
            $body = $body ."The ReviewMe Team";

            $send_email = new Email('default');
            $send_email->from(['reviewme.owner@gmail.com' => 'ReviewMe Team'])
                ->emailFormat('html')
                ->to($uemail)
                ->subject($uname.',here\'s the link to REVIEW your EMPLOYEES')
                ->send($body);

        }catch(\Exception $e)
        {
        }
    }    

    public function addperformanceapprisal()
    {
        $this->Department = TableRegistry::get('Department');
        $this->Employee = TableRegistry::get('Employee');
        $this->Users = TableRegistry::get('Users');
        $this->Question = TableRegistry::get('Question');
        $this->Questioncategory = TableRegistry::get('Questioncategory');
        $this->subcategory = TableRegistry::get('subcategory');
        $this->ReviewCategory = TableRegistry::get('Reviewcategory');
        $review = $this->Review->newEntity();
        $myReviewees = null;
        
        if ($this->request->is('post')) 
        {
            //echo "yes , it's post ".$this->request->data;
            $review = $this->Review->patchEntity($review, $this->request->data);
           //echo "Original Review:".json_encode($review);
            
            $myReview = $this->Review->newEntity();
            $myReview->title = $review->title; 
            $myReview->description = $review->description;
            $myReview->title = $review->title; 
            $myReview->goal = $review->goal;
            $myReview->owner_id = $review->owner_id;
            $myReview->Employee = $review->Employee;
            $myReview->startdate = $review->startdate; 
            $myReview->enddate = $review->enddate;
            $myReview->Reviewees = $review->Reviewees; 
            $myReview->Reviewees = $review->Reviewers; 
            $myReview->Question = $review->Question;
            $myReview->Employee = $review->Employee;
            $myReview->reviewtype_id =4 ;
            $myReview->maxreview = null;
            $myReview->maxreviewed = null;
            $myReview->minreview = null;
           
            if ($this->Review->save($myReview)) 
            {
                $this->Flash->success(__('The review has been saved.'));

                $jsonStr =  json_encode($review->Reviewees);
                $jsonStr = str_replace('_', '', $jsonStr); //substr($jsonStr,2,1);
                $revieweesarray = json_decode($jsonStr);
                $re_array = $revieweesarray->ids;

                foreach ( $re_array as $reid) 
                {   
                    $this->ReviewReviewee = TableRegistry::get('ReviewReviewee');
                    $myr_re = $this->ReviewReviewee->newEntity();
                    $myr_re->revieweeid = $reid;
                    $myr_re->reviewid = $myReview->id;
                    //echo "<br/> ReviewReviewee : ".json_encode($myr_re);

                    if ($this->ReviewReviewee->save($myr_re))
                    {
                        echo "<br/>Status:Success";
                    }
                    else
                    {
                        echo "<br/>Status:Failed";
                    }
                }

                $jsonStr =  json_encode($review->Reviewers);
                $jsonStr = str_replace('_', '', $jsonStr); //substr($jsonStr,2,1);
                $reviewersarray = json_decode($jsonStr);
                $rw_array = $reviewersarray->ids;
                foreach ( $rw_array as $rwid) 
                {                    
                    $this->ReviewReviewer = TableRegistry::get('ReviewReviewer');
                    $myr_rw = $this->ReviewReviewer->newEntity();
                    $myr_rw->reviewerid = $rwid;
                    $myr_rw->reviewid = $myReview->id;
                    //echo "<br/> ReviewReviewer : ".json_encode($myr_rw);

                    if ($this->ReviewReviewer->save($myr_rw))
                    {
                        echo "<br/>Status:Success";
                    }
                    else
                    {
                        echo "<br/>Status:Failed";
                    }
                }
                
                $jsonStr =  json_encode($review->Question_ids);               
                //echo "<br/>Question".$jsonStr;

                $questarray = $review->Question_ids;
                foreach ( $questarray as $rqid) 
                {   
                    $this->ReviewQuestion = TableRegistry::get('Reviewquestion');
                    $myr_q = $this->ReviewQuestion->newEntity();
                    $myr_q->questionid = $rqid;
                    $myr_q->reviewid = $myReview->id;
                    //echo "<br/> ReviewReviewer : ".json_encode($myr_q);

                    if ($this->ReviewQuestion->save($myr_q))
                    {
                        echo "<br/>Status:Success";
                    }
                    else
                    {
                        echo "<br/>Status:Failed";
                    }
                }
            }
            
            //sending email
            $allrevieweesinreview = array();

            foreach ($re_array as $reviewee) 
            {
                array_push($allrevieweesinreview,$reviewee);
            }

            foreach ($allrevieweesinreview as $emp) 
            {
                $empinfo = $this->Employee->find('all')->where(['id' => $emp,'isdeleted' => 0])->first();
                $user = $this->Users->find('all')->where(['id' => $empinfo->userid,'isdeleted' =>0])->first();
                //$revtype = $this->Review->find('all')->where(['id' => $myReview->id])->first();

                if($user==null)
                {
                     echo "<div class='alert alert-warning'>Email doesn't exist!</div>";
                     die();
                }
                else
                {
                    try
                    {
                        $revieweeplain = $emp;
                        $encryptedrevieweeplain = base64_encode($revieweeplain);

                        $reviewplain = $myReview->id;
                        $encryptedreviewplain = base64_encode($reviewplain);

                        $reviewerplain = $user->id;//$myReview->owner_id
                        $encryptedreviewerplain = base64_encode($reviewerplain);

                        $reviewtypeplain = $myReview->reviewtype_id;
                        $encryptedreviewtypeplain = base64_encode($reviewtypeplain);

                        $reviewownerplain = $myReview->owner_id;
                        $encryptedreviewownerplain = base64_encode($reviewownerplain);

                        $body = 'Hi '.$user->username;
                        $body = $body.",<br/>";
                        $body = $body."<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        $body = $body."Please REVIEW To YOURSELF in ".$myReview->title." Review. <br/>";
                        $body = $body."To Do Review, click ";
                        $body = $body."<a href='".Router::url('/', true)."review/doreview/";
                        $body = $body.$encryptedrevieweeplain."/".$encryptedreviewplain."/".$encryptedreviewerplain."/".$encryptedreviewtypeplain."/".$encryptedreviewownerplain."' > here</a> or paste the following link ";
                        $body = $body."into your browser <u>".Router::url('/', true);
                        $body = $body."review/doreview/".$encryptedrevieweeplain."/".$encryptedreviewplain."/".$encryptedreviewerplain."/".$encryptedreviewtypeplain."/".$encryptedreviewownerplain."</u>.<br/>";                            
                        $body = $body ."Thanks for using ReviewMe!<br/>";
                        $body = $body ."The ReviewMe Team";

                        $send_email = new Email('default');
                        $send_email->from(['reviewme.owner@gmail.com' => 'ReviewMe Team'])
                            ->emailFormat('html')
                            ->to($user->email)
                            ->subject($user->username.',here\'s the link to REVIEW YOURSELF')
                            ->send($body);

                    }catch(\Exception $e)
                    {
                    }
                }
            }
            return $this->redirect(['action' => 'index']);
            //$this->Flash->error(__('The review could not be saved. Please, try again.'));
        }        

        $owner= $this->Review->Employee->find('list')->where(['isdeleted' => 0])->toArray();
        $owner[0]="";

        $employeepopup = $this->Employee->find('all')->contain(['rank','department','jobposition']);
        $reviewees = $this->Review->Employee->find('list')->where(['isdeleted' => 0]);
        $employeegroup = $this->Review->Employee->EmployeeGroup->find('list',array('fields' => array('id', 'name')))->where(['isdeleted' => 0]);

        if(sizeof($employeegroup->toArray())==0)
            $employeegroup = json_decode('{"0":"None"}');

        $employees= $this->Employee->find('all')->where(['isdeleted' => 0]);
        $departments = $this->Department->find('all')->where(['isdeleted' => 0]);
        $question = $this->Review->Question->find('list')->where(['isdeleted' => 0]);

        $reviewtype = $this->Review->Reviewtype->find('list')->where(['isdeleted' =>0]);
        $util=new Utility(); 
        $yuistring =  $util->GetYUIString($departments,$employees);

        $questions = $this->Question->find('all')->where(['isdeleted' =>0])->toArray();
        $questioncategory = $this->Questioncategory->find('all')->where(['isdeleted' => 0])->toArray();
        $subcategory = $this->subcategory->find('all')->where(['isdeleted' => 0])->toArray();

        $util=new Utility();
        $yuistringDepartment =  $util->GetYUIStringForQuestions($questions,$questioncategory,$subcategory);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('review','headerAry','menuAry','owner','reviewtype','employeepopup','question','yuistringDepartment','reviewees','employeegroup','yuistring'));        
        $this->set('_serialize', ['review']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add360()
    {
        $this->Department = TableRegistry::get('Department');
        $this->Employee = TableRegistry::get('Employee');
        $this->Question = TableRegistry::get('Question');
        $this->Questioncategory = TableRegistry::get('Questioncategory');
        $this->subcategory = TableRegistry::get('subcategory');
        $this->ReviewCategory = TableRegistry::get('Reviewcategory');
        $review = $this->Review->newEntity();
        //$review->owner_id = 0;
        $myReviewees = null;
        if ($this->request->is('post')) {
            $review = $this->Review->patchEntity($review, $this->request->data);
            echo "Original Review:".json_encode($review);
            $myReview = $this->Review->newEntity();
            $myReview->title = $review->title; 
            $myReview->description = $review->description;
            $myReview->title = $review->title; 
            $myReview->goal = $review->goal;
            $myReview->owner_id = $review->owner_id;
            $myReview->Employee = $review->Employee;
            $myReview->startdate = $review->startdate; 
            $myReview->enddate = $review->enddate;
            $myReview->Reviewees = $review->Reviewees; 
            $myReview->Employee = $review->Employee;
            $myReview->reviewtype_id =3 ;
            $myReview->maxreview = $review->maxreview;
            $myReview->maxreviewed = $review->maxreviewed;
            $myReview->minreview = $review->minreview;
            $myReview->is_self = $review->is_self;
            //echo "Converted Review:".json_encode($myReview);            
               
            if ($this->Review->save($myReview)) {
                $this->Flash->success(__('The review has been saved.'));

                $jsonStr =  json_encode($review->Reviewees);
                $jsonStr = str_replace('_', '', $jsonStr); //substr($jsonStr,2,1);
                
                $revieweesarray = json_decode($jsonStr);
                $re_array = $revieweesarray->ids;
                foreach ( $re_array as $reid) 
                {                    
                    $this->ReviewReviewee = TableRegistry::get('ReviewReviewee');
                    $myr_re = $this->ReviewReviewee->newEntity();
                    $myr_re->revieweeid = $reid;
                    $myr_re->reviewid = $myReview->id;
                    $this->ReviewReviewer = TableRegistry::get('ReviewReviewer');
                    $myr_rw = $this->ReviewReviewee->newEntity();
                    $myr_rw->reviewerid = $reid;
                    $myr_rw->reviewid = $myReview->id;
                    //echo "<br/> ReviewReviewer : ".json_encode($myr_rw);
                    //echo "<br/> ReviewReviewee : ".json_encode($myr_re);
                    if ($this->ReviewReviewee->save($myr_re))
                    {
                        //echo "<br/>Status:Success";
                    }else{
                       // echo "<br/>Status:Failed";
                    }
                    if ($this->ReviewReviewer->save($myr_rw))
                    {
                       // echo "<br/>Status:Success";
                    }else{
                        //echo "<br/>Status:Failed";
                    }
                }

                $jsonStr =  json_encode($review->Questions_ids);
                //$jsonStr = str_replace('_', '', $jsonStr); 
                
                // $q_array = json_decode($jsonStr);
                $questarray = $review->Questions_ids;
                foreach ( $questarray as $rqid) 
                {   
                    $this->ReviewQuestion = TableRegistry::get('ReviewQuestion');
                    $myr_q = $this->ReviewQuestion->newEntity();
                    $myr_q->questionid = $rqid;
                    $myr_q->reviewid = $myReview->id;
                    //echo "<br/> Question : ".json_encode($myr_q);
                    
                    if ($this->ReviewQuestion->save($myr_q))
                    {
                        //echo "<br/>Status:Success";
                    }
                    else
                    {
                        //echo "<br/>Status:Failed";
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
            else{
                //echo "Error".$review;    
            }

            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        
        $reviewtype = $this->Review->Reviewtype->find('list')->where(['isdeleted' => 0]);
        $owner= $this->Review->Employee->find('list')->where(['isdeleted' => 0])->toArray();
        $reviewers = $this->Review->Employee->find('list')->where(['isdeleted' => 0]);  
        $reviewees = $this->Review->Employee->find('list')->where(['isdeleted' => 0]);
        $reviewcategories =  $this->ReviewCategory->find('list')->where(['isdeleted' => 0]);
        
        $employees= $this->Employee->find('all')->where(['isdeleted' =>0]);
        $departments = $this->Department->find('all')->where(['isdeleted' =>0]);
        
        $employeegroup = $this->Review->Employee->EmployeeGroup->find('list',array('fields' => array('id', 'name')))->where(['isdeleted' => 0]);        
        
        //echo "GG".json_encode($employeegroup);
        if(sizeof($employeegroup->toArray())==0)
            $employeegroup = json_decode('{"0":"None"}');        

        $util=new Utility();
        $yuistring =  $util->GetYUIString($departments,$employees);

        $questions = $this->Question->find('all')->where(['isdeleted' => 0])->toArray();
        $questioncategory = $this->Questioncategory->find('all')->where(['isdeleted' => 0])->toArray();
        $subcategory = $this->subcategory->find('all')->where(['isdeleted' => 0])->toArray();

        $util=new Utility();

        $yuistringDepartment =  $util->GetYUIStringForQuestions($questions,$questioncategory,$subcategory);
        //echo json_encode($yuistring);
        
        $owner[0]="";

        $employeepopup = $this->Employee->find('all')->contain(['rank','department','jobposition']);
        $util=new Utility();
        //$empdata =  $util->GetJOSNForDataGrid($employee);
        
        $question = $this->Review->Question->find('list')->where(['isdeleted' =>0]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('review','headerAry','menuAry','question','reviewtype','owner','reviewers','reviewees','departments','myReviewees','yuistring','yuistringDepartment','employeegroup','employeepopup','reviewcategories'));
        $this->set('_serialize', ['review','departments','myReviewees','reviewcategories']);
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Review id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $review = $this->Review->get($id, [
            'contain' => ['Question']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $review = $this->Review->patchEntity($review, $this->request->data);
            if ($this->Review->save($review)) {
                $this->Flash->success(__('The review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }

        $question = $this->Review->Question->find('list', ['limit' => 200]);
        $this->set(compact('review', 'question'));
        $this->set('_serialize', ['review']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $review = $this->Review->get($id);
        $review->isdeleted = 1;
        if ($this->Review->save($review)) {
            echo "Success";
            $this->Flash->success(__('The review has been deleted.'));
        } else {
            echo "Failed";
        }
        //die();
        
        return $this->redirect(['action' => 'index']);
    }
}
