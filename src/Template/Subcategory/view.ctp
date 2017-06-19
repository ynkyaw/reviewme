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
            <h4 class="page-header" >Subcategory</h4>            
        </div>            
    </div>
         
    <div class="panel-group" id="accordion">
        <div class="panel panel-info"  style="width:700px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <?= $this->Form->create($subcategory) ?>
                    <fieldset>
                        <div class="form-group"> 
                            <label for="name">Question Type</label>
                            <?= $this->Form->input('questiontypeid',['options' => $questioncategory,'class'=>'form-control','label'=>false,'disabled' => 'disabled']) ?>
                        </div>
                        <div class="form-group">
                            <label for="qname">Subcategory Name</label>
                            <?= $this->Form->input('name',['placeholder'=>'name','class'=>'form-control','type' => 'textarea','disabled'=>'disabled','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="qname">Subcategory Description</label>
                            <?= $this->Form->input('description',['placeholder'=>'description','class'=>'form-control','type' => 'textarea','disabled'=>'disabled','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="weight">Subcategory Weight</label>
                            <?= $this->Form->input('subcategoryweight',['placeholder'=>'weight','class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                        </div>
                    </fieldset>
                    
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
