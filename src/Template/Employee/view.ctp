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
                    <?= $this->Form->create($employee) ?>
                    <fieldset>
                        <div class="form-group"> 
                            <label for="name">Employee Name</label>        
                            <?= $this->Form->input('name',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="fname">Family Name</label> 
                            <?= $this->Form->input('fimalyname',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="eno">Employee Number</label> 
                            <?= $this->Form->input('empoyeenumber',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="ssn">Social Security Number</label>
                            <?= $this->Form->input('socialsecuritynumber',['class'=>'form-control','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="ssn">NRC/Passport Number</label>
                            <?= $this->Form->input('nrcnumber',['class'=>'form-control','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <?= $this->Form->input('Department',['options' => $department,'class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="rank">Rank</label> 
                            <?= $this->Form->input('Rank',['options' => $rank,'class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="jobposition">Job Position</label> 
                            <?= $this->Form->input('JobPosition',['options' => $jobposition,'class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                        </div>
                      
                        <div class="form-group">
                            <label for="doe">Date Of Employment</label> 
                            <input type="date" class="form-control" id="doe" onblur="changeDate(this.value,'dateofemployment');">
                        </div>
                        <div class="form-group">
                            <label for="dob">Date Of Birth</label>                                
                            <input type="date" class="form-control" id="dob" onblur="changeDate(this.value,'dateofbirth');">
                        </div>
                        <div class="form-group">
                            <label for="dor">Date Of Registered</label>
                            <input type="date" class="form-control" id="dor" onblur="changeDate(this.value,'registered');">
                        </div>
                        <?= $this->Form->input('dateofemployment',['label'=>false,'minYear' =>date('Y'),'maxYear' =>date('Y')+2])?>
                        <?= $this->Form->input('dateofbirth',['label'=>false,'minYear' =>date('Y'),'maxYear' =>date('Y')+2])?>
                        <?= $this->Form->input('registered',['label'=>false,'minYear' =>date('Y'),'maxYear' =>date('Y')+2])?>
                    </fieldset>
                    
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
        setMyDate('doe','dateofemployment');
        setMyDate('dob','dateofbirth');
        setMyDate('dor','registered');
    });
</script>