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
            <h4 class="page-header">Review To Do List</h4>            
        </div>
    </div>

    <div class="panel-group" id="accordion">
        <div class="panel panel-info">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <h4>Pending Employee Review</h4>
                    <div class="table-responsive">
                        <?php 
                        if($employees != null || $buemployees!=null)
                        {
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr bgcolor="#A9E2F3">
                                    <th><b>No</b></th>
                                    <th><b>Employee Name</b></th>
                                    <th><b>Department Name</b></th>
                                    <th><b>Job Position</b></th>
                                    <th><b>Actions</b></th>
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
                             $session = $this->request->session();
                             $reviewerid = $session->read('userid');

                                $number = 1; 
                                if($employees != null)
                                {
                                    //echo "count ".sizeof($employees);
                                foreach ($employees as $s): 
                                ?>                             
                                    <tr>
                                        <td><?= $number++ ?></td>
                                        <td><?= $s->employee->name ?></td>
                                        <td><?= $s->employee->department->departmentname ?></td>
                                        <td><?= $s->employee->jobposition->jobtitle?></td>
                                        <td class="actions">
                                            <?php 
                                                if($s->revtype == 3)
                                                {
                                                if($s->reviewcount < $maxreviewee)
                                                {
                                            ?>
                                            <?= $this->Html->link('Evaluate', array(
    										    'controller' => 'reviewpage',
    										    'action' => 'index',
                                                $s->employee->id,$rid,$cid,$maxreviewee,$reviewerid,0,0
    										));?>

                                                <?php 
                                                }
                                                else
                                                    echo "<a href='#' style=' pointer-events: none;cursor: default;color:#999'>Evaluate</a>";
                                            }
                                            else
                                            {?>
                                                 <?= $this->Html->link('Evaluate', array(
                                                    'controller' => 'reviewpage',
                                                    'action' => 'index',
                                                    $s->employee->id,$rid,$cid,0,$reviewerid,0,0
                                                ));?>
                                            <?php }
                                            
                                                ?>

                                        </td>
                                    </tr>
                                    <?php endforeach; 
                                }                                
                              
                                for ($bcount=1; $bcount <= sizeof($buemployees) ; $bcount++)
                                { 
                                
                                    $name = 'bu'.$bcount;
                                    //echo "Name".$name;
                                    if($buemployees[$name] != null)
                                    {
                                        $bu = $buemployees[$name]->employee;
                                    
                                        echo "<tr>";
                                        echo "<td>".$bcount."</td>";
                                        echo "<td>".$bu->name."</td>";
                                        echo "<td>".$bu->department->departmentname."</td>";
                                        echo "<td>".$bu->jobposition->jobtitle."</td>";
                                        echo "<td class=\"actions\">";
                                        echo $this->Html->link('Evaluate', array(
                                                'controller' => 'reviewpage',
                                                'action' => 'index',
                                                $bu->id,$rid,$cid,0,$reviewerid,0,0
                                            ));
                                        echo "</td>";
                                        echo "</tr>";
                                               
                                }          
                            }                  
                                ?>
                            </tbody>
                        </table>                    
                    </div>                    
                </div>
            </div>
        </div>
    </div>

        <?php 

        if($selfreviewee != null && $selfarray != null)
        {
           /* ?>

        
            <?php
            if($selfarray != null)
        {*/


        ?>
        

    <div class="panel-group" id="accordion">
        <div class = "panel panel-info">
            <div id="groupB" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <h4>Self Performance</h4>
                    <div class="table-responsive">
                         <table class="table table-hover">
                            <thead>
                                <tr bgcolor="#A9E2F3">
                                    <th><b>No</b></th>
                                    <th><b>Employee Name</b></th>
                                    <th><b>Department Name</b></th>
                                    <th><b>Job Position</b></th>
                                    <th><b>Actions</b></th>
                                <tr>
                            </thead>
                            <tbody>   
                            <?php
                            //}
                            /*else
                            {
                            ?>
                                
                            <?php
                            }*/
                                $number = 1; 
                                if($selfarray != null)
                                {
                                foreach ($selfarray as $self): 
                            ?>                             
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= $self->name ?></td>
                                    <td><?= $self->department->departmentname ?></td>
                                    <td><?= $self->jobposition->jobtitle ?></td>
                                    <td class="actions">
                                      
                                        <?= $this->Html->link('Evaluate', array(
                                            'controller' => 'reviewpage',
                                            'action' => 'index',
                                            $self->id,$rid,$cid,$maxreviewee,$reviewerid,0,0
                                        ));?>

                                    </td>
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
        <?php } ?>

    <div class="panel-group" id="accordion">
        <div class="panel panel-info">  
            <div id="groupC" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <h4>Review Completed</h4>
                    <div class="table-responsive">
                        <?php 

                        if($employeesfn != null)
                        {
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr bgcolor="#A9E2F3">
                                    <th><b>No</b></th>
                                    <th><b>Employee Name</b></th>
                                    <th><b>Department Name</b></th>
                                    <th><b>Job Position</b></th>
                                    <th><b>Actions</b></th>
                                <tr>
                            </thead>
                            <tbody>   
                            <?php
                            }
                            else{
                            ?>
                                
                            <?php
                            }
                             $session = $this->request->session();
                             $reviewerid = $session->read('userid');

                                $number = 1; 
                                if($employeesfn != null)
                                {
                                foreach ($employeesfn as $s): 
                            ?>                             
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= $s->employee->name ?></td>
                                    <td><?= $s->employee->department->departmentname ?></td>
                                    <td><?= $s->employee->jobposition->jobtitle?></td>
                                    <td class="actions">
                                        Finish
                                    </td>
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
