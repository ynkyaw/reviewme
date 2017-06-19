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
            <h4 class="page-header" >Question</h4>            
        </div>            
    </div>
         
    <div class="panel-group" id="accordion">
        <div class="panel panel-info"  style="width:700px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <?= $this->Form->create($question) ?>
                    <fieldset>
                        <div class="">
                            <label for="warning" style="color:red;font-size:18px;text-align:center;">(*) </label><label style="color:red;">&nbsp;&nbsp;required fields</label>
                        </div>
                        <div class="form-group"> 
                            <label for="name">Question Type</label>
                            <?= $this->Form->input('questiontypeid',['options' => $questioncategory,'class'=>'form-control','label'=>false]) ?>
                        </div>
                        <div class="form-group"> 
                            <label for="name">Subcategory Type</label>
                            <?= $this->Form->input('questiontypeid',['options' => $subcategory,'class'=>'form-control','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="qname">Question</label>
                            <?= $this->Form->input('questionname',['placeholder'=>'questionname','class'=>'form-control','type' => 'textarea','disabled'=>'disabled','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="qname">Question (English)</label>
                            <?= $this->Form->input('questionnameeng',['placeholder'=>'questionname','class'=>'form-control','type' => 'textarea','disabled'=>'disabled','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="weight">Question Weight</label>
                            <?= $this->Form->input('questionweight',['placeholder'=>'questionweight','class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                        </div>
                    </fieldset>
                    
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
