<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Date;

/**
 * Reviewresult Controller
 *
 * @property \App\Model\Table\ReviewresultTable $Reviewresult
 */
class ReportController extends AppController
{

    public $components = array('RequestHandler');

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function index()
    {
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('headerAry'));
        $this->set('_serialize', []);
    }

    public function byquestion()
    {
        $this->Users = TableRegistry::get('Users');
        $conn = ConnectionManager::get('default');

        $this->review = TableRegistry::get('Review');
        $this->reviewresult = TableRegistry::get('Reviewresult');
        $this->employee = TableRegistry::get('Employee');
        $this->dept = TableRegistry::get('Department');    

        $now = Date::now();
        $curTime = $now->format('Y-m-d');    

        $review = $conn->execute('select distinct review.id,review.title from reviewresult inner join review on review.id=reviewresult.reviewid where reviewresult.finish=1 and review.isdeleted=0 and review.enddate >=?',[$curTime]);
        $rows = $review->fetchAll('assoc');

        $jsonStr = "{";
        $jsonStr .= "\"0\":\"None\",";
        foreach ($rows as $row) 
        {
            $jsonStr .= "\"".$row['id']."\":\"".$row['title']."\",";
        }
        
        $jsonStr=substr_replace($jsonStr,"", strlen($jsonStr)-1);
        $jsonStr .="}";
              
        $reviewlist = json_decode($jsonStr);    

        $emplist = $this->employee->find('list')->select(['id','name'])->where(['isdeleted' =>0])->toArray();
        
        $deptlist = $this->dept->find('list')->select(['id','departmentname'])->where(['isdeleted' => 0])->toArray();

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('reviewlist','emplist','deptlist','menuAry','headerAry'));
        $this->set('_serialize', ['reviewlist','emplist','deptlist']);
    }

    function autoComplete() 
    {
        $now = Date::now();
        $curTime = $now->format('Y-m-d');

        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('select distinct review.title from reviewresult inner join review on review.id=reviewresult.reviewid where reviewresult.finish=1 and review.isdeleted=0 and review.enddate >=?',[$curTime]);
        $rows = $stmt->fetchAll('assoc');            
        $jsonStr = "{\"result\":[";
        foreach ($rows as $row) {
            // Do work
            $jsonStr .= json_encode($row).",";
        }

        $jsonStr=substr_replace($jsonStr,"", strlen($jsonStr)-1);
        $jsonStr .="]}";
        echo $jsonStr;        

        die();   
    }

    public function comparisonbyquestion()
    {
        $this->Users = TableRegistry::get('Users');
        $conn = ConnectionManager::get('default');

        $this->review = TableRegistry::get('Review');
        $this->reviewresult = TableRegistry::get('Reviewresult');
        $this->employee = TableRegistry::get('Employee');
        $this->dept = TableRegistry::get('Department');    

        $now = Date::now();
        $curTime = $now->format('Y-m-d');    

        $review = $conn->execute('select distinct review.id,review.title,year(review.startdate) as startdate from reviewresult inner join review on review.id=reviewresult.reviewid where reviewresult.finish=1 and review.isdeleted=0 and review.enddate >=?',[$curTime]);
        $rows = $review->fetchAll('assoc');

        $reviewjson = "{";
        $reviewjson .= "\"0\":\"None\",";
        foreach ($rows as $row) 
        {
            $reviewjson .= "\"".$row['id']."\":\"".$row['title']."\",";
        }
        
        $reviewjson=substr_replace($reviewjson,"", strlen($reviewjson)-1);
        $reviewjson .="}";
              
        $reviewlist = json_decode($reviewjson);    

        $emplist = $this->employee->find('list')->select(['id','name'])->where(['isdeleted' =>0])->toArray();
        
        //$deptlist = $this->dept->find('list')->select(['id','departmentname'])->where(['isdeleted' => 0])->toArray();
        $depart = $conn->execute('select distinct department.id,department.departmentname from reviewresult inner join employee on employee.id=reviewresult.revieweeid inner join department on department.id=employee.departmentid where reviewresult.finish=1');
        $deptrows = $depart->fetchAll('assoc');

        $deptjson = "{";
        $deptjson .= "\"0\":\"None\",";
        foreach ($deptrows as $row) 
        {
            $deptjson .= "\"".$row['id']."\":\"".$row['departmentname']."\",";
        }
        
        $deptjson=substr_replace($deptjson,"", strlen($deptjson)-1);
        $deptjson .="}";              
        $deptlist = json_decode($deptjson);

        $yearjson = "{";
        $yearjson .= "\"0\":\"None\",";
        foreach ($rows as $row) 
        {
            $yearjson .= "\"".$row['startdate']."\":\"".$row['startdate']."\",";
        }
        
        $yearjson=substr_replace($yearjson,"", strlen($yearjson)-1);
        $yearjson .="}";
              
        $yearlist = json_decode($yearjson); 

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('reviewlist','emplist','deptlist','yearlist','menuAry','headerAry'));
        $this->set('_serialize', ['reviewlist','emplist','deptlist']);
    }

    public function comparisonbyquestioncategory()
    {
        $this->Users = TableRegistry::get('Users');
        $conn = ConnectionManager::get('default');

        $this->review = TableRegistry::get('Review');
        $this->reviewresult = TableRegistry::get('Reviewresult');
        $this->employee = TableRegistry::get('Employee');
        $this->dept = TableRegistry::get('Department');    

        $now = Date::now();
        $curTime = $now->format('Y-m-d');    

        //for review combo
        $review = $conn->execute('select distinct review.id,review.title,year(review.startdate) as startdate from reviewresult inner join review on review.id=reviewresult.reviewid where reviewresult.finish=1 and review.isdeleted=0 and review.enddate >=?',[$curTime]);
        $rows = $review->fetchAll('assoc');

        $reviewjson = "{";
        $reviewjson .= "\"0\":\"None\",";
        foreach ($rows as $row) 
        {
            $reviewjson .= "\"".$row['id']."\":\"".$row['title']."\",";
        }
        
        $reviewjson=substr_replace($reviewjson,"", strlen($reviewjson)-1);
        $reviewjson .="}";
              
        $reviewlist = json_decode($reviewjson);    

        //for emp combo
        $emplist = $this->employee->find('list')->select(['id','name'])->where(['isdeleted' =>0])->toArray();
        
        //for department combo
        $depart = $conn->execute('select distinct department.id,department.departmentname from reviewresult inner join employee on employee.id=reviewresult.revieweeid inner join department on department.id=employee.departmentid where reviewresult.finish=1');
        $deptrows = $depart->fetchAll('assoc');

        $deptjson = "{";
        $deptjson .= "\"0\":\"None\",";
        foreach ($deptrows as $row) 
        {
            $deptjson .= "\"".$row['id']."\":\"".$row['departmentname']."\",";
        }
        
        $deptjson=substr_replace($deptjson,"", strlen($deptjson)-1);
        $deptjson .="}";              
        $deptlist = json_decode($deptjson);

        //for review year combo
        $yearjson = "{";
        $yearjson .= "\"0\":\"None\",";
        foreach ($rows as $row) 
        {
            $yearjson .= "\"".$row['startdate']."\":\"".$row['startdate']."\",";
        }
        
        $yearjson=substr_replace($yearjson,"", strlen($yearjson)-1);
        $yearjson .="}";
              
        $yearlist = json_decode($yearjson); 

        //layout
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('reviewlist','emplist','deptlist','yearlist','menuAry','headerAry'));
        $this->set('_serialize', ['reviewlist','emplist','deptlist']);
    }

    public function comparisonemployee()
    {
        $this->Users = TableRegistry::get('Users');
        $conn = ConnectionManager::get('default');

        $this->review = TableRegistry::get('Review');
        $this->reviewresult = TableRegistry::get('Reviewresult');
        $this->employee = TableRegistry::get('Employee');
        $this->dept = TableRegistry::get('Department');    

        $now = Date::now();
        $curTime = $now->format('Y-m-d');    

        //for review combo
        $review = $conn->execute('select distinct review.id,review.title,year(review.startdate) as startdate from reviewresult inner join review on review.id=reviewresult.reviewid where reviewresult.finish=1 and review.isdeleted=0 and review.enddate >=?',[$curTime]);
        $rows = $review->fetchAll('assoc');

        $reviewjson = "{";
        $reviewjson .= "\"0\":\"None\",";
        foreach ($rows as $row) 
        {
            $reviewjson .= "\"".$row['id']."\":\"".$row['title']."\",";
        }
        
        $reviewjson=substr_replace($reviewjson,"", strlen($reviewjson)-1);
        $reviewjson .="}";
              
        $reviewlist = json_decode($reviewjson);    

        //for emp combo
        $emplist = $this->employee->find('list')->select(['id','name'])->where(['isdeleted' =>0])->toArray();
        
        //for department combo
        $depart = $conn->execute('select distinct department.id,department.departmentname from reviewresult inner join employee on employee.id=reviewresult.revieweeid inner join department on department.id=employee.departmentid where reviewresult.finish=1');
        $deptrows = $depart->fetchAll('assoc');

        $deptjson = "{";
        $deptjson .= "\"0\":\"None\",";
        foreach ($deptrows as $row)
        {
            $deptjson .= "\"".$row['id']."\":\"".$row['departmentname']."\",";
        }
        
        $deptjson=substr_replace($deptjson,"", strlen($deptjson)-1);
        $deptjson .="}";              
        $deptlist = json_decode($deptjson);

        //for review year combo
        $yearjson = "{";
        $yearjson .= "\"0\":\"None\",";
        foreach ($rows as $row) 
        {
            $yearjson .= "\"".$row['startdate']."\":\"".$row['startdate']."\",";
        }
        
        $yearjson=substr_replace($yearjson,"", strlen($yearjson)-1);
        $yearjson .="}";
              
        $yearlist = json_decode($yearjson); 

        //layout
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('reviewlist','emplist','deptlist','yearlist','menuAry','headerAry'));
        $this->set('_serialize', ['reviewlist','emplist','deptlist']);
    }

    public function byproductquestion()
    {
        $this->Users = TableRegistry::get('Users');
        $conn = ConnectionManager::get('default');

        $this->review = TableRegistry::get('Review');
        $this->itemreview = TableRegistry::get('itemreviews');
        $this->reviewresult = TableRegistry::get('Reviewresult');
        $this->employee = TableRegistry::get('Employee');
        $this->dept = TableRegistry::get('Department');    

        $now = Date::now();
        $curTime = $now->format('Y-m-d'); 
        //echo "curtime ".$curTime;   

        $review = $conn->execute('select distinct itemreviews.id,itemreviews.title from itemreviewsresults inner join itemreviews on itemreviews.id=itemreviewsresults.itemreviews_id where itemreviewsresults.finish=1 and itemreviews.isdeleted=0 and itemreviews.enddate >=?',[$curTime]);
        $rows = $review->fetchAll('assoc');

        $jsonStr = "{";
        $jsonStr .= "\"0\":\"None\",";
        foreach ($rows as $row) 
        {
            $jsonStr .= "\"".$row['id']."\":\"".$row['title']."\",";
        }
        
        $jsonStr=substr_replace($jsonStr,"", strlen($jsonStr)-1);
        $jsonStr .="}";
        
        //echo "jsonstr ".$jsonStr; 
        $reviewlist = json_decode($jsonStr);    

        $emplist = $this->employee->find('list')->select(['id','name'])->where(['isdeleted' =>0])->toArray();
        
        $deptlist = $this->dept->find('list')->select(['id','departmentname'])->where(['isdeleted' => 0])->toArray();

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('reviewlist','emplist','deptlist','menuAry','headerAry'));
        $this->set('_serialize', ['reviewlist','emplist','deptlist']);
    }

    public function getempList($deptid)
    {
        //$this->department = TableRegistry::get('Department');
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT distinct employee.id,employee.name FROM EMPLOYEE inner join department on department.id=employee.departmentid where employee.isdeleted=0 and department.isdeleted=0 and employee.departmentid= ? and employee.id IN(select distinct revieweeid from reviewresult where reviewresult.finish=1)', [$deptid]);
        $rows = $stmt->fetchAll('assoc');            
        $jsonStr = "{\"result\":[";
        foreach ($rows as $row) {
            // Do work
            $jsonStr .= json_encode($row).",";

        }
        $jsonStr=substr_replace($jsonStr,"", strlen($jsonStr)-1);
        $jsonStr .="]}";
        echo $jsonStr;        

        die();        
    }

    //original is (parameter is revid and search by it)
    public function getdeptList($revname)
    {            
        $conn = ConnectionManager::get('default');

        $this->review = TableRegistry::get('Review');

        $revid = $this->review->find()->where(['isdeleted' =>0 ,'title' => $revname])->first();
        //echo "rev id is ".$revid->id;
        //die();

        $stmt = $conn->execute('select distinct department.id,department.departmentname from reviewresult inner join employee on employee.id=reviewresult.revieweeid inner join department on department.id=employee.departmentid where reviewresult.finish=1 and reviewresult.reviewid=?', [$revid->id]);
        $rows = $stmt->fetchAll('assoc');            
        $jsonStr = "{\"result\":[";
        foreach ($rows as $row) {
            // Do work
            $jsonStr .= json_encode($row).",";

        }
        $jsonStr=substr_replace($jsonStr,"", strlen($jsonStr)-1);
        $jsonStr .="]}";
        echo $jsonStr;        

        die();        
    }

    public function getreviewlist($revyear=0)
    {
        $conn1 = ConnectionManager::get('default');

        $stmt = $conn1->execute('SELECT distinct id,title FROM REVIEW where isdeleted=0 and year(startdate) =? and id IN(select reviewid from reviewresult where finish=1 )', [$revyear]);
        //die();
        $rows = $stmt->fetchAll('assoc');            
        $jsonStr1 = "{\"result\":[";
        foreach ($rows as $row) 
        {
            // Do work
            $jsonStr1 .= json_encode($row).",";
        }
        $jsonStr1=substr_replace($jsonStr1,"", strlen($jsonStr1)-1);
        $jsonStr1 .="]}";
        echo $jsonStr1;        

        die(); 
    }

    public function getsingleitemdeptlist($revid)
    {

    }

    public function getResult($deptid,$rname)
    {
        $conn = ConnectionManager::get('default');
        $stmt = null;
        
        $this->review = TableRegistry::get('Review');

        $revid = $this->review->find()->where(['isdeleted' =>0 ,'title' => $rname])->first();

        $stmt = $conn->execute('select question.id,question.questionname,question.questionnameeng,sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5)) as WeightScore,sum(reviewresultdetail.mark) as Score,sum(5+question.questionweight)as MaxScore from reviewresult inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id inner join employee on employee.id=reviewresult.revieweeid inner join question on question.id=reviewresultdetail.questionid where employee.isdeleted=0 and question.isdeleted=0 and (employee.departmentid=? or 0=?) and reviewresult.finish =1 and (reviewresult.reviewid=? or 0=?) group by reviewresultdetail.questionid', [$deptid,$deptid,$revid->id,$revid->id]);  
        
        $rows = $stmt->fetchAll('assoc');            
        $jsonStr = "{\"result\":[";
        foreach ($rows as $row) {
            // Do work
            $jsonStr .= json_encode($row).",";
        }
        $jsonStr=substr_replace($jsonStr,"", strlen($jsonStr)-1);
        $jsonStr .="]}";
        echo $jsonStr;
        die();
    }

    function getqcompareResult($revid,$empid)
    {
        $conn = ConnectionManager::get('default');
        $stmt = null;
        
        $stmt = $conn->execute('SELECT A.*,B.Others
                                From 
                                (select question.id,question.questionname,question.questionnameeng,
                                (sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5))/count(reviewresultdetail.id)) as Self 
                                from reviewresult
                                inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id 
                                inner join employee on employee.id=reviewresult.revieweeid 
                                inner join question on question.id=reviewresultdetail.questionid 
                                where employee.isdeleted=0 and question.isdeleted=0 
                                and (reviewresult.revieweeid=?) and reviewresult.finish =1 
                                and (reviewresult.reviewid=?) 
                                group by reviewresultdetail.questionid) A
                                INNER JOIN
                                (select question.id,question.questionname,question.questionnameeng,(sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5))/count(reviewresultdetail.id)) as Others
                                from reviewresult
                                inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id 
                                inner join employee on employee.id=reviewresult.revieweeid 
                                inner join question on question.id=reviewresultdetail.questionid 
                                where employee.isdeleted=0 and question.isdeleted=0 
                                and (reviewresult.revieweeid !=?) and reviewresult.finish =1 
                                and (reviewresult.reviewid=?) 
                                group by reviewresultdetail.questionid) B
                                ON A.id=B.id
                                ', [$empid,$revid,$empid,$revid]);  
        
        $rows = $stmt->fetchAll('assoc');            
        $jsonStr = "{\"result\":[";
        foreach ($rows as $row) {
            // Do work
            $jsonStr .= json_encode($row).",";
        }
        $jsonStr=substr_replace($jsonStr,"", strlen($jsonStr)-1);
        $jsonStr .="]}";
        echo $jsonStr;
        die();
    }

    public function getqccompareResult($revid,$empid)
    {
        $conn = ConnectionManager::get('default');
        $stmt = null;
        
        $stmt = $conn->execute('SELECT A.*,B.Others
                                From 
                                (select subcategory.id,subcategory.name,
                                (sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5))/count(reviewresultdetail.id)) as Self 
                                from reviewresult
                                inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id 
                                inner join employee on employee.id=reviewresult.revieweeid 
                                inner join question on question.id=reviewresultdetail.questionid 
                                inner join subcategory on subcategory.id=question.subcategoryid
                                where employee.isdeleted=0 and question.isdeleted=0 
                                and subcategory.isdeleted = 0
                                and (reviewresult.revieweeid=?) and reviewresult.finish =1 
                                and (reviewresult.reviewid=?) 
                                group by question.subcategoryid) A
                                INNER JOIN
                                (select subcategory.id,subcategory.name,(sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5))/count(reviewresultdetail.id)) as Others
                                from reviewresult
                                inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id 
                                inner join employee on employee.id=reviewresult.revieweeid 
                                inner join question on question.id=reviewresultdetail.questionid 
                                inner join subcategory on subcategory.id=question.subcategoryid
                                where employee.isdeleted=0 and question.isdeleted=0 
                                and subcategory.isdeleted = 0
                                and (reviewresult.revieweeid!=?) and reviewresult.finish =1 
                                and (reviewresult.reviewid=?) 
                                group by question.subcategoryid) B
                                ON A.id=B.id', [$empid,$revid,$empid,$revid]);  
        
        $rows = $stmt->fetchAll('assoc');
        //echo "rows ".$rows;
        //die();            
        $jsonStr1 = "{\"result\":[";
        foreach ($rows as $row) {
            // Do work
            $jsonStr1 .= json_encode($row).",";
        }
        $jsonStr1 = substr_replace($jsonStr1,"", strlen($jsonStr1)-1);
        $jsonStr1 .="]}";
        echo $jsonStr1;
        die();
    }

    public function getreviewcompare($revid1,$revid2,$empid)
    {
        $conn = ConnectionManager::get('default');
        $stmt = null;
        
        $stmt = $conn->execute('(select question.id,question.questionname,question.questionnameeng,
                                (sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5))/count(reviewresultdetail.id)) as First ,0 as Second
                                from reviewresult
                                inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id 
                                inner join employee on employee.id=reviewresult.revieweeid 
                                inner join question on question.id=reviewresultdetail.questionid 
                                where employee.isdeleted=0 and question.isdeleted=0 
                                and (reviewresult.revieweeid=?) and reviewresult.finish =1 
                                and (reviewresult.reviewid=?) 
                                group by reviewresultdetail.questionid)
                                UNION ALL
                                (select question.id,question.questionname,question.questionnameeng,0 as First,(sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5))/count(reviewresultdetail.id)) as Second
                                from reviewresult
                                inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id 
                                inner join employee on employee.id=reviewresult.revieweeid 
                                inner join question on question.id=reviewresultdetail.questionid
                                where employee.isdeleted=0 and question.isdeleted=0 
                                and (reviewresult.revieweeid =?) and reviewresult.finish =1 
                                and (reviewresult.reviewid=?) 
                                group by reviewresultdetail.questionid)', [$empid,$revid1,$empid,$revid2]);  
        
        $rows = $stmt->fetchAll('assoc');
        //echo "rows ".$rows;
        //die();            
        $jsonStr1 = "{\"result\":[";
        foreach ($rows as $row) {
            // Do work
            $jsonStr1 .= json_encode($row).",";
        }
        $jsonStr1 = substr_replace($jsonStr1,"", strlen($jsonStr1)-1);
        $jsonStr1 .="]}";
        echo $jsonStr1;
        die();
    }

    public function getItemResult($revid)
    {
        $conn = ConnectionManager::get('default');
        $stmt = null;
        
        $stmt = $conn->execute('select question.id,question.questionname,question.questionnameeng,
                                sum(itemreviewsresultdetail.mark+itemreviewsresultdetail.mark*(question.questionweight/5)) as WeightScore,
                                sum(itemreviewsresultdetail.mark) as Score,
                                sum(5+question.questionweight)as MaxScore 
                                from itemreviewsresults 
                                inner join itemreviewsresultdetail on itemreviewsresults.id=itemreviewsresultdetail.itemreviewsresult_id 
                                inner join question on question.id=itemreviewsresultdetail.question_id 
                                where question.isdeleted=0 and itemreviewsresults.finish =1 
                                and (itemreviewsresults.itemreviews_id=? or 0=?) 
                                group by itemreviewsresultdetail.question_id', [$revid,$revid]);  
        
        $rows = $stmt->fetchAll('assoc');            
        $jsonStr = "{\"result\":[";
        foreach ($rows as $row) {
            // Do work
            $jsonStr .= json_encode($row).",";
        }
        $jsonStr=substr_replace($jsonStr,"", strlen($jsonStr)-1);
        $jsonStr .="]}";
        echo $jsonStr;
        die();
    }

    public function excelExport($reviewid=0,$deptid=0)
    {
        $this->employee = TableRegistry::get('Employee');
        //echo "in controller method".$reviewid."did ".$deptid;

        $this->response->download('exportbyquestion.txt');
        //$data = $this->Employee->find('all')->toArray();        
        $conn = ConnectionManager::get('default');
        $stmt = null;

        $stmt = $conn->execute('select question.id,question.questionname,question.questionnameeng,sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5)) as WeightScore,sum(reviewresultdetail.mark) as Score,sum(5+question.questionweight)as MaxScore from reviewresult inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id inner join employee on employee.id=reviewresult.revieweeid inner join question on question.id=reviewresultdetail.questionid where employee.isdeleted=0 and question.isdeleted=0 and (employee.departmentid=? or 0=?) and reviewresult.finish =1 and (reviewresult.reviewid=? or 0=?) group by reviewresultdetail.questionid', [$deptid,$deptid,$reviewid,$reviewid]);  
        
        $data = $stmt->fetchAll('assoc');
        //echo $data;
        $_serialize = 'data';
        $_header = ['Question','Score With Weight', 'Score With Weight(%)','Score Without Weight'];
        $_extract = ['questionname', 'WeightScore', 'MaxScore','Score'];
        $this->set(compact('data', '_serialize', '_header', '_extract'));
        $this->viewBuilder()->className('CsvView.Csv');
        return;
    }

    public function excelExportByQuestion($reviewid=0,$empid=0)
    {
        $this->response->download('comparisonbyquestion.txt');
        //$data = $this->Employee->find('all')->toArray();        
        $conn = ConnectionManager::get('default');
        $stmt = null;

        $stmt = $conn->execute('SELECT A.*,B.Others
                                From 
                                (select question.id,question.questionname,question.questionnameeng,
                                (sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5))/count(reviewresultdetail.id)) as Self 
                                from reviewresult
                                inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id 
                                inner join employee on employee.id=reviewresult.revieweeid 
                                inner join question on question.id=reviewresultdetail.questionid 
                                where employee.isdeleted=0 and question.isdeleted=0 
                                and (reviewresult.revieweeid=?) and reviewresult.finish =1 
                                and (reviewresult.reviewid=?) 
                                group by reviewresultdetail.questionid) A
                                INNER JOIN
                                (select question.id,question.questionname,question.questionnameeng,(sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5))/count(reviewresultdetail.id)) as Others
                                from reviewresult
                                inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id 
                                inner join employee on employee.id=reviewresult.revieweeid 
                                inner join question on question.id=reviewresultdetail.questionid 
                                where employee.isdeleted=0 and question.isdeleted=0 
                                and (reviewresult.revieweeid !=?) and reviewresult.finish =1 
                                and (reviewresult.reviewid=?) 
                                group by reviewresultdetail.questionid) B
                                ON A.id=B.id', [$empid,$reviewid,$empid,$reviewid]);  
        
        $data = $stmt->fetchAll('assoc');
        //echo $data;
        $_serialize = 'data';
        $_header = ['Question','Others', 'Self'];
        $_extract = ['questionname', 'Others', 'Self'];
        $this->set(compact('data', '_serialize', '_header', '_extract'));
        $this->viewBuilder()->className('CsvView.Csv');
        return;
    }

    //QC mena question category
    public function excelExportByQC($reviewid=0,$empid=0)
    {
        $this->response->download('comparisonbyqc.txt');
        //$data = $this->Employee->find('all')->toArray();        
        $conn = ConnectionManager::get('default');
        $stmt = null;

        $stmt = $conn->execute('SELECT A.*,B.Others
                                From 
                                (select subcategory.id,subcategory.name,
                                (sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5))/count(reviewresultdetail.id)) as Self 
                                from reviewresult
                                inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id 
                                inner join employee on employee.id=reviewresult.revieweeid 
                                inner join question on question.id=reviewresultdetail.questionid 
                                inner join subcategory on subcategory.id=question.subcategoryid
                                where employee.isdeleted=0 and question.isdeleted=0 
                                and subcategory.isdeleted = 0
                                and (reviewresult.revieweeid=?) and reviewresult.finish =1 
                                and (reviewresult.reviewid=?) 
                                group by question.subcategoryid) A
                                INNER JOIN
                                (select subcategory.id,subcategory.name,(sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5))/count(reviewresultdetail.id)) as Others
                                from reviewresult
                                inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id 
                                inner join employee on employee.id=reviewresult.revieweeid 
                                inner join question on question.id=reviewresultdetail.questionid 
                                inner join subcategory on subcategory.id=question.subcategoryid
                                where employee.isdeleted=0 and question.isdeleted=0 
                                and subcategory.isdeleted = 0
                                and (reviewresult.revieweeid!=?) and reviewresult.finish =1 
                                and (reviewresult.reviewid=?) 
                                group by question.subcategoryid) B
                                ON A.id=B.id', [$empid,$reviewid,$empid,$reviewid]);  
        
        $data = $stmt->fetchAll('assoc');
        //echo $data;
        $_serialize = 'data';
        $_header = ['Question Category','Others', 'Self'];
        $_extract = ['name', 'Others', 'Self'];
        $this->set(compact('data', '_serialize', '_header', '_extract'));
        $this->viewBuilder()->className('CsvView.Csv');
        return;
    }

    public function excelExportByComparison($reviewid1=0,$reviewid2=0,$empid=0)
    {
        $this->response->download('comparisonbyemployee.txt');
        //$data = $this->Employee->find('all')->toArray();        
        $conn = ConnectionManager::get('default');
        $stmt = null;

        $stmt = $conn->execute('(select question.id,question.questionname,question.questionnameeng,
                                (sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5))/count(reviewresultdetail.id)) as First ,0 as Second
                                from reviewresult
                                inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id 
                                inner join employee on employee.id=reviewresult.revieweeid 
                                inner join question on question.id=reviewresultdetail.questionid 
                                where employee.isdeleted=0 and question.isdeleted=0 
                                and (reviewresult.revieweeid=?) and reviewresult.finish =1 
                                and (reviewresult.reviewid=?) 
                                group by reviewresultdetail.questionid)
                                UNION ALL
                                (select question.id,question.questionname,question.questionnameeng,0 as First,(sum(reviewresultdetail.mark+reviewresultdetail.mark*(question.questionweight/5))/count(reviewresultdetail.id)) as Second
                                from reviewresult
                                inner join reviewresultdetail on reviewresult.id=reviewresultdetail.reviewresult_id 
                                inner join employee on employee.id=reviewresult.revieweeid 
                                inner join question on question.id=reviewresultdetail.questionid
                                where employee.isdeleted=0 and question.isdeleted=0 
                                and (reviewresult.revieweeid =?) and reviewresult.finish =1 
                                and (reviewresult.reviewid=?) 
                                group by reviewresultdetail.questionid)', [$empid,$reviewid1,$empid,$reviewid2]);  
        
        $data = $stmt->fetchAll('assoc');
        //echo $data;
        $_serialize = 'data';
        $_header = ['Question','First', 'Second'];
        $_extract = ['questionname', 'First', 'Second'];
        $this->set(compact('data', '_serialize', '_header', '_extract'));
        $this->viewBuilder()->className('CsvView.Csv');
        return;
    }

    public function excelItemExport($reviewid=0)
    {
        $this->response->download('export.txt');
        //$data = $this->Employee->find('all')->toArray();        
        $conn = ConnectionManager::get('default');
        $stmt = null;
        $stmt = $conn->execute('select question.id,question.questionname,question.questionnameeng,sum(itemreviewsresultdetail.mark+itemreviewsresultdetail.mark*(question.questionweight/5)) as WeightScore,sum(itemreviewsresultdetail.mark) as Score,sum(5+question.questionweight)as MaxScore from itemreviewsresults inner join itemreviewsresultdetail on itemreviewsresults.id=itemreviewsresultdetail.itemreviewsresult_id inner join question on question.id=itemreviewsresultdetail.question_id where question.isdeleted=0 and itemreviewsresults.finish =1 and (itemreviewsresults.itemreviews_id=? or 0=?) group by itemreviewsresultdetail.question_id', [$reviewid,$reviewid]);  
        
        $data = $stmt->fetchAll('assoc');
        //echo $data;
        $_serialize = 'data';
        $_header = ['Question','Score With Weight', 'Score With Weight(%)','Score Without Weight'];
        $_extract = ['questionname', 'WeightScore', 'MaxScore','Score'];
        $this->set(compact('data', '_serialize', '_header', '_extract'));
        $this->viewBuilder()->className('CsvView.Csv');
        return;
    }
}
