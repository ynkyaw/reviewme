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
            <h4 class="page-header">Report List</h4>
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
                                    <th style="color:white;"><b>Report Name</b></th>
                                    <th style="color:white;"><b>Actions</b></th>
                                <tr>
                            </thead>
                            <tbody>                                
                                <tr>
                                    <td>1</td>
                                    <td>Report By Question</td>
                                    <td class="actions">
                                        <?= $this->Html->link('View', array(
                                            'controller' => 'report',
                                            'action' => 'byquestion'
                                        ));?>                                        
                                    </td>
                                </tr> 
                                <tr>
                                    <td>2</td>
                                    <td>Comparison by Others and Self on Each Question</td>
                                    <td class="actions">
                                        <?= $this->Html->link('View', array(
                                            'controller' => 'report',
                                            'action' => 'comparisonbyquestion'
                                        ));?>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Comparison by Others and Self on Each Question Category</td>
                                    <td class="actions">
                                        <?= $this->Html->link('View', array(
                                            'controller' => 'report',
                                            'action' => 'comparisonbyquestioncategory'
                                        ));?>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Performance Comparison Of Employee</td>
                                    <td class="actions">
                                        <?= $this->Html->link('View', array(
                                            'controller' => 'report',
                                            'action' => 'comparisonemployee'
                                        ));?>                                        
                                    </td>
                                </tr>                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>       

