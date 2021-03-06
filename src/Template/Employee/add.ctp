<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

<div id="page-wrapper1" style="margin: 0 0 0 290px;">
   <div class="row">
        <div class="col-sm-10">                
            <h4 class="page-header" >Employee</h4>            
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

                    <?= $this->Form->create($employee,array('onsubmit' => 'return confirm("Are you sure you want to save?")')) ?>
                    <fieldset>
                        <div class="">
                            <label for="warning" style="color:red;font-size:18px;text-align:center;">(*) </label><label style="color:red;">&nbsp;&nbsp;required fields</label>
                        </div>
                        <div class="form-group">    
                            <label for="name" style="floating:right">Employee Name</label> <label style="color:red;font-size:18px;">*</label>   
                            <?= $this->Form->input('name',['class'=>'form-control','label'=>false,'required','onchange'=>'CheckEmployeeName(this)']) ?>
                        </div>
                        <div class="form-group">
                            <label for="fname" style="floating:right">Family Name </label>
                            <?= $this->Form->input('fimalyname',['class'=>'form-control','label'=>false]) ?>
                        </div>                            
                        <div class="form-group">
                            <label for="en" style="floating:right">Employee Identity Number </label><label style="color:red;font-size:18px;">*</label>
                            <?= $this->Form->input('empoyeenumber',['class'=>'form-control','label'=>false,'required','onchange'=>'CheckEIN(this)']) ?>
                        </div>
                        <div class="form-group">
                            <label for="ssn" style="floating:right">Social Security Number </label>
                            <?= $this->Form->input('socialsecuritynumber',['class'=>'form-control','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="nrc" style="floating:right">NRC/Passport Number</label><label style="color:red;font-size:18px;">*</label>
                            <?= $this->Form->input('nrcnumber',['class'=>'form-control','label'=>false,'required','onchange'=>'CheckNRC(this)']) ?>
                        </div>
                        <div class="form-group">  
                            <label for="department" style="floating:right">Department</label><label style="color:red;font-size:18px;">*</label>                            
                            <?= $this->Form->input('departmentid',['options' => $department,'class'=>'form-control','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="rank" style="floating:right">Rank</label><label style="color:red;font-size:18px;">*</label>
                            <?= $this->Form->input('rankid',['options' => $rank,'class'=>'form-control','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="position" style="floating:right">Job Position</label><label style="color:red;font-size:18px;">*</label>
                            <?= $this->Form->input('jobpostionid',['options' => $jobposition,'class'=>'form-control','label'=>false]) ?>
                        </div>
                      
                        <div class="form-group">
                            <label for="doe" style="floating:right">Date Of Employment</label><label style="color:red;font-size:18px;">*</label>                                

                            <input type="date" class="form-control" id="doe" onblur="changeDate(this.value,'dateofemployment');" min="2000-01-01" max="2100-12-31" required>

                        </div>
                        <div class="form-group">
                            <label for="dob" style="floating:right">Date Of Birth</label><label style="color:red;font-size:18px;">*</label>                                
                            <input type="date" class="form-control" id="dob" onblur="changeDate(this.value,'dateofbirth');" min="1700-01-01" max="2100-12-31" required>
                        </div>
                        <div class="form-group">
                            <label for="dor" style="floating:right">Date Of Registered</label><label style="color:red;font-size:18px;">*</label>

                            <input type="date" class="form-control" id="dor" onblur="changeDate(this.value,'registered');" min="2000-01-01" max="2100-12-31" required>
                        </div>
                        <?= $this->Form->input('dateofemployment',['label'=>false,'minYear' =>date('Y')-42,'maxYear' =>date('Y')])?>
                        <?= $this->Form->input('dateofbirth',['label'=>false,'minYear' =>date('Y')-100,'maxYear' =>date('Y')-18])?>
                        <?= $this->Form->input('registered',['label'=>false,'minYear' =>date('Y')-42,'maxYear' =>date('Y')])?>
                    </fieldset>
                    <?= $this->Form->button('Save',['class'=>"btn btn-primary btn-sm"]) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready
    (function() {
        hideDate("dateofemployment");
        hideDate("dateofbirth");
        hideDate("registered");
    });

    function CheckEmployeeName(txtEmpName)
    {
         var name_pattern = /^(([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?\s)+([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?$/;
         var singleName =/^[A-Za-z0-9]+$/;

         //var txtDepartmentName = document.getElementById("departmentname");
         var rankValue = txtEmpName.value.trim();
         if(rankValue == "")
         {
            txtEmpName.setCustomValidity("Employee Name Required!");  
         }
         else if(rankValue.length<2)
         {
            txtEmpName.setCustomValidity("Employee Name length error!");
           
         }else if(!name_pattern.test(rankValue)&&!singleName.test(rankValue))
         {
            txtEmpName.setCustomValidity("Employee Title pattern mismatch!");
         }else {
            txtEmpName.setCustomValidity("");
         }

    }

    function CheckNRC(txtNRC)
    {
         var rankDescriptionValue = txtNRC.value.trim();
         if(rankDescriptionValue == "")
         {
          txtNRC.setCustomValidity("Employee Description Required!");  
         }
         else if(rankDescriptionValue.length<1)
         {
            txtNRC.setCustomValidity("Employee Description length error!");
         }else {
            txtNRC.setCustomValidity("");
         }
    }

    function CheckEIN(textEIN)
    {
        var rankDescriptionValue = txtNRC.value.trim();
        if(rankDescriptionValue == "")
        {
            txtNRC.setCustomValidity("Employee Description Required!");  
        }
        else if(rankDescriptionValue.length<1)
        {
            txtNRC.setCustomValidity("Employee Description length error!");
        }else 
        {
            txtNRC.setCustomValidity("");
        }
    }

</script>
