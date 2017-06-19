<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

<div id="page-wrapper1" style="margin: 0 0 0 290px;width:1000px;">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="page-header">Service</h4>
        </div>
        <div class="col-sm-2">                
        </div>            
    </div>

    <div class="row" style="margin-bottom: 10px;">
        <div class="col-sm-10">
        </div>
        <div class="col-sm-2" style="padding-top: 0px;">
            <a href="services/add" class="btn btn-primary btn-circle btn-lg" style="color: white;width: 80px;padding-top: 0.7em;margin-top: -1em">                
                <i class="fa fa-puzzle-piece">
                </i> New
            </a>
        </div>            
    </div>          
    
        <?php 
        $message = $this->Flash->render();
        if($message!= null && $message!=""){
            echo "<div class='alert alert-success' style='width:950px;'>".$message."</div>";
        } 
    ?>
    
    <div class="panel-group" id="accordion">
        <div class="panel panel-info" style="width:950px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr bgcolor="#337ab7">
                                    <th style="color:white;"><b>No</b></th>
                                    <th style="color:white;"><b>Name</b></th>
                                    <th style="color:white;"><b>Description</b></th>
                                    <th style="color:white;"><b>Actions</b></th>
                                <tr>
                            </thead>
                            <tbody>
                                <?php
                                    $currentpage = $this->Paginator->current($model = null)-1;
                                    $number = (10*$currentpage)+1; 
                                    if($services != null)
                                    {
                                    foreach ($services as $service): 
                                ?>
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= h($service->servicename) ?></td>
                                    <td><?= h($service->description) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $service->id]) ?>
                                        &nbsp;&nbsp;&nbsp;
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $service->id]) ?>
                                        &nbsp;&nbsp;&nbsp;
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $service->id], ['confirm' => __('Are you sure you want to delete rank : {0}?', $service->servicename),'style'=>'color:red']) ?>
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
