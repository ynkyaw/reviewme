<?php
use Cake\Routing\Router;
use  Cake\Cache\Cache;
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="page-header"> Review Status </h4>
        </div>
    </div>
             
    <div class="panel-group" id="accordion">
        <div class="panel panel-info">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <h4>Pending Product Review</h4>
                    <div class="table-responsive">
                        <?php 
                        if($reviews != null)
                        {
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr bgcolor="#A9E2F3">
                                    <th><b>No</b></th>
                                    <th><b>Review</b></th>
                                    <th><b>Employee</b></th>
                                    <th><b>Status</b></th>
                                <tr>
                            </thead>
                            <tbody>   
                            <?php
                            }
                            else{
                            ?>
                                 Thank you!
                            <?php
                            }
                                $number = 1; 
                                if($reviews != null)
                                {
                                foreach ($reviews as $s): 
                            ?>                             
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= $s->review->title ?></td>
                                    <td><?= $s->employee->name ?></td>
                                    <td><?=$s->finish."/".$s->total ?></td>
                                </tr>
                                <?php endforeach; 
                            }
                                ?>
                            </tbody>
                        </table>                    
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="panel panel-info">  
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <h4>Review Completed</h4>
                    <div class="table-responsive">
                        <?php 

                        if($reviewfn != null)
                        {
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr bgcolor="#A9E2F3">
                                    <th><b>No</b></th>
                                    <th><b>Review</b></th>
                                    <th><b>Employee</b></th>
                                    <th><b>Status</b></th>
                                <tr>
                            </thead>
                            <tbody>   
                            <?php
                            }
                            else{
                            ?>
                                
                            <?php
                            }
                                $number = 1; 
                                if($reviewfn != null)
                                {
                                foreach ($reviewfn as $s): 
                            ?>                             
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= $s->review->title ?></td>
                                    <td><?= $s->employee->name ?></td>
                                    <td>Finish</td>
                                </tr>
                                <?php endforeach; 
                            }
                                ?>
                            </tbody>
                        </table>                    
                    </div>                    
                </div>
            </div>
        </div>
   
    </div> 
</div>
