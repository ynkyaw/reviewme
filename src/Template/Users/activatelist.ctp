<?php
use Cake\Routing\Router;
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="page-header">User Activations</h4>
        </div>
    </div>
    
    <div class="panel-group" id="accordion" style="width:1000px;">
        <div class="panel panel-info">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr bgcolor="#337ab7">
                                    <th style="color:white;"><b>No</b></th>
                                    <th style="color:white;"><b>Employee</b></th>
                                    <th style="color:white;"><b>Email</b></th>
                                    <th style="color:white;"><b>Registered Date</b></th>
                                    <th style="color:white;"><b>Actions</b></th>
                                <tr>
                            </thead>
                            <tbody>      
                             <?php 
                                    $number=1;
                                    foreach ($userList as $userList): 
                                    ?>                          
                                <tr>                                   
                                    <td><?=$number++?>.</td>
                                    <td><?= $userList->username ?></td>
                                    <td><?= $userList->email ?></td>
                                    <td><?= $userList->registered ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link('Activate', array(
                                            'controller' => 'users',
                                            'action' => 'activate',
                                            $userList->id
                                        ));?>                                        
                                    </td>                                
                                </tr>
                                <?php endforeach;?>                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>

