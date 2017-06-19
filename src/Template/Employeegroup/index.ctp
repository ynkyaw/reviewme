<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

    <div id="page-wrapper1" style="margin: 0 0 0 290px;width:1000px;">
        <div class="row">
            <div class="col-sm-10">
                <h4 class="page-header">Employee Group</h4>
            </div>
            <div class="col-sm-2">                
            </div>            
        </div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-sm-10">
            </div>
            <div class="col-sm-2" style="padding-top: 0px;">
                <a href="employeegroup/add" class="btn btn-primary btn-circle btn-lg" style="color: white;width: 80px;padding-top: 0.7em;margin-top: -1em">                
                    <i class="fa fa-group">
                    </i> New
                </a>
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
                                        <th style="color:white;"><b>No</b></th>
                                        <th style="color:white;"><b>Group Name</b></th>
                                        <th style="color:white;"><b>Group Description</b></th>
                                        <th style="color:white;"><b>Actions</b></th>
                                    <tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $currentpage = $this->Paginator->current($model = null)-1;
                                        $count = (10*$currentpage)+1;
                                        if($employeegroup != null)
                                        {
                                        foreach ($employeegroup as $employeegroup): 
                                    ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= h($employeegroup->name) ?></td>
                                        <td><?= h($employeegroup->description) ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('View'), ['action' => 'view', $employeegroup->id]) ?>
                                            &nbsp;&nbsp;&nbsp;
                                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $employeegroup->id]) ?>
                                            &nbsp;&nbsp;&nbsp;
                                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $employeegroup->id], ['confirm' => __('Are you sure you want to delete group : {0}?', $employeegroup->name),'style'=>'color:red']) ?>
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
