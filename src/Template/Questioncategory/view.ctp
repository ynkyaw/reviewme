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
            <h4 class="page-header">Question Type</h4>
        </div>            
    </div>
         
    <div class="panel-group" id="accordion">
        <div class="panel panel-info"  style="width:1000px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <?= $this->Form->create($questioncategory) ?>
                       
                    <fieldset>
                        <div class="form-group">
                            <label for="name">Question Category Name</label>
                            <?= $this->Form->input('questioncategoryname',['placeholder'=>'questiontypename','class'=>'form-control','disabled' => 'disabled','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="description">Question Category Description</label>
                            <?= $this->Form->input('questioncategorydescription',['placeholder'=>'questiondescription','class'=>'form-control','type' => 'textarea','disabled' => 'disabled','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="weight">Question Category Weight</label>
                            <?= $this->Form->input('questioncategoryweight',['placeholder'=>'questionweight','class'=>'form-control','disabled' => 'disabled','label'=>false]) ?>
                        </div>
                    </fieldset>
                    <!--</div> -->
                </div>
            </div>
        </div>
    </div>
</div>
