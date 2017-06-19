<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

<div id="page-wrapper1" style="margin: 0 0 0 290px;">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="page-header">Service</h4>
        </div>
    </div>        
    
    <div class="panel-group" id="accordion">
        <div class="panel panel-info" style="width:700px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <?= $this->Form->create($service) ?>
                        <fieldset>
                            <div class="form-group">
                                <label for="servicename">Name</label>
                                <?= $this->Form->input('servicename',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <?= $this->Form->input('description',['class'=>'form-control','type' => 'textarea','disabled'=>'disabled','label'=>false]) ?>
                            </div>                            
                            
                            <?= $this->Form->end() ?>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>
