<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

<div id="page-wrapper1" style="margin: 0 0 0 290px;">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="page-header">Rank</h4>
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

                    <?= $this->Form->create($rank,array('onsubmit' => 'return confirm("Are you sure you want to save?")')) ?>
                        <fieldset>
                            <div class="">
                                <label for="warning" style="color:red;font-size:18px;text-align:center;">(*) </label><label style="color:red;">&nbsp;&nbsp;required fields</label>
                            </div>
                            <div class="form-group">
                                <label for="rankname" style="floating:right">Rank Name</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('rank',['class'=>'form-control','label'=>false,'required','onchange'=>'CheckRankName(this)']) ?>
                            </div>
                            <div class="form-group">
                                <label for="description">Rank Description</label>
                                <?= $this->Form->input('description',['class'=>'form-control','type' => 'textarea','label'=>false,'required','onchange'=>'CheckRankDescription(this)']) ?>
                            </div>
                            <div class="form-group">
                                <label for="level" style="floating:right">Rank Level</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('level',['class'=>'form-control','label'=>false]) ?>
                            </div>
                            
                            <?= $this->Form->button('Save',['class'=>'btn btn-primary btn-sm']) ?>
                            
                        </fieldset>
                    <?= $this->Form->end() ?>
                    
                </div>
            </div>
        </div>
    </div> 
</div>

<script type="text/javascript">
    
    function CheckRankName(txtRankName)
    {
         var name_pattern = /^(([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?\s)+([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?$/;
         var singleName =/^[A-Za-z0-9]+$/;

         //var txtDepartmentName = document.getElementById("departmentname");
         var rankValue = txtRankName.value.trim();
         if(rankValue == "")
         {
            txtRankName.setCustomValidity("Rank Name Required!");  
         }
         else if(rankValue.length<2)
         {
            txtRankName.setCustomValidity("Rank Name length error!");
           
         }else if(!name_pattern.test(rankValue)&&!singleName.test(rankValue))
         {
            txtRankName.setCustomValidity("Rank Title pattern mismatch!");
         }else {
            txtRankName.setCustomValidity("");
         }

    }

    function CheckRankDescription(txtDescription)
    {
         var rankDescriptionValue = txtDescription.value.trim();
         if(rankDescriptionValue == "")
         {
          txtDescription.setCustomValidity("Rank Description Required!");  
         }
         else if(rankDescriptionValue.length<1)
         {
            txtDescription.setCustomValidity("Rank Description length error!");
         }else {
            txtDescription.setCustomValidity("");
         }

    }

    /*function checkconfirm()
    {
        alert("Are you sure you want to save?");
,'onclick'=>'checkconfirm()'
    }
*/
</script>