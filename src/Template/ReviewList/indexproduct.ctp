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
                    <h4>Pending Item Review</h4>
                    <div class="table-responsive">
                        <?php 
                        if($products != null || $projects != null || $services!= null)
                        {
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr bgcolor="#A9E2F3">
                                    <th><b>No</b></th>
                                    <th><b>Item Name</b></th>
                                    <th><b>Description</b></th>
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
                                if($products != null)
                                {
                                foreach ($products as $s): 
                            ?>                             
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= $s->employee->productname ?></td>
                                    <td><?= $s->employee->description ?></td>
                                  <!--   <td><?= $s//->employee//->status?></td> -->
                                    <td class="actions">                                        
                                         <?= $this->Html->link('Evaluate', array(
                                            'controller' => 'reviewpage',
                                            'action' => 'indexproduct',
                                            $s->employee->id,$rid,$reviewerid
                                        ));?>
                                    </td>
                                </tr>
                            <?php endforeach;

                                }  

                                $number1 = 1; 
                                if($projects != null)
                                {
                                foreach ($projects as $s): 
                            ?>                             
                                <tr>
                                    <td><?= $number1++ ?></td>
                                    <td><?= $s->employee->projectname ?></td>
                                    <td><?= $s->employee->description ?></td>
                                  <!--   <td><?= $s//->employee//->status?></td> -->
                                    <td class="actions">                                        
                                         <?= $this->Html->link('Evaluate', array(
                                            'controller' => 'reviewpage',
                                            'action' => 'indexproduct',
                                            $s->employee->id,$rid,$reviewerid
                                        ));?>
                                    </td>
                                </tr>
                            <?php endforeach;

                                }                                      
                                 
                                $number2 = 1; 
                                if($services != null)
                                {
                                foreach ($services as $s): 
                            ?>                             
                                <tr>
                                    <td><?= $number2++ ?></td>
                                    <td><?= $s->employee->servicename ?></td>
                                    <td><?= $s->employee->description ?></td>
                                  <!--   <td><?= $s//->employee//->status?></td> -->
                                    <td class="actions">                                        
                                         <?= $this->Html->link('Evaluate', array(
                                            'controller' => 'reviewpage',
                                            'action' => 'indexproduct',
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
