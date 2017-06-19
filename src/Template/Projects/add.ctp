<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

<div id="page-wrapper1" style="margin: 0 0 0 290px;">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="page-header">Project</h4>
        </div>
    </div>        
    
    <div class="panel-group" id="accordion">
        <div class="panel panel-info" style="width:700px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">

                    <?php 
                        $message = $this->Flash->render();
                        if($message!= null && $message!="")
                        {
                            echo "<div class='alert alert-success'>".$message."</div>";
                        }
                     ?>  

                    <?= $this->Form->create($project,array('onsubmit' => 'return confirm("Are you sure you want to save?")')) ?>
                        <fieldset>
                            <div class="">
                                <label for="warning" style="color:red;font-size:18px;text-align:center;">(*) </label><label style="color:red;">&nbsp;&nbsp;required fields</label>
                            </div>
                            <div class="form-group">
                                <label for="name" style="floating:right">Name</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('projectname',['class'=>'form-control','label'=>false,'required','onchange'=>'CheckName(this);']) ?>
                            </div>
                            <div class="form-group">
                                <label for="description" style="floating:right">Description</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('description',['class'=>'form-control','type' => 'textarea','label'=>false,'required','onchange'=>'CheckDescription(this);']) ?>
                            </div>
                            
                            <?= $this->Form->button('Save',['class'=>"btn btn-primary btn-sm"]) ?>
                            
                        </fieldset>
                    <?= $this->Form->end() ?>
                    
                </div>
            </div>
        </div>
    </div> 
</div>
<script type="text/javascript">

function CheckName(txtName)
{
     var name_pattern = /^(([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?\s)+([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?$/;
     var singleName =/^[A-Za-z0-9]+$/;

     //var txtDepartmentName = document.getElementById("departmentname");
     var rankValue = txtName.value.trim();
     if(rankValue == "")
     {
        txtName.setCustomValidity("Project Name Required!");  
     }
     else if(rankValue.length<2)
     {
        txtName.setCustomValidity("Project Name length error!");
       
     }else if(!name_pattern.test(rankValue)&&!singleName.test(rankValue))
     {
        txtName.setCustomValidity("Project Title pattern mismatch!");
     }else {
        txtName.setCustomValidity("");
     }

}

function CheckDescription(txtDescription)
{
     var rankDescriptionValue = txtDescription.value.trim();
     if(rankDescriptionValue == "")
     {
      txtDescription.setCustomValidity("Project Description Required!");  
     }
     else if(rankDescriptionValue.length<1)
     {
        txtDescription.setCustomValidity("Project Description length error!");
     }else {
        txtDescription.setCustomValidity("");
     }

}
</script>