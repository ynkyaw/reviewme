<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

    <div id="page-wrapper1" style="margin: 0 0 0 290px;">
        <div class="row">
            <div class="col-sm-10">
                <h4 class="page-header">Edit Job Position</h4>
            </div>
        </div>        
        
        <div class="panel-group" id="accordion">
            <div class="panel panel-info" style="width:1000px;">                                    
                <div id="groupA" class="panel-collapse collapse in">
                    <div class="panel-heading">
                       <?php 
                        $message = $this->Flash->render();
                        if($message!= null && $message!="")
                        {
                            echo "<div class='alert alert-success'>".$message."</div>";
                        }
                     ?>      
                            
                        <?= $this->Form->create($jobposition,array('onsubmit' => 'return confirm("Are you sure you want to save?")')) ?>
                            <fieldset>
                                <div class="form-group">
                                    <label for="title" style="floating:right">Job Title</label><label style="color:red;font-size:18px;">*</label>
                                    <?= $this->Form->input('jobtitle',['class'=>'form-control','label'=>false,'required','onchange'=>'CheckJobPositionName(this)']) ?>
                                </div>
                                <div class="form-group" style="floating:right">
                                    <label for="description">Job Description</label><label style="color:red;font-size:18px;">*</label>
                                    <?= $this->Form->input('jobdescription',['class'=>'form-control','type' => 'textarea','label'=>false,'required','onchange'=>'CheckDescription(this)']) ?>
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
    function CheckJobPositionName(txtTitle)
    {
         var name_pattern = /^(([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?\s)+([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?$/;
         var singleName =/^[A-Za-z0-9]+$/;

         //var txtDepartmentName = document.getElementById("departmentname");
         var jobtitleValue = txtTitle.value.trim();
         if(jobtitleValue == "")
         {
          txtTitle.setCustomValidity("Job Title Required!");  
         }
         else if(jobtitleValue.length<2)
         {
            txtTitle.setCustomValidity("Job Title length error!");
           
         }else if(!name_pattern.test(jobtitleValue)&&!singleName.test(jobtitleValue))
         {
            txtTitle.setCustomValidity("Job Title pattern mismatch!");
           
         }else {
            txtTitle.setCustomValidity("");
           
         }

    }

     function CheckDescription(txtDescription)
    {
         //var txtDepartmentName = document.getElementById("departmentname");
         var jobDescriptionValue = txtDescription.value.trim();
         if(jobDescriptionValue == "")
         {
          txtDescription.setCustomValidity("Job Description Required!");  
         }
         else if(jobDescriptionValue.length<2)
         {
            txtDescription.setCustomValidity("Job Description length error!");
           
         }else {
            txtDescription.setCustomValidity("");
           
         }

    }

</script>