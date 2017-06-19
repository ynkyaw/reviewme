<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

    <div id="page-wrapper1" style="margin: 0 0 0 290px;">
        <div class="row">
            <div class="col-sm-10">
                <h4 class="page-header">Job Position</h4>
            </div>
        </div>        
        
        <div class="panel-group" id="accordion">
            <div class="panel panel-info" style="width:1000px;">                                    
                <div id="groupA" class="panel-collapse collapse in">
                    <div class="panel-heading">
                        <?= $this->Form->create($jobposition) ?>
                            <fieldset>
                                <div class="form-group">
                                    <label for="title">Job Title</label>
                                    <?= $this->Form->input('jobtitle',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                                </div>
                                <div class="form-group">
                                    <label for="description">Job Description</label>
                                    <?= $this->Form->input('jobdescription',['class'=>'form-control','type' => 'textarea','disabled'=>'disabled','label'=>false]) ?>
                                </div>
                                
                                <?= $this->Form->end() ?>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>
