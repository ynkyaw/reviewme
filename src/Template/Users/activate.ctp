<?php
use Cake\Routing\Router;
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>


<div id="page-wrapper1" style="margin: 0 0 0 290px;">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="page-header">Activate</h4>
        </div>
    </div>        
    
    <div class="panel-group" id="accordion">
        <div class="panel panel-info" style="width:700px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <?= $this->Form->create($user) ?>
                        <fieldset>
                            <div class="form-group">  
                            <!-- <label for="name">User ID</label>  -->                              
                                <?= $this->Form->input('id',['class'=>'form-control','label'=>false]) ?>
                            </div>
                            <div class="form-group" style="padding-bottom: .2em;width:450px;">
                            <label for="name">User Name</label>                               
                                <?= $this->Form->input('username',['class'=>'form-control','label'=>false]) ?>
                            </div>
                            <div class="form-group" style="padding-bottom: .2em;width:450px;">
                                <label for="name">User Role</label>                                   
                                <?= $this->Form->input('role',['options' => $roles,'class'=>'form-control','label'=>false]) ?>                            
                            </div>
                            <div>
                                <?= $this->Form->button(__('Activate'),['class'=>'btn btn-md btn-primary']) ?>
                            </div>                            
                        </fieldset>
                        <?= $this->Form->end() ?>    
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>
