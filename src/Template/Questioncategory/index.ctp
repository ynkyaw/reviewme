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
            <h4 class="page-header">Question Categories</h4>
        </div>
        <div class="col-sm-2">                
        </div>            
    </div>
    <div class="row" style="margin-bottom: 10px;width:1100px;">
        <div class="col-sm-10">
        </div>
        <div class="col-sm-2" style="padding-top: 0px;">
            <a href="questioncategory/add" class="btn btn-primary btn-circle btn-lg" style="color: white;width: 90px;padding-top: 0.75em;margin-top: -1em">                
                <i class="fa fa-question-circle-o">
                </i> New
            </a>
        </div>
    </div>
    
     <div class="row">
        <div class="col-md-6">
         </div>
        <div class="col-md-6">
            <?= $this->Form->create('Question',['type' => 'file','url' => ['controller'=>'questioncategory','action' => 'import'],'class'=>'form-inline','role'=>'form',]) ?>
            <div class="form-group">
                <label class="sr-only" for="csv"> CSV </label>
                <?php echo $this->Form->input('csv', ['type'=>'file','class' => 'form-control', 'label' => false ,'placeholder' => 'csv upload',]); ?>
            </div>
            <button type="submit" class="btn btn-default"> Upload </button>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <div class="gab" style="height:30px;align:right;"></div>  
         
    <div class="panel-group" id="accordion" style="width:1000px;">
        <div class="panel panel-info">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr bgcolor="#337ab7">
                                    <th style="color:white;"><b>No</b></th>
                                    <th style="color:white;"><b>Question Type Name</b></th>
                                    <th style="color:white;"><b>Question Type Description</b></th>
                                    <th style="color:white;"><b>Question Weight</b></th>
                                    <th style="color:white;"><b>Actions</b></th>
                                <tr>
                            </thead>
                            <tbody>
                                <?php
                                    $currentpage = $this->Paginator->current($model = null)-1;
                                    $number = (10*$currentpage)+1; 
                                    if($questioncategory != null)
                                    {
                                    foreach ($questioncategory as $questiontype): 
                                ?>
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= h($questiontype->questioncategoryname) ?></td>
                                    <td><?= h($questiontype->questioncategorydescription) ?></td>
                                    <td style="text-align:center"><?= $this->Number->format($questiontype->questioncategoryweight) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $questiontype->id]) ?>
                                        &nbsp;&nbsp;&nbsp;
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $questiontype->id]) ?>
                                        &nbsp;&nbsp;&nbsp;
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $questiontype->id], ['confirm' => __('Are you sure you want to delete question category : {0}?', $questiontype->questioncategoryname),'style'=>'color:red']) ?>
                                    </td>
                                </tr>
                                <?php endforeach; 
                            }?>
                                
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
