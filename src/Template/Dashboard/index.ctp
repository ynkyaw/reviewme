<?php
use Cake\Routing\Router;
use Cake\Mailer\Email;
/**
  * @var \App\View\AppView $this
  */
  $this->layout = 'superadmin';
  ?> 

    <!-- Dashboard -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Dashboard</h2>
            </div>
        </div>

    <?php
    //if($layout != 'member')
    //{
        $isowner = false;
        if($ow_reviews != null)
        {
            foreach ($ow_reviews as $review):                         
            if($review->review->owner_id == $uid)// && $review->finish != $review->total
            { 
                $isowner = true;
            }
            endforeach;
        }
            if($isowner)
            {
        ?>
        <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-10">
                            <span class="fa fa-tasks fa-1x"/>
                             Review (Ongoing)
                        </div>
                        <div class="col-sm-2" style="text-align: center;">
                            Progress
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <?php 
                    $cc = 1;
                        if($ow_reviews != null)
                        {
                        foreach ($ow_reviews as $review):                         
                            if($review->review->owner_id == $uid)// && $review->finish != $review->total
                            {                           

                    ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <!--  Sales Appraisal (Mid Term) -->
                            <?php 
                            $session = $this->request->session();
                            $categoryid = $session->read('cid'.$cc);

                            if($review->review->reviewtype_id == 1)
                            {                     
                                //echo "1";               
                                echo $this->Html->link($review->review->title,array('controller'=>'reviewlist','action'=>'indexowner',$review->review->id,$categoryid)); 
                                 $cc++;
                            }
                            if($review->review->reviewtype_id == 4)
                            {
                                //echo "4";
                                echo $this->Html->link($review->review->title,array('controller'=>'reviewlist','action'=>'indexpaowner',$review->review->id)); 
                            }
                            if($review->review->reviewtype_id == 5)
                            {
                                //echo "5";
                                echo $this->Html->link($review->review->title,array('controller'=>'reviewlist','action'=>'indexproductowner',$review->review->id,0));
                            }
                            if($review->review->reviewtype_id == 6)
                            {
                                echo $this->Html->link($review->review->title,array('controller'=>'reviewlist','action'=>'indexproductowner',$review->review->id,0));
                            }
                            if($review->review->reviewtype_id == 7)
                            {
                                echo $this->Html->link($review->review->title,array('controller'=>'reviewlist','action'=>'indexproductowner',$review->review->id,0));
                            }
                            if($review->review->reviewtype_id == 8)
                            {
                                //echo "5";
                                echo $this->Html->link($review->review->title,array('controller'=>'reviewlist','action'=>'indexorganizationowner',$review->review->id,0));
                            }
                            if($review->review->reviewtype_id == 9)
                            {
                                echo $this->Html->link($review->review->title,array('controller'=>'reviewlist','action'=>'indexorganizationowner',$review->review->id,0));
                            }
                            if($review->review->reviewtype_id == 10)
                            {
                                echo $this->Html->link($review->review->title,array('controller'=>'reviewlist','action'=>'indexorganizationowner',$review->review->id,0));
                            }
                            elseif($review->review->reviewtype_id == 2 || $review->review->reviewtype_id == 3)
                            { 
                                //echo "2 3";
                                echo $this->Html->link($review->review->title,array('controller'=>'reviewlist','action'=>'indexowner',$review->review->id,0));   
                            }
                            ?>
                        </div>
                        <?php $percentage = ($review->finish/$review->total)*100; ?>
                        <div class="col-sm-4" style="text-align: center;"> <progress max="100" value=<?= $percentage ?> ></progress> </div>
                        <div class="col-sm-2" style="text-align: center;"> <?= $this->Number->precision($percentage, 2) ?> % </div>
                    </div>
                    <?php 
                        }
                        endforeach;
                    }

                    //}
                    ?>                    
                </div>
            </div>
        </div>
         <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">                   
                    <div class="row">
                        <div class="col-sm-10">
                            <span class="fa fa-tasks fa-1x"/>
                             Reviews (Finished)
                        </div>
                        <div class="col-sm-2" style="text-align: center;">
                            Result
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                     <?php 
                     if($ow_finishAry != null)
                     {
                     //foreach ($reviews as $review):$review->review->owner_id == $uid &&  
                        foreach ($ow_finishAry as $fnreview):
                            
                        if($fnreview->review->owner_id == $uid)
                        {

                    ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <!--  Sales Appraisal (Mid Term)-->
                            <?php
                                echo $fnreview->review->title;
                            ?>

                        </div>
                        <?php $getmarks = $fnreview->totalmarks;
                              $tmarks = $fnreview->totalqcount * 5;
                              if($tmarks == 0)
                              {
                                    $percentage1 = ($getmarks)*100;
                              }
                              else
                              {
                                    $percentage1 = ($getmarks/$tmarks)*100;
                              }
                             
                        ?>
                        <div class="col-sm-4" style="text-align: center;"> <progress max="100" value=<?= $percentage1 ?> ></progress> </div>
                        <div class="col-sm-2" style="text-align: center;"> <?= $this->Number->precision($percentage1, 2) ?> % </div>
                    </div>
                    <?php 
                        }
                        endforeach;
                        //endforeach; 
                        }
                    //} 
                    ?>                    
                </div>
            </div>
        </div>
    </div>
    
    <?php
    }
//}
    ?>
    <div class="row">
        <div class="col-xs-12">
            <h3>Pending Activities</h3>(Click on item to Review)
        </div>
    </div>

    <?php
    if($reviews != null)
    {
        $rowcount = count($reviews)/3;
        $cc = 1;
        for ($i=0; $i <$rowcount ; $i++) 
        { 
            echo "<div class='row'>";
            for ($j=0; $j < 3 ; $j++) 
            { 
                $index =($i*3)+$j;
                if($index<count($reviews))
                {
                    $maxreviewCnt = 0;

                    if($reviews[$index]->review->reviewtype_id == 3)
                        $maxreviewCnt = $reviews[$index]->review->maxreview;
                    else
                        $maxreviewCnt = $reviews[$index]->total;
                    //echo "R".json_encode($reviews[$index]->review);
                   // echo "finish ".$reviews[$index]->finish."/total".$reviews[$index]->total;
                    if($reviews[$index]->finish<$maxreviewCnt)
                    {
                        $session = $this->request->session();
                        $categoryid = $session->read('cid'.$cc);
                        $categoryname = $session->read('cname'.$cc);

                        echo "<div class='col-md-3' style='margin-right:20px;padding:10px 10px 10px 10px;'>";
                        echo "<a ";
                        
                        if($reviews[$index]->finish < $maxreviewCnt)
                        {
                            if($reviews[$index]->review->reviewtype_id == 1)
                            {
                                echo "href='".Router::url('/', true)."reviewlist/index/".$reviews[$index]->review->id."/".$categoryid."' ";
                                $cc++;
                            }
                            if($reviews[$index]->review->reviewtype_id == 4)
                            {
                                echo "href='".Router::url('/', true)."reviewlist/indexpa/".$reviews[$index]->review->id."/".$reviews[$index]->review->title."/".$uid."/0' ";
                            }
                            if($reviews[$index]->review->reviewtype_id == 5)
                            {
                                echo "href='".Router::url('/', true)."reviewlist/indexproduct/".$reviews[$index]->review->id."' ";
                            }
                            if($reviews[$index]->review->reviewtype_id == 6 )
                            {
                                echo "href='".Router::url('/', true)."reviewlist/indexproduct/".$reviews[$index]->review->id."' ";
                            }
                            if($reviews[$index]->review->reviewtype_id == 7 )
                            {
                                echo "href='".Router::url('/', true)."reviewlist/indexproduct/".$reviews[$index]->review->id."' ";
                            }
                            if($reviews[$index]->review->reviewtype_id == 8)
                            {
                                echo "href='".Router::url('/', true)."reviewlist/indexorganization/".$reviews[$index]->review->id."' ";
                            }
                            if($reviews[$index]->review->reviewtype_id == 9)
                            {
                                echo "href='".Router::url('/', true)."reviewlist/indexorganization/".$reviews[$index]->review->id."' ";
                            }
                            if($reviews[$index]->review->reviewtype_id == 10)
                            {
                                echo "href='".Router::url('/', true)."reviewlist/indexorganization/".$reviews[$index]->review->id."' ";
                            }
                            else
                            {
                                echo "href='".Router::url('/', true)."reviewlist/index/".$reviews[$index]->review->id."/0' ";
                            }
                        }
                        else
                            echo "href='#' ";
                        echo ">";
                        echo "<div class='panel' >
                                <div class='panel-heading' style='padding:2px 2px;background-color:";
                        if($reviews[$index]->review->reviewtype_id == 1)
                        {
                            echo "#C0E6C2";
                        }
                        else if($reviews[$index]->review->reviewtype_id == 2)
                        {
                            echo "#E0E9BD";
                        }
                        else if($reviews[$index]->review->reviewtype_id == 3)
                        {
                            echo "#FEDBB8";
                        }
                        else if($reviews[$index]->review->reviewtype_id == 5)
                        {
                            echo "gray";
                        }
                        else
                        {
                            echo "#337ab7";
                        }
                        echo "'>
                                </div>
                                <div class='panel-body' style='padding:10px;border:1px solid lightgray;'>
                                    <div class='row'>
                                        <div class='col-xs-3'>
                                           <label>Title</label>
                                        </div>
                                        <div class='col-xs-9'>
                                            ".$reviews[$index]->review->title."
                                        </div>
                                    </div>
                                    
                                    <div class='row'>
                                        <div class='col-xs-3'>
                                            <label>Progress</label>
                                        </div>
                                        <div class='col-xs-3'>
                                            ".$reviews[$index]->finish."/".$maxreviewCnt."
                                        </div>
                                        <div class='col-xs-6' style='text-align:right'>
                                            <i class='fa fa-arrow-right' aria-hidden='true'></i>
                                        </div>
                                    </div>                                    
                                </div>
                                </div>
                        ";
                        
                        echo "</a>";
                        
                        echo "</div>";
                        //echo "".json_encode($reviews[$index]->review);
                     }
                }
                else
                {
                    echo "<div class='col-md-3'></div>";
                }
            }
            echo "</div>";   
                
            }
        }
    
    
    if($reviewspa != null)
    {
        $rowcount1 = count($reviewspa)/3;
        $cc = 1;
        for ($i=0; $i <$rowcount1 ; $i++) 
        { 
            echo "<div class='row'>";
            for ($j=0; $j < 3 ; $j++) 
            { 
                $index1 =($i*3)+$j;
                if($index1<count($reviewspa))
                {
                    $maxreviewpa = 0;
                    $maxreviewpa = $reviewspa[$index1]->total;

                    $session = $this->request->session();
                    $revowner = $session->read('reviewowner');

                    if($reviewspa[$index1]->finish<$maxreviewpa)
                    {
                        echo "<div class='col-md-3' style='margin-right:30px;padding:10px 10px 10px 10px;'>";
                        echo "<a ";
                        if($reviewspa[$index1]->finish<$maxreviewpa)
                        {
                            echo "href='".Router::url('/', true)."reviewpage/index/".$uid."/".$reviewspa[$index1]->review->id."/0/0/".$uid."/4/".$revowner."'";                        
                        }
                        else
                            echo "href='#' ";


                        echo ">";
                        echo "<div class='panel' >
                                <div class='panel-heading' style='padding:2px 2px;background-color:cyan";
                       
                        echo "'>
                                </div>
                                <div class='panel-body' style='padding:10px;border:1px solid lightgray;'>
                                    <div class='row'>
                                        <div class='col-xs-3'>
                                           <label>Title</label>
                                        </div>
                                        <div class='col-xs-9'>
                                            ".$reviewspa[$index1]->review->title."
                                        </div>
                                    </div>
                                    
                                    <div class='row'>
                                        <div class='col-xs-3'>
                                            <label>Progress</label>
                                        </div>
                                        <div class='col-xs-3'>
                                            ".$reviewspa[$index1]->finish."/".$maxreviewpa."
                                        </div>
                                        <div class='col-xs-6' style='text-align:right'>
                                            <i class='fa fa-arrow-right' aria-hidden='true'></i>
                                        </div>
                                    </div>
                                    
                                </div>



                                </div>
                        ";
                        echo "</a>";
                        
                        echo "</div>";
                        //echo "".json_encode($reviews[$index]->review);
                     }
                }
                else
                {
                    echo "<div class='col-md-3'></div>";
                }
            }
            echo "</div>";   
                
        }
    }
//}
?>
</div>
