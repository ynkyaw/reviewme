<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use Cake\Routing\Router;

$this->layout = 'superadmin';

?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="page-header">Department</h4>
        </div>            
    </div>
         
    <div class="panel-group" id="accordion">
        <div class="panel panel-info"  style="width:700px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <?= $this->Form->create($department) ?>
                       
                    <fieldset>
                        <div class="form-group">
                            <label for="name">Department Name</label> 
                            <?= $this->Form->input('departmentname',['placeholder'=>'departmentname','class'=>'form-control','disabled' => 'disabled','label'=>false]) ?>
                        </div>
                    </fieldset>
                    <!--</div> -->
                </div>
            </div>
        </div>
    </div>
</div>