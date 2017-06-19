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
            <h4 class="page-header">Review Performance Apprisal</h4>
        </div>
    </div>
             
    <div class="panel-group" id="accordion">
        <div class="panel panel-info">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <h4>Pending Employee Review</h4>
                    <div class="table-responsive">
                        <?php 
                        if($finalempinfomg != null)
                        {
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr bgcolor="#A9E2F3">
                                    <th><b>No</b></th>
                                    <th><b>Employee Name</b></th>
                                    <th><b>Department Name</b></th>
                                    <th><b>Job Position</b></th>
                                    
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
                                if($finalempinfomg != null)
                                {
                                foreach ($finalempinfomg as $s): 
                            ?>                             
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= $s->employee->name ?></td>
                                    <td><?= $s->employee->department->departmentname ?></td>
                                    <td><?= $s->employee->jobposition->jobtitle?></td>
                                    
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

    <div class="panel-group" id="accordion">
        <div class="panel panel-info">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <h4>Pending Manager Review</h4>
                    <div class="table-responsive">
                        <?php 
                        if($finalempinfomgpa != null)
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
                             
                                $number = 1; 
                                if($finalempinfomgpa != null)
                                {
                                foreach ($finalempinfomgpa as $s): 
                            ?>                             
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= $s->employee->name ?></td>
                                    <td><?= $s->employee->department->departmentname ?></td>
                                    <td><?= $s->employee->jobposition->jobtitle?></td>
                                    <td class="actions">
                                       
                                        <?= $this->Html->link('Evaluate', array(
                                            'controller' => 'reviewpage',
                                            'action' => 'indexforpa',
                                            $s->employee->id,$revidmg,$revtitle,$reviewermg
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
    
    <div class="panel-group" id="accordion">
        <div class="panel panel-info">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <h4>Pending Review Meeting</h4>
                    <div class="table-responsive">
                        <?php 
                        if($finalempinfofs != null)
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
                             
                                $number = 1; 
                                if($finalempinfofs != null)
                                {
                                foreach ($finalempinfofs as $s): 
                            ?>                             
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= $s->employee->name ?></td>
                                    <td><?= $s->employee->department->departmentname ?></td>
                                    <td><?= $s->employee->jobposition->jobtitle?></td>
                                    <td class="actions">
                                       <?= $this->Html->link('Evaluate', array(
                                            'controller' => 'reviewpage',
                                            'action' => 'indexforpafinish',
                                            $s->employee->id,$revidmg,$revtitle,$reviewermg
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

    <div class="panel-group" id="accordion">
        <div class="panel panel-info">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <h4>Review Completed</h4>
                    <div class="table-responsive">
                        <?php 
                        if($finalempinfomgpafn != null)
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
                             
                                $number = 1; 
                                if($finalempinfomgpafn != null)
                                {
                                foreach ($finalempinfomgpafn as $s): 
                            ?>                             
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= $s->employee->name ?></td>
                                    <td><?= $s->employee->department->departmentname ?></td>
                                    <td><?= $s->employee->jobposition->jobtitle?></td>
                                    <td class="actions">
                                       Finished
                                       
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
