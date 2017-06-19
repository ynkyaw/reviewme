<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

<div id="page-wrapper1" style="margin: 0 0 0 290px;">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="page-header">Product</h4>
        </div>
    </div>        
    
    <div class="panel-group" id="accordion">
        <div class="panel panel-info" style="width:700px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <?= $this->Form->create($product) ?>
                        <fieldset>
                            <div class="form-group">
                                <label for="productname">Name</label>
                                <?= $this->Form->input('productname',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <?= $this->Form->input('description',['class'=>'form-control','type' => 'textarea','disabled'=>'disabled','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="level">Color</label>
                                <?= $this->Form->input('color',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="level">Stauts</label>
                                <?= $this->Form->input('status',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="level">Model</label>
                                <?= $this->Form->input('model',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="level">Made In</label>
                                <?= $this->Form->input('made_in',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="level">Price</label>
                                <?= $this->Form->input('price',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="level">Size</label>
                                <?= $this->Form->input('size',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="level">Weight</label>
                                <?= $this->Form->input('weight',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                            </div>
                            
                            <?= $this->Form->end() ?>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>
