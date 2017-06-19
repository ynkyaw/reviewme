
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
            <h4 class="page-header"></h4>
        </div>            
    </div>
         
    <div class="panel-group" id="accordion">
        <div class="panel panel-info"  style="width:700px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    
                    <?= $this->Form->create($subcategory,array('onsubmit' => 'return confirm("Are you sure you want to save?")')) ?>
                    <fieldset>
                        <legend><?= __('Add Subcategory') ?></legend>
                            <div class="">
                                <label for="warning" style="color:red;font-size:18px;text-align:center;">(*) </label><label style="color:red;">&nbsp;&nbsp;required fields</label>
                            </div>
                            <div class="form-group">
                            <label for="name" style="floating:right">Question Category Type</label><label style="color:red;font-size:18px;">*</label>                                   
                                <?= $this->Form->input('questioncategoryid',['options' => $questioncategory,'class'=>'form-control','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="qname" style="floating:right">Subcategory Name</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('name',['class'=>'form-control','type' => 'textarea','label'=>false,'required','onchange'=>'CheckName(this)']) ?>
                            </div>
                             <div class="form-group">
                                <label for="qname" style="floating:right">Subcategory Description</label>
                                <?= $this->Form->input('description',['class'=>'form-control','type' => 'textarea','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="weight" style="floating:right">Subcategory Weight</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('subcategoryweight',['class'=>'form-control','min' => 1 ,'max' => 10,'label'=>false]) ?>
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
 function CheckName(txtname)
    {
         var rankDescriptionValue = txtname.value.trim();
         if(rankDescriptionValue == "")
         {
          txtname.setCustomValidity("Subcategory Name Required!");  
         }
         else if(rankDescriptionValue.length<1)
         {
            txtname.setCustomValidity("Subcategory Name length error!");
         }else {
            txtname.setCustomValidity("");
         }

    }
</script>