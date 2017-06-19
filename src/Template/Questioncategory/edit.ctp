<?php
use Cake\Routing\Router;
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-10">                
            <h4 class="page-header" >Question Category</h4>            
        </div>            
    </div>
         
    <div class="panel-group" id="accordion">
        <div class="panel panel-info"  style="width:1000px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">

                    <?php 
                        $message = $this->Flash->render();
                        if($message!= null && $message!="")
                        {
                            echo "<div class='alert alert-success'>".$message."</div>";
                        }
                     ?>  

                    <?= $this->Form->create($questioncategory,array('onsubmit' => 'return confirm("Are you sure you want to save?")')) ?>
                    <fieldset>
                        <div class="form-group">
                            <label for="name" style="floating:right">Question Category Name</label><label style="color:red;font-size:18px;">*</label>
                            <?= $this->Form->input('questioncategoryname',['placeholder'=>'questiontypename','class'=>'form-control','label'=>false,'required','onchange'=>'CheckName(this)']) ?>
                        </div>
                        <div class="form-group">
                            <label for="description">Question Category Description</label>
                            <?= $this->Form->input('questioncategorydescription',['placeholder'=>'questiondescription','class'=>'form-control','type' => 'textarea','label'=>false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="weight" style="floating:right">Question Category Weight</label><label style="color:red;font-size:18px;">*</label>
                            <?= $this->Form->input('questioncategoryweight',['placeholder'=>'questionweight','class'=>'form-control','label'=>false,'required','onchange'=>'CheckWeight(this)']) ?>
                        </div>
                    </fieldset>
                    <?= $this->Form->button('Save',['class'=>"btn btn-primary btn-sm"]) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    function CheckName(txtQName)
    {
         var rankDescriptionValue = txtQName.value.trim();
         if(rankDescriptionValue == "")
         {
          txtQName.setCustomValidity("Rank Description Required!");  
         }
         else if(rankDescriptionValue.length<1)
         {
            txtQName.setCustomValidity("Rank Description length error!");
         }else {
            txtQName.setCustomValidity("");
         }

    }

    function CheckWeight(txtWeight)
    {
         var rankDescriptionValue = txtWeight.value.trim();
         if(rankDescriptionValue == "")
         {
          txtWeight.setCustomValidity("Rank Description Required!");  
         }
         else if(rankDescriptionValue.length<1)
         {
            txtWeight.setCustomValidity("Rank Description length error!");
         }else {
            txtWeight.setCustomValidity("");
         }
    }
</script>