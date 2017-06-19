<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

<div id="page-wrapper1" style="margin: 0 0 0 290px;">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="page-header">Product</h4>
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

                    <?= $this->Form->create($product,array('onsubmit' => 'return confirm("Are you sure you want to save?")')) ?>
                        <fieldset>
                            <div class="form-group">
                                <label for="name" style="floating:right">Name</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('productname',['class'=>'form-control','label'=>false,'required','onchange'=>'CheckName(this);']) ?>
                            </div>
                            <div class="form-group">
                                <label for="description" style="floating:right">Description</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('description',['class'=>'form-control','type' => 'textarea','label'=>false,'required','onchange'=>'CheckDescription(this);']) ?>
                            </div>
                            <div class="form-group">
                                <label for="level">Color</label>
                                <?= $this->Form->input('color',['class'=>'form-control','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="level">Stauts</label>
                                <?= $this->Form->input('status',['class'=>'form-control','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="level" style="floating:right">Model</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('model',['class'=>'form-control','label'=>false,'required','onchange'=>'CheckModel(this);']) ?>
                            </div>
                            <div class="form-group">
                                <label for="level">Made In</label>
                                <?= $this->Form->input('made_in',['class'=>'form-control','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="level" style="floating:right">Price</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('price',['class'=>'form-control','required','label'=>false,'onchange'=>'CheckPrice(this);']) ?>
                            </div>
                            <div class="form-group">
                                <label for="level">Size</label>
                                <?= $this->Form->input('size',['class'=>'form-control','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="level">Weight</label>
                                <?= $this->Form->input('weight',['class'=>'form-control','label'=>false]) ?>
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

function CheckName(txtRankName)
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

function CheckModel(txtmodel)
{
     var rankDescriptionValue = txtmodel.value.trim();
     if(rankDescriptionValue == "")
     {
      txtmodel.setCustomValidity("Rank Description Required!");  
     }
     else if(rankDescriptionValue.length<1)
     {
        txtmodel.setCustomValidity("Rank Description length error!");
     }else {
        txtmodel.setCustomValidity("");
     }
 }

function CheckPrice(txtprice)
{
     var rankDescriptionValue = txtprice.value.trim();
     if(rankDescriptionValue == "")
     {
      txtprice.setCustomValidity("Rank Description Required!");  
     }
     else if(rankDescriptionValue.length<1)
     {
        txtprice.setCustomValidity("Rank Description length error!");
     }else {
        txtprice.setCustomValidity("");
     }
 }

function CheckDescription(txtdescription)
{
     var rankDescriptionValue = txtdescription.value.trim();
     if(rankDescriptionValue == "")
     {
      txtdescription.setCustomValidity("Rank Description Required!");  
     }
     else if(rankDescriptionValue.length<1)
     {
        txtdescription.setCustomValidity("Rank Description length error!");
     }else {
        txtdescription.setCustomValidity("");
     }
 }
</script>