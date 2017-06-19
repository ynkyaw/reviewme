<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
use Cake\Routing\Router;
?>

<div id="page-wrapper1" style="margin: 0 0 0 290px;">
   <div class="row">
        <div class="col-sm-10">                
            <h4 class="page-header" >Users</h4>            
        </div>            
    </div>
    
    <div class="panel-group" id="accordion">
        <div class="panel panel-info"  style="width:700px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <?= $this->Form->create($user) ?>
                    <fieldset>
                        
                        <div class="form-group">    
                            <label for="en" style="floating:right">User Name </label><label style="color:red;font-size:18px;">*</label><br/>
                            <span id="txtHint"></span>
                            <?= $this->Form->input('username',['class'=>'form-control','id'=>'username','label'=>false,'disabled'=>'disabled']) ?>
                        </div>

                        <div class="form-group">
                            <label for="en" style="floating:right">Employee </label><label style="color:red;font-size:18px;">*</label>
                           
                           <?= $this->Form->input('employee_id',['options' => $employees,'empty' => 'Select Employee','class'=>'form-control','label'=>false,'disabled' => 'disabled']) ?>
                        </div>
                        
                        <div class="form-group">
                           <label for="en" style="floating:right">Email </label><label style="color:red;font-size:18px;">*</label><br/>
                           <span id="txtHint1"></span>
                            <?= $this->Form->input('email',['class'=>'form-control','id'=>'email','label'=>false,'disabled'=>'disabled']) ?>
                        </div>

                        <div class="form-group">
                            <label for="en" style="floating:right">Roles </label><label style="color:red;font-size:18px;">*</label>
                           
                           <?= $this->Form->input('roleid',['options' => $roles,'empty' => 'Select Role','class'=>'form-control','label'=>false,'disabled'=>'disabled']) ?>
                        </div>
                        
                    </fieldset>
                    <?= $this->Form->button('Save',['class'=>"btn btn-primary btn-sm"]) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>