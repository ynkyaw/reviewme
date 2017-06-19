<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use App\CustomModel\ReviewEmployeeTemplate;
use  Cake\Cache\Cache;
use Cake\I18n\Date;
use Cake\Routing\Router;
/**
 * Employeegroup Controller
 *
 * @property \App\Model\Table\EmployeegroupTable $Employeegroup
 */
class ReviewlistController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function indexpa($revidmg = null,$revtitle=null,$reviewermg=null,$revieweemg = null)
    {
        $this->ReviewReviewee = TableRegistry::get('ReviewReviewee');
        $this->Users = TableRegistry::get('Users');
        $this->Reviewresult = TableRegistry::get('Reviewresult');
        $this->Questioncategory = TableRegistry::get('Questioncategory');
        $this->Employee = TableRegistry::get('Employee');

        $allempmglist = $this->ReviewReviewee->find('all',array('fields' => array('revieweeid')))->where(['reviewid' => $revidmg])->toArray();
        $allempmglist = array_unique($allempmglist);

        $conn = ConnectionManager::get('default');
        $stmtmg = $conn->execute('
                                SELECT revieweeid
                                FROM reviewresult
                                where reviewid = ?
                                and reviewerid=?
                                and finish=1',[$revidmg,$reviewermg]);
        
        $stmtemppa = $conn->execute('
                                SELECT revieweeid
                                FROM reviewresult
                                where reviewid = ?
                                and reviewerid !=?
                                and finish=1',[$revidmg,$reviewermg]);

        $stmtmgpa = $conn->execute('
                                SELECT revieweeid
                                FROM reviewresult
                                where reviewid = ?
                                and reviewerid = ?
                                and finish = 1
                                and managercomment is null
                                and employeecomment is null',[$revidmg,$reviewermg]);

        $stmtmgpafn = $conn->execute('
                                SELECT revieweeid
                                FROM reviewresult
                                where reviewid = ?
                                and reviewerid = ?
                                and finish = 1
                                and managercomment is not null
                                and employeecomment is not null',[$revidmg,$reviewermg]);

        $empmglist = $stmtmg->fetchAll('assoc'); // all reviewees(pa,others)
        //$empmgfnlist = $stmtemppa->fetchAll('assoc'); // finished by emp(self) list pa                        
        $empmglistpa = $stmtemppa->fetchAll('assoc'); // finished by emp(self) list pa 
        $empmglistfs = $stmtmgpa->fetchAll('assoc'); //finished by manager list pa
        $empmglistfn = $stmtmgpafn->fetchAll('assoc'); // completed all steps in pa

        $empmgArray = array();
        foreach ($empmglist as $ff) 
        {
            array_push($empmgArray, $ff['revieweeid']);
        }

        $empmgfnArrayfs = array();
        foreach ($empmglistfs as $ff) 
        {
            array_push($empmgfnArrayfs, $ff['revieweeid']);
        }        

        $empmgArraypa = array();
        foreach ($empmglistpa as $ff) 
        {
            array_push($empmgArraypa, $ff['revieweeid']);
        }

        $empmgArraypafn = array();
        foreach ($empmglistfn as $ff) 
        {
            array_push($empmgArraypafn, $ff['revieweeid']);
        }
        
        $finalmglist = array();
        foreach($allempmglist as $rr)
        {
           if(!in_array($rr->revieweeid,$empmgArray))
                array_push($finalmglist, $rr->revieweeid);
        }

        $finalmgfnlistfs = array();
        foreach($allempmglist as $rr)
        {
           if(in_array($rr->revieweeid,$empmgfnArrayfs))
                array_push($finalmgfnlistfs, $rr->revieweeid);
        }        

        $finalmglistpa =array();
        foreach ($allempmglist as $rr) 
        {            
            if(in_array($rr->revieweeid, $empmgArraypa))
                array_push($finalmglistpa,$rr->revieweeid);
        }

        $finalmglistpafn = array();
        foreach ($allempmglist as $rr) 
        {
            if(in_array($rr->revieweeid, $empmgArraypafn))
                array_push($finalmglistpafn,$rr->revieweeid);
        }

        $finalempinfomgpa = array();
        foreach($finalmglistpa as $fpa)
        {
            $emp = $this->Employee->get($fpa,['contain'=>['department','jobposition']]);
            $super = new ReviewEmployeeTemplate();
            $super->employee = $emp;               
            $super->revtype = 0;
            array_push($finalempinfomgpa,$super);
        }

        $finalempinfofs = array();//
        foreach($finalmgfnlistfs as $fpa)
        {
            $emp = $this->Employee->get($fpa,['contain'=>['department','jobposition']]);
            $super = new ReviewEmployeeTemplate();
            $super->employee = $emp;               
            $super->revtype = 0;
            array_push($finalempinfofs,$super);
        }

        $finalempinfomgpafn = array();
        foreach ($finalmglistpafn as $fn) 
        {
            $emp = $this->Employee->get($fn,['contain' => ['department','jobposition']]);
            $super = new ReviewEmployeeTemplate();
            $super->employee = $emp;
            $super->revtype = 0;
            array_push($finalempinfomgpafn,$super);
        }

        $finalempinfomg = array();//all reviewees
        foreach ($finalmglist as $f) 
        {
            $emp = $this->Employee->get($f,['contain'=>['department','jobposition']]);
            $super = new ReviewEmployeeTemplate();
            $super->employee = $emp;               
            $super->revtype = 0;
            array_push($finalempinfomg,$super);
        } 

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('finalempinfomg','finalempinfomgpa','finalempinfofs','finalempinfomgpafn','revidmg','menuAry','headerAry','reviewermg','revtitle'));
        $this->set('_serialize', ['finalempinfomg','finalempinfomgpa','finalempinfofs','finalempinfomgpafn','revidmg','reviewermg','revtitle']);
    }

    public function indexpaowner($rid)
    {
        $this->ReviewReviewee = TableRegistry::get('ReviewReviewee');
        $this->ReviewReviewer = TableRegistry::get('ReviewReviewer');
        $this->Users = TableRegistry::get('Users');
        $this->Reviewresult = TableRegistry::get('Reviewresult');
        $this->Questioncategory = TableRegistry::get('Questioncategory');
        $this->Employee = TableRegistry::get('Employee');
        $this->review = TableRegistry::get('Review');

        $session = $this->request->session();
        $userid = $session->read('userid');
        $username = $session->read('username');

        $employee = $this->Employee->find('all')->where(['userid'=>$userid,'isdeleted' => 0])->first();

        $now = Date::now();
        $curTime = $now->format('Y-m-d');

        $reviews = array();
        $reviewfn = array();

        $reviewerlist = $this->ReviewReviewer->find()->where(['reviewid' => $rid])->first();
        $revieweelist = $this->ReviewReviewee->find()->where(['reviewid' => $rid]);
        foreach ($revieweelist as $reviewee) 
        {
            $maxempList = 1;
            $finishedempList = $this->Reviewresult->find('all')->where(['reviewid'=>$rid,'reviewerid'=>$reviewerlist->reviewerid,'managercomment Is Not' =>null,'employeecomment Is Not' =>null,'revieweeid' => $reviewee->revieweeid,'finish'=>1])->count();  
            //echo "finisg ".$finishedempList;          

            if($finishedempList < $maxempList)
            {
                $rev = $this->review->get($rid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                        
                $empinfo = $this->Employee->get($reviewee->revieweeid);

                $myobj = new OwnerTemplate();
                $myobj->review = $rev;
                $myobj->employee = $empinfo;
                $myobj->total = $maxempList;
                $myobj->finish = $finishedempList;
                array_push($reviews, $myobj);
            }

            if($finishedempList == $maxempList)
            {
                $revfn = $this->review->get($rid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                
                $pdinfo = $this->Employee->get($reviewee->revieweeid);

                $myobj1 = new OwnerTemplate();
                $myobj1->review = $revfn;
                $myobj1->employee = $pdinfo;
                $myobj1->total = $maxempList;
                $myobj1->finish = $finishedempList;
                array_push($reviewfn, $myobj1); 
            }
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('reviews','reviewfn','menuAry','headerAry'));
        $this->set('_serialize', ['reviews','reviewfn']);
    }

    public function index($rid,$cid=0)    
    {
        $conn = ConnectionManager::get('default');

        $this->Users = TableRegistry::get('Users');
        $this->reiveee = TableRegistry::get('ReviewReviewee');
        $this->reviewcategory = TableRegistry::get('reviewcategory');
        $this->catquestion = TableRegistry::get('reviewcategory_question');
        $this->catreviewer = TableRegistry::get('reviewcategory_reviewer');
        $this->ReviewReviewer = TableRegistry::get('ReviewReviewer');
        $this->Employee = TableRegistry::get('Employee');
        $this->rresult = TableRegistry::get('ReviewResult');
        $this->review = TableRegistry::get('Review'); 

        $buemployees = array();

        $now = Date::now();
        $curTime = $now->format('Y-m-d');     

        $session = $this->request->session();
        $curuser = $session->read('userid');    

        $reviewer = $this->Employee->find('all')->where(['userid' => $curuser,'isdeleted' => 0])->first();
        $reviewerid = $reviewer->id;

        //echo "rev id ".$rid;
        $revList = $this->review->find('all')->where(['id' => $rid ,'isdeleted' => 0,'enddate >=' => $curTime])->first(); 
        
        $revtype = 0;$maxreviewee=0;$maxrev=0;
        if($revList != null)
        {
            $revtype = $revList->reviewtype_id;
            $maxreviewee = $revList->maxreviewed;
            $maxrev = $revList->maxreview;
        }

        //finished reviewee count
        $maxreviewlist = $this->rresult->find('all')->where(['reviewid' => $rid,'reviewerid' => $reviewerid,'finish' => 1])->count();
        $selfreviewee = null;
        $selfarray = array();
        
        if($revtype == '3')
        {
            //get total reviewee from review_reviewee
            $revieweeList = $this->reiveee->find('all',array('fields' => array('revieweeid')))->where(['reviewid' => $rid])->toArray();
            $revieweeList = array_unique($revieweeList); 

            $selfreviewee = $this->review->find('all')->where(['id' => $rid,'isdeleted' => 0,'enddate >= ' => $curTime])->first();
                
                if($selfreviewee != null && $selfreviewee->is_self == 1)
                {
                    $mefromreviewee = $this->reiveee->find('all')->where(['reviewid' => $rid ,'revieweeid' => $reviewerid])->toArray();
                     //get finishreviewee list from reviewresult
                    $stmtt = $conn->execute('select review_reviewee.revieweeid 
                                            from review_reviewee 
                                            left join reviewresult 
                                            on reviewresult.revieweeid=review_reviewee.revieweeid
                                            where finish=1 
                                            and reviewresult.reviewid=?
                                            and reviewresult.reviewerid=?
                                            and reviewresult.revieweeid=? 
                                            and review_reviewee.reviewid=?
                                            group by reviewresult.revieweeid
                                            UNION all
                                            SELECT revieweeid
                                            FROM reviewresult
                                            where reviewid = ?
                                            and reviewerid=?
                                            and revieweeid=?
                                            and finish=1',[$rid,$reviewerid,$reviewerid,$rid,$rid,$reviewerid,$reviewerid]);
                    //reviewresult.revieweeid,reviewresult.reviewerid
                    $selfinfo = $stmtt->fetchAll('assoc'); 

                    $self = array();
                    foreach ($selfinfo as $sinfo) 
                    {
                        array_push($self,$sinfo['revieweeid']);  
                    }

                    $selffinalList = array();
                    foreach($mefromreviewee as $rr)
                    {
                       if(!in_array($rr->revieweeid,$self))
                            array_push($selffinalList, $rr->revieweeid);
                    }

                    $selfarray = array();
                    foreach ($selffinalList as $f) 
                    {
                        $emp1 = $this->Employee->get($f,['contain'=>['department','jobposition']]);
                        array_push($selfarray,$emp1);
                    }  
                }
                
            if($maxreviewlist < $maxrev)
            {   
                //get finishreviewee list from reviewresult
                $stmt = $conn->execute('select review_reviewee.revieweeid 
                                        from review_reviewee 
                                        left join reviewresult 
                                        on reviewresult.revieweeid=review_reviewee.revieweeid
                                        where finish=1 
                                        and reviewresult.reviewid=? 
                                        and review_reviewee.reviewid=?
                                        group by reviewresult.revieweeid having count(reviewresult.revieweeid)>=?
                                        UNION all
                                        SELECT revieweeid
                                        FROM reviewresult
                                        where reviewid = ?
                                        and reviewerid=?
                                        and finish=1',[$rid,$rid,$maxreviewee,$rid,$reviewerid]);
                //reviewresult.revieweeid,reviewresult.reviewerid
                $revieweeList1 = $stmt->fetchAll('assoc'); 

                //$revieweeList1 = array_unique($revieweeList1);
                $finalArray = array();
                foreach ($revieweeList1 as $ff) 
                {
                    if($ff['revieweeid'] != $reviewerid)
                    array_push($finalArray, $ff['revieweeid']);
                }
                
                //get reviewee list ,, it is not in finished list
                $finalList = array();
                foreach($revieweeList as $rr)
                {
                   if(!in_array($rr->revieweeid,$finalArray) && $rr['revieweeid'] != $reviewerid)
                        array_push($finalList, $rr->revieweeid);
                }

                $employees = array();
                foreach ($finalList as $f) 
                {
                    $emp = $this->Employee->get($f,['contain'=>['department','jobposition']]);
                    $super = new ReviewEmployeeTemplate();
                    $super->employee = $emp;
                    $super->revtype = $revtype;
                    $finishedcount = $this->rresult->find('all')->where(['reviewid'=>$rid,'revieweeid'=>$f,'finish'=>1])->count();

                    $super->reviewcount = $finishedcount;
                   
                    try{
                        $cacheCount = Cache::read($rid.'|'.$f,'long');
                        
                        if($cacheCount!=null)
                        {
                            $super->reviewcount = $super->reviewcount +$cacheCount;
                        }
                    }catch(Exception $e)
                    {

                    }
                    array_push($employees,$super);
                } 
            } 
            else
            {
                $employees = null;
            }

            //if($maxreviewlist == $maxrev)
            //{
                //get finishreviewee list from reviewresult
                $stmt = $conn->execute('select review_reviewee.revieweeid 
                                        from review_reviewee 
                                        left join reviewresult 
                                        on reviewresult.revieweeid=review_reviewee.revieweeid
                                        where finish=1 
                                        and reviewresult.reviewid=? 
                                        and review_reviewee.reviewid=?
                                        group by reviewresult.revieweeid having count(reviewresult.revieweeid)>=?
                                         UNION all
                                        SELECT revieweeid
                                        FROM reviewresult
                                        where reviewid = ?
                                        and reviewerid=?
                                        and finish=1',[$rid,$rid,$maxreviewee,$rid,$reviewerid]);
                //reviewresult.revieweeid,reviewresult.reviewerid
                $finishemplist = $stmt->fetchAll('assoc'); 

                //$revieweeList1 = array_unique($revieweeList1);
                $finishemparray = array();
                foreach ($finishemplist as $ff) 
                {
                    if($ff['revieweeid'] != $reviewerid)
                    array_push($finishemparray, $ff['revieweeid']);
                }

                $finishListemp = array();
                foreach ($revieweeList as $rr) 
                {
                    if(in_array($rr->revieweeid,$finishemparray) && $rr['revieweeid'] != $reviewerid)
                        array_push($finishListemp, $rr->revieweeid);
                } 

                $employeesfn = array();
                foreach ($finishListemp as $f) 
                {
                    $emp = $this->Employee->get($f,['contain'=>['department','jobposition']]);
                    $super = new ReviewEmployeeTemplate();
                    $super->employee = $emp;
                    $super->revtype = $revtype;
                    array_push($employeesfn,$super);
                }
            //}
        }
        else
        {
            $revieweeList3 = $this->reiveee->find('all',array('fields' => array('revieweeid')))->where(['reviewid' => $rid])->toArray();
            $revieweeList3 = array_unique($revieweeList3);

            $bureviewee = $this->reiveee->find('all',array('fields' => array('revieweeid')))->where(['reviewid' => $rid])->first();
            if($bureviewee != null)
            {
               $bureviewee = $bureviewee->revieweeid;
            }

            $reviewerList3 = $this->ReviewReviewer->find('all',array('fields' => array('reviewerid')))->where(['reviewid' => $rid])->toArray();
            $reviewerList3 = array_unique($reviewerList3);

            if($cid!=0)
            {                
                $stmt = $conn->execute('select review_reviewee.revieweeid 
                                        from review_reviewee 
                                        left join reviewresult 
                                        on reviewresult.revieweeid=review_reviewee.revieweeid
                                        where finish=1                                        
                                        and reviewresult.reviewid=? 
                                        and reviewresult.categoryid=?
                                        and review_reviewee.reviewid=?
                                        group by reviewresult.revieweeid
                                        UNION all
                                        SELECT revieweeid
                                        FROM reviewresult
                                        where reviewid = ?
                                        and reviewerid=?
                                        and categoryid=?
                                        and finish=1',[$rid,$cid,$rid,$rid,$reviewerid,$cid]);

                $revieweeList2 = $stmt->fetchAll('assoc');
                $finalArray1 = array();

                foreach ($revieweeList2 as $ff) 
                {
                    array_push($finalArray1, $ff['revieweeid']);
                }
                
                $finalList1 = array();
                foreach($revieweeList3 as $rr)
                {
                   if(!in_array($rr->revieweeid,$finalArray1) && $rr['reviewerid'] != $curuser)
                        array_push($finalList1, $rr->revieweeid);
                }

                $finalList1fn = array();
                foreach($revieweeList3 as $rr)
                {
                   if(in_array($rr->revieweeid,$finalArray1) && $rr['reviewerid'] != $curuser)
                        array_push($finalList1fn, $rr->revieweeid);
                }
            
                $employees = array();
                foreach ($finalList1 as $f) 
                {
                    $emp = $this->Employee->get($f,['contain'=>['department','jobposition']]);
                    $super = new ReviewEmployeeTemplate();
                    $super->employee = $emp;               
                    $super->revtype = $revtype;
                    array_push($employees,$super);
                }

                $employeesfn = array();
                foreach ($finalList1fn as $f) 
                {
                    $emp = $this->Employee->get($f,['contain'=>['department','jobposition']]);
                    $super = new ReviewEmployeeTemplate();
                    $super->employee = $emp;               
                    $super->revtype = $revtype;
                    array_push($employeesfn,$super);
                }

            }
            else
            {
                $bureviewee1 = $this->reiveee->find('all',array('fields' => array('revieweeid')))->where(['reviewid' => $rid]);
                //echo "sdfs ".$bureviewee->count();
                if($bureviewee1 != null)
                {
                    
                    $bucount = 1;
                    
                    foreach ($bureviewee1 as $bu) 
                    {
                        $stmt1 = $conn->execute('select review_reviewer.reviewerid 
                                            from review_reviewer 
                                            left join reviewresult 
                                            on reviewresult.reviewerid=review_reviewer.reviewerid
                                            where finish=1                                        
                                            and reviewresult.reviewid=?
                                            and review_reviewer.reviewid=?
                                            and reviewresult.reviewerid=?
                                            group by reviewresult.reviewerid
                                            UNION all
                                            SELECT revieweeid
                                            FROM reviewresult
                                            where reviewid = ?
                                            and revieweeid=?
                                            and reviewerid=?
                                            and finish=1',[$rid,$rid,$reviewerid,$rid,$bu->revieweeid,$reviewerid]);

                        $revieweeListbu = $stmt1->fetchAll('assoc'); 

                       /* $finishList = $this->rresult->find('all', array('fields' => array('revieweeid')))->where(['reviewid' => $rid,'reviewerid'=>$curuser,'finish'=>true])->toArray();
                        $finishList = array_unique($finishList);*/

                        $finalArray1 = array();
                        foreach ($revieweeListbu as $ff) 
                        {
                            array_push($finalArray1, $ff['reviewerid']);
                        }
                        
                        $finalList1 = array();      

                        if(sizeof($finalArray1) == 0)
                        {
                            array_push($finalList1, $bu->revieweeid);
                        }    

                        $name = 'bu'.$bucount;
                        foreach ($finalList1 as $f) 
                        {                           
                            $emp = $this->Employee->get($f,['contain'=>['department','jobposition']]);
                            $super = new ReviewEmployeeTemplate();
                            $super->employee = $emp;               
                            $super->revtype = $revtype;
                            $buemployees[$name] = $super;                            
                        }
                        $bucount++;                        
                    }
                    //echo $buemployees[]; 
                    
                    $employeesfn = null;
                    $employees = null;                                                   
                }          
            }        
        }
          
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('employees','employeesfn','rid','menuAry','headerAry','cid','selfreviewee','selfarray','maxreviewee','reviewerid','buemployees'));
        $this->set('_serialize', ['employees','employeesfn','rid','cid','selfreviewee','selfarray','maxreviewee','reviewerid']);
    }

    public function indexowner($rid,$cid=0)    
    {
        $conn = ConnectionManager::get('default');

        $this->Users = TableRegistry::get('Users');
        $this->reivewreviewee = TableRegistry::get('ReviewReviewee');
        $this->reviewreviewer = TableRegistry::get('ReviewReviewer');
        $this->reviewcategory = TableRegistry::get('reviewcategory');
        $this->catquestion = TableRegistry::get('reviewcategory_question');
        $this->catreviewer = TableRegistry::get('reviewcategory_reviewer');
        $this->Employee = TableRegistry::get('Employee');
        $this->reviewresult = TableRegistry::get('ReviewResult');
        $this->review = TableRegistry::get('Review'); 

        $now = Date::now();
        $curTime = $now->format('Y-m-d');     

        $session = $this->request->session();
        $curuser = $session->read('userid');    
        $reviews = array();
        $reviewfn = array();

        $revType = $this->review->find('all')->where(['id' => $rid])->first();

        if($revType->reviewtype_id == 3)//360
        {
            $participantList = $this->reivewreviewee->find()->where(['reviewid' => $rid]);
            foreach ($participantList as $part) 
            {
                $maxempList = $this->review->find('all')->where(['id' => $rid])->first();
                $maxempList = $maxempList->maxreview;
                $finishedempList = $this->reviewresult->find('all')->where(['reviewid'=>$rid,'reviewerid'=>$part->revieweeid,'finish'=>1])->count();            

                if($finishedempList < $maxempList)
                {
                    $rev = $this->review->get($rid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                            
                    $emp = $this->Employee->get($part->revieweeid,['contain'=>['department','jobposition']]);

                    $myobj = new OwnerTemplate();
                    $myobj->review = $rev;
                    $myobj->employee = $emp;
                    $myobj->total = $maxempList;
                    $myobj->finish = $finishedempList;
                    array_push($reviews, $myobj);
                }

                if($finishedempList == $maxempList)
                {
                    $revfn = $this->review->get($rid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                    
                    $emp = $this->Employee->get($part->revieweeid,['contain'=>['department','jobposition']]);

                    $myobj1 = new OwnerTemplate();
                    $myobj1->review = $revfn;
                    $myobj1->employee = $emp;
                    $myobj1->total = $maxempList;
                    $myobj1->finish = $finishedempList;
                    array_push($reviewfn, $myobj1); 
                }
            }
        }
        if($revType->reviewtype_id == 4)//PA
        {
            //may be as original
        }

        if($revType->reviewtype_id == 2)//MG
        {
            $reviewerlist = $this->reviewreviewer->find()->where(['reviewid' => $rid]);
            foreach ($reviewerlist as $reviewer) 
            {
                $maxempList = 1;
                $finishedempList = $this->reviewresult->find('all')->where(['reviewid'=>$rid,'reviewerid'=>$reviewer->reviewerid,'finish'=>1])->count();            

                if($finishedempList < $maxempList)
                {
                    $rev = $this->review->get($rid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                            
                    $emp = $this->Employee->get($reviewer->reviewerid,['contain'=>['department','jobposition']]);

                    $myobj = new OwnerTemplate();
                    $myobj->review = $rev;
                    $myobj->employee = $emp;
                    $myobj->total = $maxempList;
                    $myobj->finish = $finishedempList;
                    array_push($reviews, $myobj);
                }

                if($finishedempList == $maxempList)
                {
                    $revfn = $this->review->get($rid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                    
                    $emp = $this->Employee->get($reviewer->reviewerid,['contain'=>['department','jobposition']]);

                    $myobj1 = new OwnerTemplate();
                    $myobj1->review = $revfn;
                    $myobj1->employee = $emp;
                    $myobj1->total = $maxempList;
                    $myobj1->finish = $finishedempList;
                    array_push($reviewfn, $myobj1); 
                }
            }
        }

        if($revType->reviewtype_id == 1)//TD TOYO
        {
            $categorylist = $this->reviewcategory->find('all')->where(['reviewid' => $rid]);
            $c=0;
            foreach ($categorylist as $clist) //6 7 8
            {
                $creviewerlist = $this->catreviewer->find('all')->where(['reviewcategory_id' => $clist->id])->first();
                $catreviewerlist[$c] = $creviewerlist->reviewer_id;
                $c++;
            }
            
            for($i=0; $i<sizeof($catreviewerlist);$i++)
            {
                $maxrevieweelist =$this->reivewreviewee->find('all')->where(['reviewid' => $rid])->count();

                $finishrevieweelist = $this->reviewresult->find('all')->where(['reviewid' => $rid,'reviewerid' => $catreviewerlist[$i],'finish'=> 1]);
                $finishrevieweelist = $finishrevieweelist->count();

                if($finishrevieweelist < $maxrevieweelist)
                {
                    $rev = $this->review->get($rid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                            
                    $emp = $this->Employee->get($catreviewerlist[$i],['contain'=>['department','jobposition']]);

                    $myobj = new OwnerTemplate();
                    $myobj->review = $rev;
                    $myobj->employee = $emp;
                    $myobj->total = $maxrevieweelist;
                    $myobj->finish = $finishrevieweelist;
                    array_push($reviews, $myobj);
                }

                if($finishrevieweelist == $maxrevieweelist)
                {
                    $revfn = $this->review->get($rid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                    
                    $emp = $this->Employee->get($catreviewerlist[$i],['contain'=>['department','jobposition']]);

                    $myobj1 = new OwnerTemplate();
                    $myobj1->review = $revfn;
                    $myobj1->employee = $emp;
                    $myobj1->total = $maxrevieweelist;
                    $myobj1->finish = $finishrevieweelist;
                    array_push($reviewfn, $myobj1);
                }
            }            
        }

        echo Router::url( $this->here, true );

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('reviews','reviewfn','menuAry','headerAry'));
        $this->set('_serialize', ['reviews','reviewfn']);
    }

    public function indexproductowner($rid=0)
    {
        $this->itemreviewreviewers = TableRegistry::get('ItemreviewsReviewers');
        $this->itemreviews = TableRegistry::get('Itemreviews');
        $this->employee = TableRegistry::get('employee');
        $this->product = TableRegistry::get('products');
        $this->reviewresult = TableRegistry::get('Reviewresult');
        $this->itemreviewsresult = TableRegistry::get('itemreviewsresults');

        $now = Date::now();
        $curTime = $now->format('Y-m-d');

        $reviews = array();
        $reviewfn = array();

        $reviewerlist = $this->itemreviewreviewers->find()->where(['itemreviews_id' => $rid]);
        if($reviewerlist != null)
        {
            foreach ($reviewerlist as $reviewer) 
            {
                $maxempList = 1;
                $finishedempList = $this->itemreviewsresult->find('all')->where(['itemreviews_id'=>$rid,'reviewerid'=>$reviewer->reviewerid,'finish'=>1])->count();            

                if($finishedempList < $maxempList)
                {
                    $rev = $this->itemreviews->get($rid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                            
                    $empinfo = $this->employee->get($reviewer->reviewerid);

                    $myobj = new OwnerTemplate();
                    $myobj->review = $rev;
                    $myobj->employee = $empinfo;
                    $myobj->total = $maxempList;
                    $myobj->finish = $finishedempList;
                    array_push($reviews, $myobj);
                }

                if($finishedempList == $maxempList)
                {
                    $revfn = $this->itemreviews->get($rid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                    
                    $pdinfo = $this->employee->get($reviewer->reviewerid);

                    $myobj1 = new OwnerTemplate();
                    $myobj1->review = $revfn;
                    $myobj1->employee = $pdinfo;
                    $myobj1->total = $maxempList;
                    $myobj1->finish = $finishedempList;
                    array_push($reviewfn, $myobj1); 
                }
            }
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('reviews','reviewfn','menuAry','headerAry'));
        $this->set('_serialize', ['reviews','reviewfn']);
    }

    public function indexorganizationowner($rid=0)
    {
        $this->organizationreviewers = TableRegistry::get('OrganizationreviewsReviewers');
        $this->organizationreviews = TableRegistry::get('Organizationreviews');
        $this->employee = TableRegistry::get('employee');
        $this->orgreviewsresults = TableRegistry::get('Organizationreviewsresults');

        $now = Date::now();
        $curTime = $now->format('Y-m-d');

        $reviews = array();
        $reviewfn = array();

        $reviewerlist = $this->organizationreviewers->find()->where(['organizationreviews_id' => $rid]);
        foreach ($reviewerlist as $reviewer) 
        {
            $maxempList = 1;
            $finishedempList = $this->orgreviewsresults->find('all')->where(['organizationreviews_id'=>$rid,'reviewerid'=>$reviewer->reviewerid,'finish'=>1])->count();            

            if($finishedempList < $maxempList)
            {
                $rev = $this->organizationreviews->get($rid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                        
                $empinfo = $this->employee->get($reviewer->reviewerid);

                $myobj = new OwnerTemplate();
                $myobj->review = $rev;
                $myobj->employee = $empinfo;
                $myobj->total = $maxempList;
                $myobj->finish = $finishedempList;
                array_push($reviews, $myobj);
            }

            if($finishedempList == $maxempList)
            {
                $revfn = $this->organizationreviews->get($rid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                
                $pdinfo = $this->employee->get($reviewer->reviewerid);

                $myobj1 = new OwnerTemplate();
                $myobj1->review = $revfn;
                $myobj1->employee = $pdinfo;
                $myobj1->total = $maxempList;
                $myobj1->finish = $finishedempList;
                array_push($reviewfn, $myobj1); 
            }
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('reviews','reviewfn','menuAry','headerAry'));
        $this->set('_serialize', ['reviews','reviewfn']);
    }

    public function indexproduct($rid)
    {
        $conn = ConnectionManager::get('default');

        $this->itemreviewreviewees = TableRegistry::get('ItemreviewsReviewees');
        $this->itemreviews = TableRegistry::get('Itemreviews');
        $this->product = TableRegistry::get('products');
        $this->project = TableRegistry::get('projects');
        $this->service = TableRegistry::get('services');
        $this->employee = TableRegistry::get('Employee');

        $products = array();
        $projects = array();
        $services = array();

        $now = Date::now();
        $curTime = $now->format('Y-m-d');     

        $session = $this->request->session();
        $curuser = $session->read('userid');    

        $reviewer = $this->employee->find('all')->where(['userid' => $curuser,'isdeleted' => 0])->first();
        $reviewerid = $reviewer->id;

        $revtype = $this->itemreviews->find('all')->where(['id' => $rid ,'isdeleted' => 0,'enddate >=' => $curTime])->first();         
        $revtype = $revtype->reviewtype_id;

        if($revtype == 5)
        {
            $productreviewee = $this->itemreviewreviewees->find('all',array('fields' => array('revieweeid')))->where(['itemreviews_id' => $rid])->first();
            $productreviewee = $productreviewee->revieweeid;

            $stmtbu = $conn->execute('select itemreviews_reviewers.reviewerid 
                                        from itemreviews_reviewers 
                                        left join itemreviewsresults 
                                        on itemreviewsresults.reviewerid=itemreviews_reviewers.reviewerid
                                        where finish=1                                        
                                        and itemreviewsresults.itemreviews_id=?
                                        and itemreviews_reviewers.itemreviews_id=?
                                        and itemreviewsresults.reviewerid=?
                                        group by itemreviewsresults.reviewerid
                                        UNION all
                                        SELECT products_id
                                        FROM itemreviewsresults
                                        where itemreviews_id =?
                                        and products_id=?
                                        and reviewerid=?
                                        and finish=1',[$rid,$rid,$reviewerid,$rid,$productreviewee,$reviewerid]);

                $revieweeListPD = $stmtbu->fetchAll('assoc'); 

                $finalArrayPD = array();
                foreach ($revieweeListPD as $ff) 
                {
                    array_push($finalArrayPD, $ff['reviewerid']);
                }
                
                $finalListPD = array();
                if(sizeof($finalArrayPD) == 0)
                {
                    array_push($finalListPD, $productreviewee);
                }

                $finishListPD = array();
                if(sizeof($finalArrayPD) != 0)
                {
                    echo "yes, note o";
                    foreach ($revieweeListPD as $ff) 
                    {
                        array_push($finishListPD, $ff['reviewerid']);
                    }
                }               
                
                foreach ($finalListPD as $f) 
                {
                    $emp = $this->product->get($f);
                    $super = new ReviewEmployeeTemplate();
                    $super->employee = $emp;               
                    $super->revtype = $revtype;
                    array_push($products,$super);
                }

                foreach ($finishListPD as $finish) 
                {
                    $emp = $this->product->get($finish);
                    $super = new ReviewEmployeeTemplate();
                    $super->employee = $emp;               
                    $super->revtype = $revtype;
                    array_push($employeesfn,$super);
                }
                //echo "emp size ".sizeof($employees);
                //$employeesfn = null;
            }

        if($revtype == 6)
        {
            $projectreviewee = $this->itemreviewreviewees->find('all',array('fields' => array('revieweeid')))->where(['itemreviews_id' => $rid])->first();
            $projectreviewee = $projectreviewee->revieweeid;

            $stmtbu = $conn->execute('select itemreviews_reviewers.reviewerid 
                                        from itemreviews_reviewers 
                                        left join itemreviewsresults 
                                        on itemreviewsresults.reviewerid=itemreviews_reviewers.reviewerid
                                        where finish=1                                        
                                        and itemreviewsresults.itemreviews_id=?
                                        and itemreviews_reviewers.itemreviews_id=?
                                        and itemreviewsresults.reviewerid=?
                                        group by itemreviewsresults.reviewerid
                                        UNION all
                                        SELECT products_id
                                        FROM itemreviewsresults
                                        where itemreviews_id =?
                                        and products_id=?
                                        and reviewerid=?
                                        and finish=1',[$rid,$rid,$reviewerid,$rid,$projectreviewee,$reviewerid]);

            $revieweeListPD = $stmtbu->fetchAll('assoc'); 

            $finalArrayPD = array();
            foreach ($revieweeListPD as $ff) 
            {
                array_push($finalArrayPD, $ff['reviewerid']);
            }
            
            $finalListPD = array();
            if(sizeof($finalArrayPD) == 0)
            {
                array_push($finalListPD, $projectreviewee);
                $employeesfn = null;
            }

            $finishListPD = array();
            //echo "yes, o";
            if(sizeof($finalArrayPD) != 0)
            {
                array_push($finishListPD, $projectreviewee);
            }  
            
            foreach ($finalListPD as $f) 
            {
                $proj = $this->project->get($f);
                $super = new ReviewEmployeeTemplate();
                $super->employee = $proj;               
                $super->revtype = $revtype;
                array_push($projects,$super);
            }

            foreach ($finishListPD as $finish) 
            {
                //echo "sfsdfsf".$finish;
                $proj1 = $this->project->get($finish);
                $super1 = new ReviewEmployeeTemplate();
                $super1->employee = $proj1; 
               // echo "emp ".$super1->employee;              
                $super1->revtype = $revtype;
                //echo "rev ".$super1->revtype;
                //echo "super ".$super1;
                array_push($employeesfn,$super1);
            }
        }

        if($revtype == 7)
        {
            $servicereviewee = $this->itemreviewreviewees->find('all',array('fields' => array('revieweeid')))->where(['itemreviews_id' => $rid])->first();
            $servicereviewee = $servicereviewee->revieweeid;

            $stmtbu = $conn->execute('select itemreviews_reviewers.reviewerid 
                                        from itemreviews_reviewers 
                                        left join itemreviewsresults 
                                        on itemreviewsresults.reviewerid=itemreviews_reviewers.reviewerid
                                        where finish=1                                        
                                        and itemreviewsresults.itemreviews_id=?
                                        and itemreviews_reviewers.itemreviews_id=?
                                        and itemreviewsresults.reviewerid=?
                                        group by itemreviewsresults.reviewerid
                                        UNION all
                                        SELECT products_id
                                        FROM itemreviewsresults
                                        where itemreviews_id =?
                                        and products_id=?
                                        and reviewerid=?
                                        and finish=1',[$rid,$rid,$reviewerid,$rid,$servicereviewee,$reviewerid]);

            $revieweeListPD = $stmtbu->fetchAll('assoc'); 

            $finalArrayPD = array();
            foreach ($revieweeListPD as $ff) 
            {
                array_push($finalArrayPD, $ff['reviewerid']);
            }
            
            $finalListPD = array();
            if(sizeof($finalArrayPD) == 0)
            {
                array_push($finalListPD, $servicereviewee);
            }  
        
            //$employees = array();
            foreach ($finalListPD as $f) 
            {
                $emp = $this->service->get($f);
                $super = new ReviewEmployeeTemplate();
                $super->employee = $emp;               
                $super->revtype = $revtype;
                array_push($services,$super);
            }
            //echo "emp size ".sizeof($employees);
            $employeesfn = null;
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('employees','products','projects','services','employeesfn','menuAry','headerAry','rid','reviewerid'));
        $this->set('_serialize', ['employees','products','projects','services','employeesfn']);
    }

    public function indexorganization($rid)
    {
        $conn = ConnectionManager::get('default');

        $this->organizationreviewees = TableRegistry::get('OrganizationreviewsReviewees');
        $this->organizationreviews = TableRegistry::get('Organizationreviews');
        $this->department = TableRegistry::get('Department');
        $this->companies = TableRegistry::get('Companies');
        $this->organization = TableRegistry::get('Organizations');

        $this->employee = TableRegistry::get('Employee');

        $departments = array();
        $companys = array();
        $organizations = array();        

        $now = Date::now();
        $curTime = $now->format('Y-m-d');     

        $session = $this->request->session();
        $curuser = $session->read('userid');    

        $reviewerid = null;
        $reviewer = $this->employee->find('all')->where(['userid' => $curuser,'isdeleted' => 0])->first();
        if($reviewer != null)
        {
           $reviewerid = $reviewer->id;
        }

        $revtype = $this->organizationreviews->find('all')->where(['id' => $rid ,'isdeleted' => 0,'enddate >=' => $curTime])->first();         
        $revtype = $revtype->reviewtype_id;

        if($revtype == 8)
        {
            $deptreviewee = $this->organizationreviewees->find('all',array('fields' => array('revieweeid')))->where(['organizationreviews_id' => $rid])->first();
            $deptreviewee = $deptreviewee->revieweeid;

            $stmtbu = $conn->execute('select organizationreviews_reviewers.reviewerid 
                                        from organizationreviews_reviewers 
                                        left join organizationreviewsresults 
                                        on organizationreviewsresults.reviewerid=organizationreviews_reviewers.reviewerid
                                        where finish=1                                        
                                        and organizationreviewsresults.organizationreviews_id=?
                                        and organizationreviews_reviewers.organizationreviews_id=?
                                        and organizationreviewsresults.reviewerid=?
                                        group by organizationreviewsresults.reviewerid
                                        UNION all
                                        SELECT revieweeid
                                        FROM organizationreviewsresults
                                        where organizationreviews_id =?
                                        and revieweeid=?
                                        and reviewerid=?
                                        and finish=1',[$rid,$rid,$reviewerid,$rid,$deptreviewee,$reviewerid]);

                $revieweeListPD = $stmtbu->fetchAll('assoc'); 

                $finalArrayPD = array();
                foreach ($revieweeListPD as $ff) 
                {
                    array_push($finalArrayPD, $ff['reviewerid']);
                }
                
                $finalListPD = array();
                if(sizeof($finalArrayPD) == 0)
                {
                    array_push($finalListPD, $deptreviewee);
                }              
                
                foreach ($finalListPD as $f) 
                {
                    $emp = $this->department->get($f);
                    $super = new ReviewEmployeeTemplate();
                    $super->employee = $emp;               
                    $super->revtype = $revtype;
                    array_push($departments,$super);
                }
                //echo "emp size ".sizeof($employees);
                $employeesfn = null;
            }

        if($revtype == 9)
        {
            $companyreviewee = $this->organizationreviewees->find('all',array('fields' => array('revieweeid')))->where(['organizationreviews_id' => $rid])->first();
            $companyreviewee = $companyreviewee->revieweeid;

            $stmtbu = $conn->execute('select organizationreviews_reviewers.reviewerid 
                                        from organizationreviews_reviewers 
                                        left join organizationreviewsresults 
                                        on organizationreviewsresults.reviewerid=organizationreviews_reviewers.reviewerid
                                        where finish=1                                        
                                        and organizationreviewsresults.organizationreviews_id=?
                                        and organizationreviews_reviewers.organizationreviews_id=?
                                        and organizationreviewsresults.reviewerid=?
                                        group by organizationreviewsresults.reviewerid
                                        UNION all
                                        SELECT revieweeid
                                        FROM organizationreviewsresults
                                        where organizationreviews_id =?
                                        and revieweeid=?
                                        and reviewerid=?
                                        and finish=1',[$rid,$rid,$reviewerid,$rid,$companyreviewee,$reviewerid]);

            $revieweeListPD = $stmtbu->fetchAll('assoc'); 

            $finalArrayPD = array();
            foreach ($revieweeListPD as $ff) 
            {
                array_push($finalArrayPD, $ff['reviewerid']);
            }
            
            $finalListPD = array();
            if(sizeof($finalArrayPD) == 0)
            {
                array_push($finalListPD, $companyreviewee);
            }  
            
            foreach ($finalListPD as $f) 
            {
                $proj = $this->companies->get($f);
                $super = new ReviewEmployeeTemplate();
                $super->employee = $proj;               
                $super->revtype = $revtype;
                array_push($companys,$super);
            }
            
            $employeesfn = null;
        }

        if($revtype == 7)
        {
            $orgreviewee = $this->organizationreviewees->find('all',array('fields' => array('revieweeid')))->where(['organizationreviews_id' => $rid])->first();
            $orgreviewee = $orgreviewee->revieweeid;

            $stmtbu = $conn->execute('select organizationreviews_reviewers.reviewerid 
                                        from organizationreviews_reviewers 
                                        left join organizationreviewsresults 
                                        on organizationreviewsresults.reviewerid=organizationreviews_reviewers.reviewerid
                                        where finish=1                                        
                                        and organizationreviewsresults.organizationreviews_id=?
                                        and organizationreviews_reviewers.organizationreviews_id=?
                                        and organizationreviewsresults.reviewerid=?
                                        group by organizationreviewsresults.reviewerid
                                        UNION all
                                        SELECT revieweeid
                                        FROM organizationreviewsresults
                                        where organizationreviews_id =?
                                        and revieweeid=?
                                        and reviewerid=?
                                        and finish=1',[$rid,$rid,$reviewerid,$rid,$orgreviewee,$reviewerid]);

            $revieweeListPD = $stmtbu->fetchAll('assoc'); 

            $finalArrayPD = array();
            foreach ($revieweeListPD as $ff) 
            {
                array_push($finalArrayPD, $ff['reviewerid']);
            }
            
            $finalListPD = array();
            if(sizeof($finalArrayPD) == 0)
            {
                array_push($finalListPD, $orgreviewee);
            }  
        
            //$employees = array();
            foreach ($finalListPD as $f) 
            {
                $emp = $this->organization->get($f);
                $super = new ReviewEmployeeTemplate();
                $super->employee = $emp;               
                $super->revtype = $revtype;
                array_push($organizations,$super);
            }
            //echo "emp size ".sizeof($employees);
            $employeesfn = null;
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('employees','departments','companys','organizations','employeesfn','menuAry','headerAry','rid','reviewerid'));
        $this->set('_serialize', ['employees','departments','companys','organizations','employeesfn']);
    }
}