<?php
use Cake\Routing\Router;
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>
<style>
    a.button {
    color: #6e6e6e;
    font: bold 12px Helvetica, Arial, sans-serif;
    text-decoration: none;
    padding: 7px 7px;
    position: relative;
    display: inline-block;
    text-shadow: 0 1px 0 #fff;
    -webkit-transition: border-color .218s;
    -moz-transition: border .218s;
    -o-transition: border-color .218s;
    transition: border-color .218s;
    background: #f3f3f3;
    background: -webkit-gradient(linear,0% 40%,0% 70%,from(#F5F5F5),to(#F1F1F1));
    background: -moz-linear-gradient(linear,0% 40%,0% 70%,from(#F5F5F5),to(#F1F1F1));
    border: solid 1px #dcdcdc;
    
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    margin-right: 20px;
    cursor:pointer;
}
a.button:hover{
    color: #333;
    border-color: #999;
    -moz-box-shadow: 0 2px 0 rgba(0, 0, 0, 0.2); 
    -webkit-box-shadow:0 2px 5px rgba(0, 0, 0, 0.2);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
}
a.button:active {
    color: #000;
    border-color: #444;
}
</style>


    <div id="page-wrapper1" style="margin: 0 0 0 290px;">
        <div class="row">
            <div class="col-sm-10">
                <h4 class="page-header">Employee</h4>
            </div>
            <div class="col-sm-2">
                
            </div>
            
        </div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-sm-10">
            </div>
            <div class="col-sm-2" style="padding-top: 0px;">
                <a href="employee/add" class="btn btn-primary btn-circle btn-lg" style="color: white;width: 80px;padding-top: 0.7em;margin-top: -2em">                
                    <i class="fa fa-user-plus">
                    </i> New
                </a>
            </div>            
            
        </div>
        
        <div class="row">
            <div class="col-md-7">
            </div>
            <div class="col-md-5">
                <?= $this->Form->create('Employee',['type' => 'file','url' => ['controller'=>'Employee','action' => 'import'],'class'=>'form-inline','role'=>'form',]) ?>
                <div class="form-group">
                    <label class="sr-only" for="csv"> CSV </label>
                    <?php echo $this->Form->input('csv', ['type'=>'file','class' => 'form-control', 'label' => false, 'placeholder' => 'csv upload',]); ?>
                </div>
                <button type="submit" class="btn btn-default" onclick="alert"> Upload </button>
                <?= $this->Form->end() ?>
            </div>
        </div>
        <div class="gab" style="height:20px;align:right;"></div>
        <div class="row">
            <div class="col-md-7">
            </div>
            <div class="col-md-4">                              

                    <!-- echo $this->Html->link("Download Info", array('controller' => 'Employee','action'=> 'export'), array( 'class' => 'button')); -->
                
                <?php 
                    $message = $this->Flash->render();
                    if($message!= null){
                        echo "<div class='alert alert-success'>".$message."</div>";
                    }
                 ?>
            </div>
        </div>
        <div class="gab" style="height:30px;align:right;"></div>
 
        <!-- Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary" style="width:1050px;">
                    <div class="panel-heading">
                        Employee Table
                    </div>
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Family Name</th>
                                    <th>Rank</th>
                                    <th>Department</th>
                                    <th>Job Position</th>                            
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    
                                    $currentpage = $this->Paginator->current($model = null)-1;
                                    $count = (10*$currentpage)+1;
                                    if($employee != null)
                                    {
                                    foreach ($employee as $employee): 
                                ?>
                                <tr class="odd gradeX">
                                    <td><?= $count++ ?></td>
                                    <td><?= h($employee->name) ?></td>
                                    <td><?= h($employee->fimalyname) ?></td>
                                    <td><?= h($employee->rank->rank) ?></td>
                                    <td><?= h($employee->department->departmentname) ?></td>
                                    <td><?= h($employee->jobposition->jobtitle) ?></td>
            
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $employee->id]) ?>
                                        &nbsp;&nbsp;&nbsp;
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $employee->id]) ?>
                                        &nbsp;&nbsp;&nbsp;
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete employee: {0}?', $employee->name),'style'=>'color:red']) ?>
                                    </td>
                                </tr>
                                <?php endforeach; 
                            }
                                ?>                                
                            </tbody>
                            
                        </table>
                        
                        <div class="paginator">
                            <ul class="pagination">
                                <?= $this->Paginator->first('<< ' . __('first')) ?>
                                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                <?= $this->Paginator->numbers() ?>
                                <?= $this->Paginator->next(__('next') . ' >') ?>
                                <?= $this->Paginator->last(__('last') . ' >>') ?>
                            </ul>
                            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            <!-- /.panel -->
            </div>
        </div>
    </div>

    
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });

        var filter = document.getElementById('dataTables-example_paginate');
        filter.style = "visibility:hidden";
    });
    </script>