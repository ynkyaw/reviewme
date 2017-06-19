<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Date;
use Cake\Routing\Router;
/**
 * Employeegroup Controller
 *
 * @property \App\Model\Table\EmployeegroupTable $Employeegroup
 */
class DashboardController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->Review = TableRegistry::get('Review');
        $this->ReviewReviewer = TableRegistry::get('ReviewReviewer');
        $this->ReviewReviewee = TableRegistry::get('ReviewReviewee');
        $this->Reviewresult = TableRegistry::get('Reviewresult');

        $this->reviewcategory = TableRegistry::get('reviewcategory');
        $this->catquestion = TableRegistry::get('reviewcategory_question');
        $this->catreviewer = TableRegistry::get('reviewcategory_reviewer');

        $this->itemreviewreviewees = TableRegistry::get('ItemreviewsReviewees');
        $this->itemreviewreviewers = TableRegistry::get('ItemreviewsReviewers');
        $this->itemreviews = TableRegistry::get('itemreviews');
        $this->itemreviewsresults = TableRegistry::get('itemreviewsresults');

        $this->organizationreviewees = TableRegistry::get('OrganizationreviewsReviewees');
        $this->organizationreviewers = TableRegistry::get('OrganizationreviewsReviewers');
        $this->organizationreviews = TableRegistry::get('Organizationreviews');
        $this->organizationreviewsresults = TableRegistry::get('Organizationreviewsresults');

        $this->Employee = TableRegistry::get('Employee');
        $this->Users = TableRegistry::get('Users');      

        $logincount = Configure::read('loginCount');

        //get current login user from session
        $session = $this->request->session();
        $userid = $session->read('userid');
        $username = $session->read('username');
        //echo "userid ".$userid;
        $now = Date::now();
        $curTime = $now->format('Y-m-d' );        

        $ow_reviews = array();
        $uid = 0;
        //get current login user's info from EMPLOYEE by query
        $employee = $this->Employee->find('all')->where(['userid'=>$userid,'isdeleted' => 0])->first();
        //echo "emp ".$employee;
        if($employee != null)
        {
            $uid = $employee->id;                
        
            //get reviews by employee
            $rreviews = $this->ReviewReviewer->find('all')->where(['reviewerid'=>$employee->id]);                      

            $conn = ConnectionManager::get('default');
            $stmt = $conn->execute('SELECT DISTINCT rc.* 
                FROM reviewcategory rc INNER JOIN review r ON r.id = rc.reviewid INNER JOIN reviewcategory_reviewer rc_rw on rc.id = rc_rw.reviewcategory_id 
                    where r.isdeleted=0 and rc.isdeleted=0 and r.enddate >= ? and rc_rw.reviewer_id = ?',[$curTime,$uid]);
            $rows = $stmt->fetchAll('assoc');  
            //echo "sdfsdf ".$uid;

            $i=0;
            $reviews = [];       

            $reviews = array();
            
            $reviewspa = array();
            $ow_reviewspa = array();
            $reviewss = array();
            $ow_reviewss = array();
            $ow_finishAry = array();
            $totalMarks = 0;
            $totalQCount = 0;

            //just for owner view
            $owner_rev_id = $this->Review->find('all')->where(['owner_id' => $employee->id,'isdeleted'=>0]);
            foreach ($owner_rev_id as $od) 
            {
                $owner_rev_type = $this->Review->find('all')->where(['id' => $od->id,'isdeleted' => 0,'enddate >=' => $curTime])->first();    
                if($owner_rev_type != null)
                {   
                    if($owner_rev_type->reviewtype_id == 2)//BU
                    {
                        $ow_bufcount = 0;
                        $ow_maxreviewee = $this->ReviewReviewee->find('all')->where(['reviewid' => $owner_rev_type->id]);
                        $ow_totalreviewee = $ow_maxreviewee->count();
                        $ow_finishedreviewee = $this->Reviewresult->find('all')->where(['reviewid'=>$owner_rev_type->id,'reviewerid'=>$employee->id,'finish'=>1])->count();

                        $ow_reviewerlist = $this->ReviewReviewer->find()->where(['reviewid' => $owner_rev_type->id]);

                        //for finished list by owner
                        foreach ($ow_reviewerlist as $part) 
                        {
                            //$maxempList = $this->Review->find('all')->where(['id' => $rreview->reviewid,'isdeleted'=>0])->first();
                            $ow_maxempList = 1;
                            
                            $ow_finishedempList = $this->Reviewresult->find('all')->where(['reviewid'=>$owner_rev_type->id,'reviewerid'=>$part->reviewerid,'finish'=>1])->count();
                            
                            if($ow_maxempList == $ow_finishedempList)
                            {
                                $ow_bufcount++;
                            }
                        }

                        $conn = ConnectionManager::get('default');
                        $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.questionid)as Qcount from reviewresult rr inner join reviewresultdetail rrd on rr.id=rrd.reviewresult_id where rr.reviewid=? and rr.finish=1', [$owner_rev_type->id]);
                        $ow_totalmarkquery = $stmt->fetchAll('assoc');
                       
                        foreach ($ow_totalmarkquery as $total) 
                        {
                           $ow_totalMarks = $total['TotalMarks'];
                           $ow_totalQCount = $total['Qcount'];
                        }

                        $rev = $this->Review->get($owner_rev_type->id, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]); //to check end date

                        //echo $ow_bufcount."/".$ow_reviewerlist->count();
                        if($ow_bufcount < $ow_reviewerlist->count())
                        {        
                            //echo " in less than ";                
                            $ow_myobj = new MyTemplate();
                            $ow_myobj->review = $rev;
                            $ow_myobj->total = $ow_reviewerlist->count();
                            $ow_myobj->finish = $ow_bufcount;
                            $ow_myobj->totalmarks = $totalMarks;
                            $ow_myobj->totalqcount = $totalQCount;
                            array_push($ow_reviews, $ow_myobj);
                        }
                        if($ow_bufcount == $ow_reviewerlist->count())
                        {
                            $ow_myobj1 = new ReviewFinishTemplate();
                            $ow_myobj1->review = $rev;
                            $ow_myobj1->totalmarks = $totalMarks;
                            $ow_myobj1->totalqcount = $totalQCount;
                            $ow_myobj1->maxreview = $ow_maxempList;
                            $ow_myobj1->finish = $ow_finishedempList; 
                            array_push($ow_finishAry, $ow_myobj1);
                        }
                    }
                    if($owner_rev_type->reviewtype_id == 3)//360
                    {
                        $ow_fcount = 0;
                        // $totalreviewee = $this->ReviewReviewee->find('all')->where(['reviewid'=>$rreview->reviewid])->count();
                        $ow_maxreviewee = $this->Review->find('all')->where(['id'=>$owner_rev_type->id,'isdeleted'=>0,'enddate >=' => $curTime])->first();
                        $ow_totalreviewee =$ow_maxreviewee->maxreview; 
                        $ow_finishedreviewee = $this->Reviewresult->find('all')->where(['reviewid'=>$owner_rev_type->id,'reviewerid'=>$employee->id,'finish'=>1])->count();            
                        
                        $ow_participantList = $this->ReviewReviewee->find()->where(['reviewid' => $owner_rev_type->id]);

                        //for finished list by owner
                        foreach ($ow_participantList as $part) 
                        {
                            $ow_maxempList = $this->Review->find('all')->where(['id' => $owner_rev_type->id,'isdeleted'=>0,'enddate >=' => $curTime])->first();
                            $ow_maxempList = $ow_maxempList->maxreview;
                            $ow_finishedempList = $this->Reviewresult->find('all')->where(['reviewid'=>$owner_rev_type->id,'reviewerid'=>$part->revieweeid,'finish'=>1])->count();

                            if($ow_maxempList == $ow_finishedempList)
                            {
                                $ow_fcount++;
                            }
                        }

                        $conn = ConnectionManager::get('default');
                        $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.questionid)as Qcount from reviewresult rr inner join reviewresultdetail rrd on rr.id=rrd.reviewresult_id where rr.reviewid=? and rr.finish=1', [$owner_rev_type->id]);
                        $ow_totalmarkquery = $stmt->fetchAll('assoc');
                       
                        foreach ($ow_totalmarkquery as $total) 
                        {
                            $totalMarks = $total['TotalMarks'];
                            $totalQCount = $total['Qcount'];
                        }

                        $rev = $this->Review->get($owner_rev_type->id, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]); //to check enddate
                        
                        //echo "f ".$ow_fcount.$owner_rev_type->id."t ".$ow_participantList->count().$owner_rev_type->id;
                        if($ow_fcount < $ow_participantList->count())
                        {
                            $ow_myobj = new MyTemplate();
                            $ow_myobj->review = $rev;
                            $ow_myobj->total = $ow_participantList->count();
                            $ow_myobj->finish = $ow_fcount;
                            $ow_myobj->totalmarks = $totalMarks;
                            $ow_myobj->totalqcount = $totalQCount;
                            array_push($ow_reviews, $ow_myobj); 
                        }

                       /* echo "fcount ".$fcount."/".$participantList->count();*/
                        if($ow_fcount == $ow_participantList->count())
                        {
                            $ow_myobj1 = new ReviewFinishTemplate();
                            $ow_myobj1->review = $rev;
                            $ow_myobj1->totalmarks = $totalMarks;
                            $ow_myobj1->totalqcount = $totalQCount;
                            $ow_myobj1->maxreview = $ow_maxempList;
                            $ow_myobj1->finish = $ow_finishedempList; 
                            array_push($ow_finishAry, $ow_myobj1);
                        }                        
                    }
                    if($owner_rev_type->reviewtype_id == 4)//PA
                    {
                        $ow_totalrevieweepa = $this->ReviewReviewee->find('all')->where(['reviewid' =>$owner_rev_type->id]);
                        $ow_totalrevieweecountpa = $ow_totalrevieweepa->count();
                        $reviewerlist = $this->ReviewReviewer->find()->where(['reviewid' => $owner_rev_type->id])->first();
                        $ow_finishedrevieweepa = $this->Reviewresult->find('all')->where(['reviewid'=>$owner_rev_type->id,'reviewerid'=>$reviewerlist->reviewerid,'managercomment IS not'=>null,'employeecomment IS not'=>null,'finish'=>1])->count();
                        //echo "sdfs ".$ow_finishedrevieweepa;
                        
                        $conn = ConnectionManager::get('default');
                        $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.questionid)as Qcount from reviewresult rr inner join reviewresultdetail rrd on rr.id=rrd.reviewresult_id where rr.reviewid=? and rr.finish=1', [$owner_rev_type->id]);
                        $ow_totalmarkquery = $stmt->fetchAll('assoc');
                       
                        foreach ($ow_totalmarkquery as $total) 
                        {
                            $totalMarks = $total['TotalMarks'];
                            $totalQCount = $total['Qcount'];
                        }

                        $rev = $this->Review->get($owner_rev_type->id, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                        
                        //echo "finish ".$ow_finishedrevieweepa."tot ".$ow_totalrevieweecountpa;
                        if($ow_finishedrevieweepa < $ow_totalrevieweecountpa)
                        {
                            $ow_myobj = new MyTemplate();
                            $ow_myobj->review = $rev;
                            $ow_myobj->total = $ow_totalrevieweecountpa;
                            $ow_myobj->finish = $ow_finishedrevieweepa;
                            $ow_myobj->totalmarks = $totalMarks;
                            $ow_myobj->totalqcount = $totalQCount;
                            //echo json_encode($myobj);
                            array_push($ow_reviews, $ow_myobj);
                        }

                        if($ow_finishedrevieweepa == $ow_totalrevieweecountpa)
                        {
                            $ow_myobj = new MyTemplate();
                            $ow_myobj->review = $rev;
                            $ow_myobj->total = $ow_totalrevieweecountpa;
                            $ow_myobj->finish = $ow_finishedrevieweepa;
                            $ow_myobj->totalmarks = $totalMarks;
                            $ow_myobj->totalqcount = $totalQCount;
                            //echo json_encode($myobj);
                            array_push($ow_finishAry, $ow_myobj);
                        }
                    }

                    if($owner_rev_type->reviewtype_id == 1)//TD
                    {

                        //$owner_rev_id = $this->Review->find('all')->where(['owner_id' => $employee->id,'isdeleted'=>0]);
                        $owner_rev_cat = $this->reviewcategory->find('all')->where(['isdeleted' =>0 ,'reviewid' => $owner_rev_type->id]);
                        
                        $ow_cc = 1;
                        foreach ($owner_rev_cat as $owner_rev_cat)
                        {
                            $ow_fcount=0;
                            //echo "rid ".$r['reviewid'];
                            $session = $this->request->session();
                            $session->write('cid'.$ow_cc,$owner_rev_cat['id']);
                            $session->write('cname'.$ow_cc,$owner_rev_cat['title']);

                            $ow_maxreviewee = $this->ReviewReviewee->find('all')->where(['reviewid' => $owner_rev_cat['reviewid']]);
                            $ow_totalreviewee = $ow_maxreviewee->count();
                            $ow_finishedreviewee = $this->Reviewresult->find('all')->where(['reviewid'=>$owner_rev_cat['reviewid'],'reviewerid'=>$employee->id,'categoryid'=>$owner_rev_cat['id'],'finish'=>1])->count();
                            
                            $ow_categorylist = $this->reviewcategory->find('all')->where(['reviewid' => $owner_rev_cat['reviewid'],'isdeleted' => 0]);
                            $ow_c=0;
                            foreach ($ow_categorylist as $clist)
                            {
                                $ow_creviewerlist = $this->catreviewer->find('all')->where(['reviewcategory_id' => $clist->id])->first();
                                $ow_catreviewerlist[$ow_c] = $ow_creviewerlist->reviewer_id;
                                $ow_c++;
                            }
                            
                            $ow_cforfcount = 0; 
                            for($i=0; $i<sizeof($ow_catreviewerlist);$i++)
                            {
                                $ow_maxrevieweelist =$this->ReviewReviewee->find('all')->where(['reviewid' => $owner_rev_cat['reviewid']])->count();
                               
                                $ow_finishrevieweelist = $this->Reviewresult->find('all')->where(['reviewid' => $owner_rev_cat['reviewid'],'finish'=> 1]);
                                $ow_finishrevieweelist = $ow_finishrevieweelist->count();
                            }

                            $conn = ConnectionManager::get('default');
                            $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.questionid)as Qcount from reviewresult rr inner join reviewresultdetail rrd on rr.id=rrd.reviewresult_id where rr.reviewid=? and rr.finish=1', [$owner_rev_cat['reviewid']]);
                            $ow_totalmarkquery = $stmt->fetchAll('assoc');
                           
                            foreach ($ow_totalmarkquery as $total) 
                            {
                                $totalMarks = $total['TotalMarks'];
                                $totalQCount = $total['Qcount'];
                            }
                                            
                            $ow_cc++;
                        }
                        $owner_rev_cat = $this->reviewcategory->find('all')->where(['isdeleted' =>0 ,'reviewid' => $owner_rev_type->id])->first();
                        if($owner_rev_cat != null)
                        {
                            $rev = $this->Review->get($owner_rev_cat['reviewid'], ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);  //to check enddate
                        
                            if($ow_finishrevieweelist < $ow_maxrevieweelist*$ow_categorylist->count())
                            {
                                $ow_myobj = new MyTemplate();
                                $ow_myobj->review = $rev;
                                //echo "max ".$maxrevieweelist;
                                $ow_myobj->total = $ow_maxrevieweelist*$ow_categorylist->count();
                                //echo "finish ".$fcount;
                                $ow_myobj->finish = $ow_finishrevieweelist;
                                $ow_myobj->totalmarks = $totalMarks;
                                $ow_myobj->totalqcount = $totalQCount;
                                array_push($ow_reviews, $ow_myobj);
                            }

                            if($ow_finishrevieweelist == $ow_maxrevieweelist*$ow_categorylist->count())
                            {
                                $ow_myobj1 = new ReviewFinishTemplate();
                                $ow_myobj1->review = $rev;
                                $ow_myobj1->totalmarks = $totalMarks;
                                $ow_myobj1->totalqcount = $totalQCount;
                                $ow_myobj1->maxreview = $ow_maxrevieweelist*$ow_categorylist->count();
                                $ow_myobj1->finish = $ow_finishrevieweelist; 
                                array_push($ow_finishAry, $ow_myobj1);
                            }
                        }
                    }
                }
            //}
            }

            //owner item
            $owner_itemrev_id = $this->itemreviews->find('all')->where(['owner_id' => $employee->id,'isdeleted'=>0]);
            foreach ($owner_itemrev_id as $itemd) 
            {
                $owner_itemrev_type = $this->itemreviews->find('all')->where(['id' => $itemd->id,'isdeleted' => 0,'enddate >=' => $curTime])->first();
                if($owner_itemrev_type != null && $owner_itemrev_type->reviewtype_id == 5)
                {
                    //$ow_productreviews = $this->itemreviewreviewers->find('all')->where(['reviewerid'=>$employee->id]);
                    
                    //foreach ($ow_productreviews as $eachrev) 
                    //{
                        //$ow_productreview = $this->itemreviews->find('all')->where(['id'=>$eachrev->itemreviews_id,'isdeleted'=>0,'enddate >='=>$curTime]);                

                        //if($ow_productreview->count() != 0)
                        //{
                            $ow_totalproductreviewer = $this->itemreviewreviewers->find('all')->where(['itemreviews_id' => $owner_itemrev_type->id]);
                            
                            $ow_finishproductreviewer = $this->itemreviewsresults->find('all')->where(['itemreviews_id'=>$owner_itemrev_type->id,'finish'=>1,'isdeleted' =>0])->count();

                            $conn = ConnectionManager::get('default');
                            $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.question_id)as Qcount from itemreviewsresults rr inner join itemreviewsresultdetail rrd on rr.id=rrd.itemreviewsresult_id where rr.itemreviews_id=? and rr.finish=1', [$owner_itemrev_type->id]);
                            $ow_totalmarkquery = $stmt->fetchAll('assoc');
                           
                            foreach ($ow_totalmarkquery as $total) 
                            {
                                $totalMarks = $total['TotalMarks'];
                                $totalQCount = $total['Qcount'];
                            }

                            $rev = $this->itemreviews->get($owner_itemrev_type->id, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                            
                            //echo "total ".$ow_totalproductreviewer->count()."/finish ".$ow_finishproductreviewer;
                            if($ow_finishproductreviewer < $ow_totalproductreviewer->count())
                            {
                                $ow_myobj = new MyTemplate();
                                $ow_myobj->review = $rev;
                                $ow_myobj->total = $ow_totalproductreviewer->count();
                                $ow_myobj->finish = $ow_finishproductreviewer;
                                $ow_myobj->totalmarks = $totalMarks;
                                $ow_myobj->totalqcount = $totalQCount;
                                array_push($ow_reviews, $ow_myobj);
                            }

                            //echo "tom ".$totalMarks."toq ".$totalQCount;
                            if($ow_finishproductreviewer == $ow_totalproductreviewer->count())
                            {
                                $ow_myobj1 = new MyTemplate();
                                $ow_myobj1->review = $rev;
                                $ow_myobj1->total = $ow_totalproductreviewer->count();
                                $ow_myobj1->finish = $ow_finishproductreviewer;
                                $ow_myobj1->totalmarks = $totalMarks;
                                $ow_myobj1->totalqcount = $totalQCount;
                                array_push($ow_finishAry, $ow_myobj1);
                            }
                        //} 
                    //}
                }
                if($owner_itemrev_type != null && $owner_itemrev_type->reviewtype_id == 6)
                {
                    $ow_totalproductreviewer = $this->itemreviewreviewers->find('all')->where(['itemreviews_id' => $owner_itemrev_type->id]);
                    
                    $ow_finishproductreviewer = $this->itemreviewsresults->find('all')->where(['itemreviews_id'=>$owner_itemrev_type->id,'finish'=>1,'isdeleted' =>0])->count();

                    $conn = ConnectionManager::get('default');
                    $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.question_id)as Qcount from itemreviewsresults rr inner join itemreviewsresultdetail rrd on rr.id=rrd.itemreviewsresult_id where rr.itemreviews_id=? and rr.finish=1', [$owner_itemrev_type->id]);
                    $ow_totalmarkquery = $stmt->fetchAll('assoc');
                   
                    foreach ($ow_totalmarkquery as $total) 
                    {
                        $totalMarks = $total['TotalMarks'];
                        $totalQCount = $total['Qcount'];
                    }

                    $rev = $this->itemreviews->get($owner_itemrev_type->id, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                    
                    //echo "total ".$ow_totalproductreviewer->count()."/finish ".$ow_finishproductreviewer;
                    if($ow_finishproductreviewer < $ow_totalproductreviewer->count())
                    {
                        $ow_myobj = new MyTemplate();
                        $ow_myobj->review = $rev;
                        $ow_myobj->total = $ow_totalproductreviewer->count();
                        $ow_myobj->finish = $ow_finishproductreviewer;
                        $ow_myobj->totalmarks = $totalMarks;
                        $ow_myobj->totalqcount = $totalQCount;
                        array_push($ow_reviews, $ow_myobj);
                    }

                    //echo "tom ".$totalMarks."toq ".$totalQCount;
                    if($ow_finishproductreviewer == $ow_totalproductreviewer->count())
                    {
                        $ow_myobj1 = new MyTemplate();
                        $ow_myobj1->review = $rev;
                        $ow_myobj1->total = $ow_totalproductreviewer->count();
                        $ow_myobj1->finish = $ow_finishproductreviewer;
                        $ow_myobj1->totalmarks = $totalMarks;
                        $ow_myobj1->totalqcount = $totalQCount;
                        array_push($ow_finishAry, $ow_myobj1);
                    }
                }
                if($owner_itemrev_type != null && $owner_itemrev_type->reviewtype_id == 7)
                {
                    $ow_totalproductreviewer = $this->itemreviewreviewers->find('all')->where(['itemreviews_id' => $owner_itemrev_type->id]);
                    
                    $ow_finishproductreviewer = $this->itemreviewsresults->find('all')->where(['itemreviews_id'=>$owner_itemrev_type->id,'finish'=>1,'isdeleted' =>0])->count();

                    $conn = ConnectionManager::get('default');
                    $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.question_id)as Qcount from itemreviewsresults rr inner join itemreviewsresultdetail rrd on rr.id=rrd.itemreviewsresult_id where rr.itemreviews_id=? and rr.finish=1', [$owner_itemrev_type->id]);
                    $ow_totalmarkquery = $stmt->fetchAll('assoc');
                   
                    foreach ($ow_totalmarkquery as $total) 
                    {
                        $totalMarks = $total['TotalMarks'];
                        $totalQCount = $total['Qcount'];
                    }

                    $rev = $this->itemreviews->get($owner_itemrev_type->id, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                    
                    //echo "total ".$ow_totalproductreviewer->count()."/finish ".$ow_finishproductreviewer;
                    if($ow_finishproductreviewer < $ow_totalproductreviewer->count())
                    {
                        $ow_myobj = new MyTemplate();
                        $ow_myobj->review = $rev;
                        $ow_myobj->total = $ow_totalproductreviewer->count();
                        $ow_myobj->finish = $ow_finishproductreviewer;
                        $ow_myobj->totalmarks = $totalMarks;
                        $ow_myobj->totalqcount = $totalQCount;
                        array_push($ow_reviews, $ow_myobj);
                    }

                    //echo "tom ".$totalMarks."toq ".$totalQCount;
                    if($ow_finishproductreviewer == $ow_totalproductreviewer->count())
                    {
                        $ow_myobj1 = new MyTemplate();
                        $ow_myobj1->review = $rev;
                        $ow_myobj1->total = $ow_totalproductreviewer->count();
                        $ow_myobj1->finish = $ow_finishproductreviewer;
                        $ow_myobj1->totalmarks = $totalMarks;
                        $ow_myobj1->totalqcount = $totalQCount;
                        array_push($ow_finishAry, $ow_myobj1);
                    }
                }
            }

            //owner organization
            $owner_orgrev_id = $this->organizationreviews->find('all')->where(['owner_id' => $employee->id,'isdeleted'=>0]);
            foreach ($owner_orgrev_id as $orgd) 
            {
                $owner_orgrev_type = $this->organizationreviews->find('all')->where(['id' => $orgd->id,'isdeleted' => 0,'enddate >=' => $curTime])->first();
                if($owner_orgrev_type != null && $owner_orgrev_type->reviewtype_id == 8)
                {
                    $ow_totaldeptreviewer = $this->organizationreviewers->find('all')->where(['organizationreviews_id' => $owner_orgrev_type->id]);
                    
                    $ow_finishdeptreviewer = $this->organizationreviewsresults->find('all')->where(['organizationreviews_id'=>$owner_orgrev_type->id,'finish'=>1,'isdeleted' =>0])->count();

                    $conn = ConnectionManager::get('default');
                    $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.question_id)as Qcount from organizationreviewsresults rr inner join organizationreviewsresultdetail rrd on rr.id=rrd.organizationreviewsresult_id where rr.organizationreviews_id=? and rr.finish=1', [$owner_itemrev_type->id]);
                    $ow_totalmarkquery = $stmt->fetchAll('assoc');
                   
                    foreach ($ow_totalmarkquery as $total) 
                    {
                        $totalMarks = $total['TotalMarks'];
                        $totalQCount = $total['Qcount'];
                    }

                    $rev = $this->organizationreviews->get($owner_orgrev_type->id, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                    
                    //echo "total ".$ow_totalproductreviewer->count()."/finish ".$ow_finishproductreviewer;
                    if($ow_finishdeptreviewer < $ow_totaldeptreviewer->count())
                    {
                        $ow_myobj = new MyTemplate();
                        $ow_myobj->review = $rev;
                        $ow_myobj->total = $ow_totaldeptreviewer->count();
                        $ow_myobj->finish = $ow_finishdeptreviewer;
                        $ow_myobj->totalmarks = $totalMarks;
                        $ow_myobj->totalqcount = $totalQCount;
                        array_push($ow_reviews, $ow_myobj);
                    }

                    //echo "tom ".$totalMarks."toq ".$totalQCount;
                    if($ow_finishdeptreviewer == $ow_totaldeptreviewer->count())
                    {
                        $ow_myobj1 = new MyTemplate();
                        $ow_myobj1->review = $rev;
                        $ow_myobj1->total = $ow_totaldeptreviewer->count();
                        $ow_myobj1->finish = $ow_finishdeptreviewer;
                        $ow_myobj1->totalmarks = $totalMarks;
                        $ow_myobj1->totalqcount = $totalQCount;
                        array_push($ow_finishAry, $ow_myobj1);
                    }
                }
                if($owner_orgrev_type != null && $owner_orgrev_type->reviewtype_id == 9)
                {
                    $ow_totaldeptreviewer = $this->organizationreviewers->find('all')->where(['organizationreviews_id' => $owner_orgrev_type->id]);
                    
                    $ow_finishdeptreviewer = $this->organizationreviewsresults->find('all')->where(['organizationreviews_id'=>$owner_orgrev_type->id,'finish'=>1,'isdeleted' =>0])->count();

                    $conn = ConnectionManager::get('default');
                    $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.question_id)as Qcount from organizationreviewsresults rr inner join organizationreviewsresultdetail rrd on rr.id=rrd.organizationreviewsresult_id where rr.organizationreviews_id=? and rr.finish=1', [$owner_itemrev_type->id]);
                    $ow_totalmarkquery = $stmt->fetchAll('assoc');
                   
                    foreach ($ow_totalmarkquery as $total) 
                    {
                        $totalMarks = $total['TotalMarks'];
                        $totalQCount = $total['Qcount'];
                    }

                    $rev = $this->organizationreviews->get($owner_orgrev_type->id, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                    
                    //echo "total ".$ow_totalproductreviewer->count()."/finish ".$ow_finishproductreviewer;
                    if($ow_finishdeptreviewer < $ow_totaldeptreviewer->count())
                    {
                        $ow_myobj = new MyTemplate();
                        $ow_myobj->review = $rev;
                        $ow_myobj->total = $ow_totaldeptreviewer->count();
                        $ow_myobj->finish = $ow_finishdeptreviewer;
                        $ow_myobj->totalmarks = $totalMarks;
                        $ow_myobj->totalqcount = $totalQCount;
                        array_push($ow_reviews, $ow_myobj);
                    }

                    //echo "tom ".$totalMarks."toq ".$totalQCount;
                    if($ow_finishdeptreviewer == $ow_totaldeptreviewer->count())
                    {
                        $ow_myobj1 = new MyTemplate();
                        $ow_myobj1->review = $rev;
                        $ow_myobj1->total = $ow_totaldeptreviewer->count();
                        $ow_myobj1->finish = $ow_finishdeptreviewer;
                        $ow_myobj1->totalmarks = $totalMarks;
                        $ow_myobj1->totalqcount = $totalQCount;
                        array_push($ow_finishAry, $ow_myobj1);
                    }
                }
                if($owner_itemrev_type != null && $owner_itemrev_type->reviewtype_id == 10)
                {
                    $ow_totaldeptreviewer = $this->organizationreviewers->find('all')->where(['organizationreviews_id' => $owner_orgrev_type->id]);
                    
                    $ow_finishdeptreviewer = $this->organizationreviewsresults->find('all')->where(['organizationreviews_id'=>$owner_orgrev_type->id,'finish'=>1,'isdeleted' =>0])->count();

                    $conn = ConnectionManager::get('default');
                    $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.question_id)as Qcount from organizationreviewsresults rr inner join organizationreviewsresultdetail rrd on rr.id=rrd.organizationreviewsresult_id where rr.organizationreviews_id=? and rr.finish=1', [$owner_itemrev_type->id]);
                    $ow_totalmarkquery = $stmt->fetchAll('assoc');
                   
                    foreach ($ow_totalmarkquery as $total) 
                    {
                        $totalMarks = $total['TotalMarks'];
                        $totalQCount = $total['Qcount'];
                    }

                    $rev = $this->organizationreviews->get($owner_orgrev_type->id, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                    
                    //echo "total ".$ow_totalproductreviewer->count()."/finish ".$ow_finishproductreviewer;
                    if($ow_finishdeptreviewer < $ow_totaldeptreviewer->count())
                    {
                        $ow_myobj = new MyTemplate();
                        $ow_myobj->review = $rev;
                        $ow_myobj->total = $ow_totaldeptreviewer->count();
                        $ow_myobj->finish = $ow_finishdeptreviewer;
                        $ow_myobj->totalmarks = $totalMarks;
                        $ow_myobj->totalqcount = $totalQCount;
                        array_push($ow_reviews, $ow_myobj);
                    }

                    //echo "tom ".$totalMarks."toq ".$totalQCount;
                    if($ow_finishdeptreviewer == $ow_totaldeptreviewer->count())
                    {
                        $ow_myobj1 = new MyTemplate();
                        $ow_myobj1->review = $rev;
                        $ow_myobj1->total = $ow_totaldeptreviewer->count();
                        $ow_myobj1->finish = $ow_finishdeptreviewer;
                        $ow_myobj1->totalmarks = $totalMarks;
                        $ow_myobj1->totalqcount = $totalQCount;
                        array_push($ow_finishAry, $ow_myobj1);
                    }
                }
            }

            //for member
            foreach ($rreviews as $rreview) 
            {
                $revType = $this->Review->find('all')->where(['id' => $rreview->reviewid,'isdeleted' => 0,'enddate >=' => $curTime])->first();
    		 //echo json_encode($revType );
                if($revType != null && $revType->isdeleted==false)
                {     
                    if($revType->reviewtype_id == 2)//BU
                    {
                        $bufcount = 0;
                        $maxreviewee = $this->ReviewReviewee->find('all')->where(['reviewid' => $revType->id]);
                        $totalreviewee = $maxreviewee->count();
                        $finishedreviewee = $this->Reviewresult->find('all')->where(['reviewid'=>$rreview->reviewid,'reviewerid'=>$employee->id,'finish'=>1])->count();

                        $reviewerlist = $this->ReviewReviewer->find()->where(['reviewid' => $rreview->reviewid]);

                        $maxempList = 1;
                        
                        $finishedempList = $this->Reviewresult->find('all')->where(['reviewid'=>$rreview->reviewid,'reviewerid'=>$employee->id,'finish'=>1])->count();
                        $bufcount++;

                        $conn = ConnectionManager::get('default');
                        $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.questionid)as Qcount from reviewresult rr inner join reviewresultdetail rrd on rr.id=rrd.reviewresult_id where rr.reviewid=? and rr.finish=1', [$rreview->reviewid]);
                        $totalmarkquery = $stmt->fetchAll('assoc');
                       
                        foreach ($totalmarkquery as $total) 
                        {
                           $totalMarks = $total['TotalMarks'];
                           $totalQCount = $total['Qcount'];
                        }

                        $rev = $this->Review->get($rreview->reviewid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]); //to check end date
                     
                        $myobj = new MyTemplate();
                        $myobj->review = $rev;
                        $myobj->total = 1; //$reviewerlist->count();
                        $myobj->finish = $finishedempList;
                        $myobj->totalmarks = $totalMarks;
                        $myobj->totalqcount = $totalQCount;
                        array_push($reviews, $myobj);
                    }

                    if($revType->reviewtype_id == 3)//360
                    {
                        $fcount = 0;
                        // $totalreviewee = $this->ReviewReviewee->find('all')->where(['reviewid'=>$rreview->reviewid])->count();
                        $maxreviewee = $this->Review->find('all')->where(['id'=>$rreview->reviewid,'isdeleted'=>0,'enddate >=' => $curTime])->first();
                        $totalreviewee =$maxreviewee->maxreview; 
                        $finishedreviewee = $this->Reviewresult->find('all')->where(['reviewid'=>$rreview->reviewid,'reviewerid'=>$employee->id,'finish'=>1])->count();            
                        
                        $participantList = $this->ReviewReviewee->find()->where(['reviewid' => $rreview->reviewid]);

                        //for finished list by owner
                        //foreach ($participantList as $part) 
                        //{
                        $maxempList = $this->Review->find('all')->where(['id' => $rreview->reviewid,'isdeleted'=>0,'enddate >=' => $curTime])->first();
                        $maxempList = $maxempList->maxreview;
                        $finishedempList = $this->Reviewresult->find('all')->where(['reviewid'=>$rreview->reviewid,'reviewerid'=>$employee->id,'finish'=>1])->count();

                        /*if($maxempList == $finishedempList)
                        {
                            $fcount++;
                        }*/
                        //}

                        $conn = ConnectionManager::get('default');
                        $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.questionid)as Qcount from reviewresult rr inner join reviewresultdetail rrd on rr.id=rrd.reviewresult_id where rr.reviewid=? and rr.finish=1', [$rreview->reviewid]);
                        $totalmarkquery = $stmt->fetchAll('assoc');
                       
                        foreach ($totalmarkquery as $total) 
                        {
                            $totalMarks = $total['TotalMarks'];
                            $totalQCount = $total['Qcount'];
                        }

                        $rev = $this->Review->get($rreview->reviewid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]); //to check enddate
                        
                        if($fcount < $participantList->count())
                        {
                            $myobj = new MyTemplate();
                            $myobj->review = $rev;
                            $myobj->total = $participantList->count();
                            $myobj->finish = $finishedempList;
                            $myobj->totalmarks = $totalMarks;
                            $myobj->totalqcount = $totalQCount;
                            array_push($reviews, $myobj); 
                        }
                    }

                    if($revType->reviewtype_id == 4)//PA
                    {
                        $totalrevieweepa = $this->ReviewReviewee->find('all')->where(['reviewid' => $revType->id]);
                        $totalrevieweecountpa = $totalrevieweepa->count();
                        
                        $finishedrevieweepa = $this->Reviewresult->find('all')->where(['reviewid'=>$rreview->reviewid,'reviewerid'=>$employee->id,'managercomment IS'=>null,'employeecomment IS'=>null,'finish'=>1])->count();
                        
                        $conn = ConnectionManager::get('default');
                        $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.questionid)as Qcount from reviewresult rr inner join reviewresultdetail rrd on rr.id=rrd.reviewresult_id where rr.reviewid=? and rr.finish=1', [$rreview->reviewid]);
                        $totalmarkquery = $stmt->fetchAll('assoc');
                       
                        foreach ($totalmarkquery as $total) 
                        {
                            $totalMarks = $total['TotalMarks'];
                            $totalQCount = $total['Qcount'];
                        }

                        $rev = $this->Review->get($rreview->reviewid, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                        
                        $myobj = new MyTemplate();
                        $myobj->review = $rev;
                        $myobj->total = $totalrevieweecountpa;
                        $myobj->finish = $finishedrevieweepa;
                        $myobj->totalmarks = $totalMarks;
                        $myobj->totalqcount = $totalQCount;
                        //echo json_encode($myobj);
                        array_push($reviews, $myobj);
                    }
                } //if            
            } //end of foreach

            //pa
            $totalreviewpa = $this->ReviewReviewee->find('all')->where(['revieweeid' => $employee->id]);
            foreach ($totalreviewpa as $rev) 
            {
                $reviewType = $this->Review->find('all')->where(['id' => $rev->reviewid,'isdeleted' => 0,'enddate >=' => $curTime])->first();
                //echo json_encode($revType );
                if($reviewType != null && $reviewType->isdeleted==false)
                {     
                    if($reviewType->reviewtype_id == 4)
                    {
                        $totalrevieweepa = $this->ReviewReviewee->find('all')->where(['reviewid' => $reviewType->id]);
                        $totalrevieweecountpa = $totalrevieweepa->count();
                        
                        $finishedrevieweepa = $this->Reviewresult->find('all')->where(['reviewid'=>$reviewType->id,'reviewerid'=>$employee->id,'finish'=>1])->count();
                        
                        $rev = $this->Review->get($reviewType->id, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                        
                        $reviewowner = $this->ReviewReviewer->find('all')->where(['reviewid' => $reviewType->id])->first();

                        $session = $this->request->session();
                        $session->write('reviewowner',$reviewowner->reviewerid);                    

                        $myobj = new MyTemplate();
                        $myobj->review = $rev;
                        $myobj->total = $totalrevieweecountpa;
                        $myobj->finish = $finishedrevieweepa;
                        $myobj->totalmarks = 0;
                        $myobj->totalqcount = 0;
                        array_push($reviewspa, $myobj);
                    }
                }
            }

            //$revcat = $this->reviewcategory->find('all')->where(['reviewid' => $r['reviewid'],'isdeleted' => 0]);           

            $cc = 1;
            foreach ($rows as $r) //TD
            {
                $fcount=0;
                //echo "rid ".$r['reviewid'];
                $session = $this->request->session();
                $session->write('cid'.$cc,$r['id']);
                $session->write('cname'.$cc,$r['title']);

                $maxreviewee = $this->ReviewReviewee->find('all')->where(['reviewid' => $r['reviewid']]);
                $totalreviewee = $maxreviewee->count();
                $finishedreviewee = $this->Reviewresult->find('all')->where(['reviewid'=>$r['reviewid'],'reviewerid'=>$employee->id,'categoryid'=>$r['id'],'finish'=>1])->count();
                
                $categorylist = $this->reviewcategory->find('all')->where(['reviewid' => $r['reviewid'],'isdeleted' => 0]);
                $c=0;
                foreach ($categorylist as $clist)
                {
                    $creviewerlist = $this->catreviewer->find('all')->where(['reviewcategory_id' => $clist->id])->first();
                    $catreviewerlist[$c] = $creviewerlist->reviewer_id;
                    $c++;
                }
                
                $cforfcount = 0; 
                for($i=0; $i<sizeof($catreviewerlist);$i++)
                {
                    $maxrevieweelist =$this->ReviewReviewee->find('all')->where(['reviewid' => $r['reviewid']])->count();
                   
                    $finishrevieweelist = $this->Reviewresult->find('all')->where(['reviewid' => $r['reviewid'],'reviewerid' => $employee->id,'finish'=> 1]);
                    $finishrevieweelist = $finishrevieweelist->count();
                }

                $conn = ConnectionManager::get('default');
                $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.questionid)as Qcount from reviewresult rr inner join reviewresultdetail rrd on rr.id=rrd.reviewresult_id where rr.reviewid=? and rr.finish=1', [$r['reviewid']]);
                $totalmarkquery = $stmt->fetchAll('assoc');
               
                foreach ($totalmarkquery as $total) 
                {
                    $totalMarks = $total['TotalMarks'];
                    $totalQCount = $total['Qcount'];
                }

                $rev = $this->Review->get($r['reviewid'], ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);  //to check enddate

                if($finishrevieweelist < $maxrevieweelist)
                {
                    $myobj = new MyTemplate();
                    $myobj->review = $rev;
                    //echo "max ".$maxrevieweelist;
                    $myobj->total = $maxrevieweelist;
                    //echo "finish ".$fcount;
                    $myobj->finish = $finishrevieweelist;
                    $myobj->totalmarks = $totalMarks;
                    $myobj->totalqcount = $totalQCount;
                    array_push($reviews, $myobj);
                }             
                $cc++;
            }

            //product review
            $productreviews = $this->itemreviewreviewers->find('all')->where(['reviewerid'=>$employee->id]);
            
            foreach ($productreviews as $eachrev) 
            {
                $productreview = $this->itemreviews->find('all')->where(['id'=>$eachrev->itemreviews_id,'isdeleted'=>0,'enddate >='=>$curTime]);                

                if($productreview->count() != 0)
                {
                   // $totalproductreviewer = $this->itemreviewreviewers->find('all')->where(['itemreviews_id' => $eachrev->itemreviews_id]);
                    
                    $finishproductreviewer = $this->itemreviewsresults->find('all')->where(['itemreviews_id'=>$eachrev->itemreviews_id,'reviewerid'=> $employee->id,'finish'=>1])->count();

                    $conn = ConnectionManager::get('default');
                    $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.question_id)as Qcount from itemreviewsresults rr inner join itemreviewsresultdetail rrd on rr.id=rrd.itemreviewsresult_id where rr.itemreviews_id=? and rr.finish=1', [$eachrev->itemreviews_id]);
                    $totalmarkquery = $stmt->fetchAll('assoc');
                   
                    foreach ($totalmarkquery as $total) 
                    {
                        $totalMarks = $total['TotalMarks'];
                        $totalQCount = $total['Qcount'];
                    }

                    $rev = $this->itemreviews->get($eachrev->itemreviews_id, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                
                    $myobj = new MyTemplate();
                    $myobj->review = $rev;
                    $myobj->total = 1;
                    $myobj->finish = $finishproductreviewer;
                    $myobj->totalmarks = $totalMarks;
                    $myobj->totalqcount = $totalQCount;
                    array_push($reviews, $myobj);
                } 
            }

            //organization review
            $organizationreviews = $this->organizationreviewers->find('all')->where(['reviewerid'=>$employee->id]);
            
            foreach ($organizationreviews as $eachrev) 
            {
                $organizationreview = $this->organizationreviews->find('all')->where(['id'=>$eachrev->organizationreviews_id,'isdeleted'=>0,'enddate >='=>$curTime]);                

                if($organizationreview->count() != 0)
                {
                   // $totalproductreviewer = $this->itemreviewreviewers->find('all')->where(['itemreviews_id' => $eachrev->itemreviews_id]);
                    
                    $finishorgreviewer = $this->organizationreviewsresults->find('all')->where(['organizationreviews_id'=>$eachrev->organizationreviews_id,'reviewerid'=> $employee->id,'finish'=>1])->count();

                    $conn = ConnectionManager::get('default');
                    $stmt = $conn->execute('select sum(rrd.mark) as TotalMarks,count(rrd.question_id)as Qcount from organizationreviewsresults rr inner join organizationreviewsresultdetail rrd on rr.id=rrd.organizationreviewsresult_id where rr.organizationreviews_id=? and rr.finish=1', [$eachrev->itemreviews_id]);
                    $totalmarkquery = $stmt->fetchAll('assoc');
                   
                    foreach ($totalmarkquery as $total) 
                    {
                        $totalMarks = $total['TotalMarks'];
                        $totalQCount = $total['Qcount'];
                    }

                    $rev = $this->organizationreviews->get($eachrev->organizationreviews_id, ['conditions'  => ['enddate >= '=>$curTime,'isdeleted'=>0]]);//to check enddate
                
                    $myobj = new MyTemplate();
                    $myobj->review = $rev;
                    $myobj->total = 1;
                    $myobj->finish = $finishorgreviewer;
                    $myobj->totalmarks = $totalMarks;
                    $myobj->totalqcount = $totalQCount;
                    array_push($reviews, $myobj);
                } 
            }
        }
        else
        {
            $reviews = $reviewspa = $rreviews = null;
        }

        //echo Router::url( $this->here, true );

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('reviews','ow_reviews','ow_finishAry','reviewspa','finishAry','urole','uid','rreviews','menuAry','headerAry','logincount'));
        $this->set('_serialize', ['reviews','reviewspa','finishAry','urole','uid','rreviews','menuAry','headerAry','logincount']);
    }
}