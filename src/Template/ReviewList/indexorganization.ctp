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
                    <h4>Pending Organization Review</h4>
                    <div class="table-responsive">
                        <?php 
                        if($departments != null || $companys != null || $organizations != null)
                        {
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr bgcolor="#A9E2F3">
                                    <th><b>No</b></th>
                                    <th><b>Department Name</b></th>
                                    <th><b>Industry</b></th>
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
                                if($departments != null)
                                {
                                foreach ($departments as $s): 
                            ?>                             
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= $s->employee->departmentname ?></td>
                                    <td class="actions">                                        
                                         <?= $this->Html->link('Evaluate', array(
                                            'controller' => 'reviewpage',
                                            'action' => 'indexorganization',
                                            $s->employee->id,$rid,$reviewerid
                                        ));?>
                                    </td>
                                </tr>
                            <?php endforeach;

                                }  

                                $number1 = 1; 
                                if($companys != null)
                                {
                                foreach ($companys as $s): 
                            ?>                             
                                <tr>
                                    <td><?= $number1++ ?></td>
                                    <td><?= $s->employee->name ?></td>
                                    <td><?= $s->employee->industry ?></td>
                                    <td class="actions">                                        
                                         <?= $this->Html->link('Evaluate', array(
                                            'controller' => 'reviewpage',
                                            'action' => 'indexorganization',
                                            $s->employee->id,$rid,$reviewerid
                                        ));?>
                                    </td>
                                </tr>
                            <?php endforeach;

                                }                                      
                                 
                                $number2 = 1; 
                                if($organizations != null)
                                {
                                foreach ($organizations as $s): 
                            ?>                             
                                <tr>
                                    <td><?= $number2++ ?></td>
                                    <td><?= $s->employee->name ?></td>
                                    <td><?= $s->employee->industry ?></td>
                                    <td class="actions">                                        
                                         <?= $this->Html->link('Evaluate', array(
                                            'controller' => 'reviewpage',
                                            'action' => 'indexorganization',
                                            $s->employee->id,$rid,$reviewerid
                                        ));?>
                                    </td>
                                </tr>
                            <?php endforeach;

                                }?> 

                            </tbody>
                        </table>                    
                    </div>                    
                </div>
            </div>
        </div>
          
    </div> 
</div>
