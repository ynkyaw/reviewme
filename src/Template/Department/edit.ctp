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
            <h4 class="page-header">Edit Department</h4>
        </div>            
    </div>
         
    <div class="panel-group" id="accordion">
        <div class="panel panel-info"  style="width:700px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <?php 
                        $message = $this->Flash->render();
                        if($message!= null && $message!="")
                        {
                            echo "<div class='alert alert-success'>".$message."</div>";
                        }
                     ?>  

                    <?= $this->Form->create($department,array('onsubmit' => 'return confirm("Are you sure you want to save?")')) ?>
                        <fieldset>
                            <?php 
                        $message = $this->Flash->render();
                        if($message!= null && $message!=""){
                            echo "<div class='alert alert-warning'>".$message."</div>";
                        }
                     ?>   
                            <div class="form-group">
                                <label for="name" style="floating:right">Department Name</label><label style="color:red;font-size:18px;">*</label>  
                                <?= $this->Form->input('departmentname',['placeholder'=>'departmentname','class'=>'form-control','label'=>false,'onchange'=>'CheckValidation(this)']) ?>
                            </div>
                            
                            <?= $this->Form->button('Save',['class'=>"btn btn-primary btn-sm"]) ?>
                            <?= $this->Form->end() ?>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function CheckValidation(txtDepartmentName)
    {
         var name_pattern = /^(([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?\s)+([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?$/;
         var singleName =/^[A-Za-z0-9]+$/;

         //var txtDepartmentName = document.getElementById("departmentname");
         var departmentValue = txtDepartmentName.value.trim();
         if(departmentValue == "")
         {
          txtDepartmentName.setCustomValidity("Department Name Required!");  
         }
         else if(departmentValue.length<2)
         {
            txtDepartmentName.setCustomValidity("Department Name length error!");
           
         }else if(!name_pattern.test(departmentValue)&&!singleName.test(departmentValue))
         {
            txtDepartmentName.setCustomValidity("Department Name pattern mismatch!");
           
         }else {
            txtDepartmentName.setCustomValidity("");
           
         }

    }

</script>