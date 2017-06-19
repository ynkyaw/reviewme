<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use  Cake\Cache\Cache;
use Cake\I18n\Date;

/**
 * Employeegroup Controller
 *
 * @property \App\Model\Table\EmployeegroupTable $Employeegroup
 */
class ReviewPageController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function index($empid,$rid,$cid,$max,$reviewerid,$revtype,$revowner)
    {       
        try
        {
            $c1initial = Cache::read($rid.'|'.$empid,'long');            
            if($c1initial == null)
            {
               // Cache::write($rid.'|'.$empid,'1','long');               
            }

            $c2initial = Cache::read($reviewerid,'long');
            if($c2initial != null)//found
            {
              //  echo "c2 found : ".$c2initial."/";
                $pieces = explode(",", $c2initial);
               // echo " c2's old review: ".$pieces[0]."/c2's old reviewee: ".$pieces[1]."/";
                if($pieces[0] == $rid && $pieces[1] == $empid ) //continue to held reviewee
                {
                   // echo "ya! old c2 and new c2 are same!/";
                    //do nothing
                }
                else
                {
                   // echo "not the same with old/";
                    Cache::delete($reviewerid,'long');

                    //1.count minute 1 from c1
                    $empc1 = Cache::read($pieces[0].'|'.$pieces[1],'long');//must be old reviewee
                    if($empc1 != null || $empc1 <1)
                    {
                     //   echo "ya!can reduce c1's count:".$empc1."/";
                        $countc1 = $empc1 - 1;
                      //  echo "Garr_Call_Me_Reduce";
                        Cache::write($pieces[0].'|'.$pieces[1],$countc1,'long');//must be old reviewee

                        $reducedc1 = Cache::read($pieces[0].'|'.$pieces[1],'long');
                        //echo "reduced c1 : ".$reducedc1."/";
                    }

                    //2.count plus to c1 by c2's current reviewee
                    //3.add new record to c2  
                    $empCount1 = Cache::read($rid.'|'.$empid,'long');
                    if($empCount1<$max)
                    {
                      //  echo "less than and add count 1 to c1 /";
                        $count = $empCount1 +1;
                        Cache::write($rid.'|'.$empid,$count,'long');//add cache1
                        Cache::write($reviewerid,''.$rid.','.$empid.'','long');//add cache2

                        $addedc1final = Cache::read($rid.'|'.$empid,'long');
                        $addedc2final = Cache::read($reviewerid,'long');
                      //  echo "addedc1final : ".$addedc1final."/";
                      //  echo "addedc2final : ".$addedc2final."/";
                    }
                }
            }
            else //not found
            {
               // echo "c2 not found/";
                $empCount = Cache::read($rid.'|'.$empid,'long');

               // echo "finished count for c1 is : ".$empCount."/";

                if($empCount<$max)
                {
                   // echo "yes still less than/";
                    $count = $empCount +1;
                    Cache::write($rid.'|'.$empid,$count,'long');//add cache1
                    Cache::write($reviewerid,''.$rid.','.$empid.'','long');//add cache2
                }

                $empCache1 = Cache::read($rid.'|'.$empid,'long');
                $empCache2 = Cache::read(''.$reviewerid.'','long');
               // echo "now c1 : ".$empCache1."/now c2 : ".$empCache2."/";
            }
        }
        catch(Exception $e)
        {

        } 

        //to read question according to categoryid from reviewcategory_question
        $this->Users = TableRegistry::get('Users');
        
        $session = $this->request->session();             

    	$this->eee = TableRegistry::get('Employee');
        $this->rrr = TableRegistry::get('Review');
        $this->rqq = TableRegistry::get('ReviewQuestion');
        $this->Reviewresult = TableRegistry::get('Reviewresult');
        $this->qqq = TableRegistry::get('Question');
        $this->qct = TableRegistry::get('Questioncategory');
        $this->sub = TableRegistry::get('Subcategory');

        $now = Date::now();
        $curTime = $now->format('Y-m-d');

    	$empName = $this->eee->find('all')->where(['id' => $empid,'isdeleted' => 0]);
        //echo "rever id ".$reviewerid;
        $reviewer = $this->eee->find('all')->where(['userid' => $reviewerid,'isdeleted' => 0])->first();
        if($reviewer != null)
        {
            $reviewerid = $reviewer->id;   
        }
       // echo "erid ".$reviewerid->id;

        //get current login user from session
        $session = $this->request->session();
        $userid = $session->read('userid');
        $username = $session->read('username');  

        $empinfo = $this->eee->find('all')->where(['id' => $reviewerid])->first();
        $user = $this->Users->find('all')->where(['id' => $userid ])->first();

        $reverformail = $this->eee->find('all')->where(['userid' => $userid])->first();
    	
        $reviewname = $this->rrr->find('all',array('fields'=>array('title')))->where(['id' => $rid,'isdeleted' => 0,'enddate >= ' => $curTime])->first();
        
        $questioncategoryList = $this->qct->find('all')->where(['isdeleted' => 0]); 
        $subcategoryList = $this->sub->find('all')->where(['isdeleted' => 0]);   

        if($cid != 0)
        {
            $conn = ConnectionManager::get('default');
            $stmt = $conn->execute('select distinct rc.id,rc.title,question.id as qid,question.questionname,question.questionnameeng,question.questiontypeid,question.subcategoryid,qc.id as qcid,qc.questioncategoryname from reviewcategory rc inner join reviewcategory_question rcq on rc.id=rcq.reviewcategory_id inner join question on question.id=rcq.question_id inner join questioncategory qc on qc.id=question.questiontypeid where rcq.reviewcategory_id=? and question.isdeleted=0 and qc.isdeleted=0 and rc.isdeleted=0', [$cid]);
            $rows = $stmt->fetchAll('assoc');

            $questions = array();
            $questionss = array();
            $questionsss = array();

            foreach ($rows as $r) 
            {
               array_push($questions,$r);
               array_push($questionss,$r);
               array_push($questionsss,$r);
            }
        }
        else
        {
            //echo "in null".$cid;
            $questions = array();
            $questionss = array();
            $questionsss = array();

            $revieweeinfo = $this->Reviewresult->find('all')->where(['reviewid'=>$rid,'reviewerid'=>$empid,'revieweeid' => $empid,'finish'=>1])->first();
            
            if($revieweeinfo == null)
            {
                $questionlist = $this->rqq->find('all')->where(['reviewid' => $rid])->toArray();
                foreach ($questionlist as $question) 
                {
                    array_push($questions, $this->qqq->get($question->questionid));
                    //array_push($questions , $this->qqq->get($question->question_id,['contain' => ['questioncategory']]));
                    
                    array_push($questionss, $this->qqq->get($question->questionid));
                    array_push($questionsss , $this->qqq->get($question->questionid));
                }
            }
            else
            {
                //echo "rev ".$revieweeinfo;
            }
        }

        $owneremail = $this->eee->find()->where(['id' => $revowner,'isdeleted' => 0])->first();
        if($owneremail != null)
        {
            $revieweridforemail = $owneremail->id;
        }
        
       // echo "owneremail ".$revieweridforemail;
        if($owneremail != null)
        {
            $owneremail = $this->Users->find()->where(['id' => $owneremail->userid,'isdeleted' => 0])->first();
        }      
        
        $muserid = $user->id;
        if($owneremail != null)
        {
            $musername = $owneremail->username;
            $museremail = $owneremail->email;
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;
        
    	$this->set(compact('empName','revieweridforemail','reviewname','muserid','reverformail','revtitle','musername','revowner','museremail','questions','reviewerid','empid','user','rid','questionss','questionsss','questioncategoryList','subcategoryList','menuAry','headerAry','cid','revtype'));
        $this->set('_serialize', ['empName','reviewname','muserid','reverformail','musername','revowner','museremail','revtitle','questions','reviewerid','empid','rid','user','questionss','questionsss','questioncategoryList','subcategoryList','cid','revtype']);
    }

    public function indexproduct($productid,$reviewid,$reviewerid)
    {
        $this->product = TableRegistry::get('products');
        $this->project = TableRegistry::get('projects');
        $this->service = TableRegistry::get('services');
        $this->itemreviewsquestion = TableRegistry::get('itemreviews_question');
        $this->question = TableRegistry::get('Question');
        $this->itemreview = TableRegistry::get('itemreviews');
        $this->qcategory = TableRegistry::get('Questioncategory');
        $this->sub = TableRegistry::get('Subcategory');
        $this->reviewresult = TableRegistry::get('Itemreviewsresult');

        $now = Date::now();
        $curTime = $now->format('Y-m-d');

        $productName = null;
        $projectName = null;
        $serviceName = null;
        
        $revtype = $this->itemreview->find('all')->where(['id' => $reviewid ,'isdeleted' => 0,'enddate >=' => $curTime])->first();         
        $revtype = $revtype->reviewtype_id;
        if($revtype == 5)
        {
            $productName = $this->product->find('all')->where(['id' => $productid,'isdeleted' => 0]);
        }
        if($revtype == 6)
        {
            $projectName = $this->project->find('all')->where(['id' => $productid,'isdeleted' => 0]);
        }
        if($revtype == 7)
        {
            $serviceName = $this->service->find('all')->where(['id' => $productid,'isdeleted' => 0]);
        }        

        $reviewname = $this->itemreview->find('all',array('fields'=>array('title')))->where(['id' => $reviewid,'isdeleted' => 0,'enddate >= ' => $curTime])->first();
        $questioncategoryList = $this->qcategory->find('all')->where(['isdeleted' => 0]);
        $subcategoryList = $this->sub->find('all')->where(['isdeleted' => 0]);

        $questions = array();
        $questionss = array();
        $questionsss = array();

        $reviewresultinfo = $this->reviewresult->find('all')->where(['itemreviews_id'=>$reviewid,'reviewerid'=>$reviewerid,'products_id' => $productid,'finish'=>1])->first();
        
        if($reviewresultinfo == null)
        {
            $questionlist = $this->itemreviewsquestion->find('all')->where(['itemreviews_id' => $reviewid])->toArray();
            foreach ($questionlist as $question) 
            {
                array_push($questions, $this->question->get($question->question_id));
                //array_push($questions , $this->qqq->get($question->question_id,['contain' => ['questioncategory']]));
                
                array_push($questionss, $this->question->get($question->question_id));
                array_push($questionsss , $this->question->get($question->question_id));
            }
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;
        
        $this->set(compact('menuAry','headerAry','productName','projectName','serviceName','productid','reviewid','reviewerid','reviewname','questions','questionss','questionsss','subcategoryList','questioncategoryList'));
        $this->set('_serialize', ['reviewname']);
    }

    public function indexorganization($orgid,$reviewid,$reviewerid)
    {
        $this->department = TableRegistry::get('department');
        $this->companies = TableRegistry::get('companies');
        $this->organization = TableRegistry::get('organization');
        $this->orgreviewquestion = TableRegistry::get('organizationreviews_question');
        $this->question = TableRegistry::get('Question');
        $this->orgreview = TableRegistry::get('organizationreviews');
        $this->qcategory = TableRegistry::get('Questioncategory');
        $this->sub = TableRegistry::get('Subcategory');
        $this->orgreviewresult = TableRegistry::get('Organizationreviewsresults');

        $now = Date::now();
        $curTime = $now->format('Y-m-d');

        $departmentname = null;
        $companyname = null;
        $orgname = null;
        
        $revtype = $this->orgreview->find('all')->where(['id' => $reviewid ,'isdeleted' => 0,'enddate >=' => $curTime])->first();         
        $revtype = $revtype->reviewtype_id;
        if($revtype == 8)
        {
            $departmentname = $this->department->find('all')->where(['id' => $orgid,'isdeleted' => 0]);
        }
        if($revtype == 9)
        {
            $companyname = $this->companies->find('all')->where(['id' => $orgid,'isdeleted' => 0]);
        }
        if($revtype == 10)
        {
            $orgname = $this->organization->find('all')->where(['id' => $orgid,'isdeleted' => 0]);
        }        

        $reviewname = $this->orgreview->find('all',array('fields'=>array('title')))->where(['id' => $reviewid,'isdeleted' => 0,'enddate >= ' => $curTime])->first();
        $questioncategoryList = $this->qcategory->find('all')->where(['isdeleted' => 0]);
        $subcategoryList = $this->sub->find('all')->where(['isdeleted' => 0]);

        $questions = array();
        $questionss = array();
        $questionsss = array();

        $reviewresultinfo = $this->orgreviewresult->find('all')->where(['organizationreviews_id'=>$reviewid,'reviewerid'=>$reviewerid,'revieweeid' => $orgid,'finish'=>1])->first();
        
        if($reviewresultinfo == null)
        {
            $questionlist = $this->orgreviewquestion->find('all')->where(['organizationreviews_id' => $reviewid])->toArray();
            foreach ($questionlist as $question) 
            {
                array_push($questions, $this->question->get($question->question_id));
                //array_push($questions , $this->qqq->get($question->question_id,['contain' => ['questioncategory']]));
                
                array_push($questionss, $this->question->get($question->question_id));
                array_push($questionsss , $this->question->get($question->question_id));
            }
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;
        
        $this->set(compact('menuAry','headerAry','departmentname','companyname','orgname','orgid','reviewid','reviewerid','reviewname','questions','questionss','questionsss','subcategoryList','questioncategoryList'));
        $this->set('_serialize', ['reviewname']);
    }

    public function indexforpa($revieweemg = null,$revmgid = null,$revtitle=null,$reviewermg = null)//281 30 kkk 283
    {
        $this->ReviewReviewee = TableRegistry::get('ReviewReviewee');
        $this->Users = TableRegistry::get('Users');
        $this->Reviewresult = TableRegistry::get('Reviewresult');
        $this->Questioncategory = TableRegistry::get('Questioncategory');
        $this->Employee = TableRegistry::get('Employee');
        $this->sub = TableRegistry::get('Subcategory');

        $questioncategoryList = $this->Questioncategory->find('all')->where(['isdeleted' => 0]);
        $subcategoryList = $this->sub->find('all')->where(['isdeleted' => 0]);

        $eachrevieweeinfo = $this->Employee->find('all')->where(['isdeleted' => 0,'id' => $revieweemg])->first();
        $revieweename = $eachrevieweeinfo->name;

        $reviewresultinfo = $this->Reviewresult->find('all')->where(['reviewid' => $revmgid, 'reviewerid' => $revieweemg,'revieweeid' => $revieweemg])->first();
        $reviewresultid = $reviewresultinfo->id;

        $count=1;

        $revieweeinfo = $this->Reviewresult->find('all')->where(['reviewid'=>$revmgid,'reviewerid'=>$revieweemg,'revieweeid' => $revieweemg,'finish'=>1])->first();
        if($revieweeinfo != null)
        {
            $conn = ConnectionManager::get('default');
            $stmt = $conn->execute('select rrd.*,q.questionname,q.questionnameeng,q.questiontypeid,q.subcategoryid from reviewresultdetail rrd inner join reviewresult rr on rr.id=rrd.reviewresult_id inner join question q on q.id=rrd.questionid where rr.finish=1 and q.isdeleted=0 and rrd.reviewresult_id=?', [$revieweeinfo->id]);
            $revieweedetail = $stmt->fetchAll('assoc');         
        }
        else
        {
            $revieweedetail = null;
        }
           
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('menuAry','headerAry','revtitle','revieweedetail','questioncategoryList','subcategoryList','revieweename','reviewresultid','revieweemg','revmgid','reviewermg'));
        $this->set('_serialize', ['revtitle','revieweedetail','questioncategoryList','subcategoryList','reviewresultid','revieweename','revieweemg','revmgid','reviewermg']);
    }

    public function indexforpafinish($revieweemg = null,$revmgid = null,$revtitle=null,$reviewermg = null)
    {
        $this->ReviewReviewee = TableRegistry::get('ReviewReviewee');
        $this->Users = TableRegistry::get('Users');
        $this->Reviewresult = TableRegistry::get('Reviewresult');
        $this->Questioncategory = TableRegistry::get('Questioncategory');
        $this->sub = TableRegistry::get('Subcategory');
        $this->Employee = TableRegistry::get('Employee');

        $questioncategoryList = $this->Questioncategory->find('all')->where(['isdeleted' => 0]); 
        $subcategoryList = $this->sub->find('all')->where(['isdeleted' => 0]);

        $eachrevieweeinfo = $this->Employee->find('all')->where(['isdeleted' => 0,'id' => $revieweemg])->first();
        $revieweename = $eachrevieweeinfo->name;

        $reviewresultinfo = $this->Reviewresult->find('all')->where(['reviewid' => $revmgid, 'reviewerid' => $reviewermg,'revieweeid' => $revieweemg,'finish'=>1])->first();
        $reviewresultid = $reviewresultinfo->id;

        $count=1;

        $revieweeinfo = $this->Reviewresult->find('all')->where(['reviewid'=>$revmgid,'reviewerid'=>$reviewermg,'revieweeid' => $revieweemg,'finish'=>1])->first();
        $infomgrcmt = $revieweeinfo->managercomment;
        $infoempcmt = $revieweeinfo->employeecomment;
        if($revieweeinfo != null)
        {
            $conn = ConnectionManager::get('default');
            $stmt = $conn->execute('select rrd.*,q.questionname,q.questionnameeng,q.questiontypeid,q.subcategoryid from reviewresultdetail rrd inner join reviewresult rr on rr.id=rrd.reviewresult_id inner join question q on q.id=rrd.questionid where rr.finish=1 and q.isdeleted=0 and rrd.reviewresult_id=?', [$revieweeinfo->id]);
            $revieweedetail = $stmt->fetchAll('assoc');         
        }
        else
        {
            $revieweedetail = null;
        }
           
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('menuAry','headerAry','revtitle','revieweedetail','infomgrcmt','infoempcmt','questioncategoryList','subcategoryList','revieweename','reviewresultid','revieweemg','revmgid','reviewermg'));
        $this->set('_serialize', ['revtitle','revieweedetail','infomgrcmt','infoempcmt','questioncategoryList','subcategoryList','reviewresultid','revieweename','revieweemg','revmgid','reviewermg']);
    }

}