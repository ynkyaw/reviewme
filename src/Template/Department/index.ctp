<?php
use Cake\Routing\Router;
/**
  * @var \App\View\AppView $this
  */
$this->layout= 'superadmin';
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="page-header">Department</h4>
        </div>
        <div class="col-sm-2">
            
        </div>
        
    </div>
    <div class="row" style="margin-bottom: 10px;width:1050px;">
        <div class="col-sm-10">
        </div>
        <div class="col-sm-2" style="padding-top: 0px;">
            <a href="department/add" class="btn btn-primary btn-circle btn-lg" style="color: white;width: 80px;padding-top: 0.7em;margin-top: -1em">                
                <i class="fa fa-institution">
                </i> New
            </a>
        </div>            
        
    </div>
    <div class="row" style="width:1000px;">
        <div class="col-md-7">
        </div>
        <div class="col-md-5">
            <?= $this->Form->create('Department',['type' => 'file','url' => ['controller'=>'Department','action' => 'import'],'class'=>'form-inline','role'=>'form',]) ?>
            <div class="form-group">
                <label class="sr-only" for="csv"> CSV </label>
                <?php echo $this->Form->input('csv', ['type'=>'file','class' => 'form-control', 'label' => false, 'placeholder' => 'csv upload',]); ?>
            </div>
            <button type="submit" class="btn btn-default"> Upload </button>
            <?= $this->Form->end() ?>
        </div>
    </div>
   
    <div class="gab" style="height:30px;align:right;"></div>
    <div class="row">
        <div class="col-md-7">
        </div>
        <div class="col-md-4"> 
            <?php 
                $message = $this->Flash->render();
                if($message!= null && $message!=""){
                    echo "<div class='alert alert-success' style='width:270px;'>".$message."</div>";
                } 
            ?> 
        </div>
    </div>  
    <div class="panel-group" id="accordion">
        <div class="panel panel-info" style="width:950px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr bgcolor="#337ab7">
                                    <th style="color:white"><b>No</b></th>
                                    <th style="color:white"><b>Department Name</b></th>
                                    <th style="color:white"><b>Actions</b></th>
                                <tr>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    $currentpage = $this->Paginator->current($model = null)-1;
                                    $number = (10*$currentpage)+1;
                                    if($department != null)
                                    {
                                    foreach ($department as $department): 
                                ?>
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= h($department->departmentname) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $department->id]) ?>
                                        &nbsp;&nbsp;&nbsp;
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $department->id]) ?>
                                        &nbsp;&nbsp;&nbsp;
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete department : {0}?', $department->departmentname),'style'=>'color:red']) ?>
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
                </div>
            </div>
        </div>
    </div> 
</div>

