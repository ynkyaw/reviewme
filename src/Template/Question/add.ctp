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
                    <?= $this->Form->create($question,array('onsubmit' => 'return confirm("Are you sure you want to save?")')) ?>
                    <fieldset>
                        <legend><?= __('Add Question') ?></legend>
                            <div class="">
                                <label for="warning" style="color:red;font-size:18px;text-align:center;">(*) </label><label style="color:red;">&nbsp;&nbsp;required fields</label>
                            </div>
                            <div class="form-group">
                            <label for="name" style="floating:right">Question Type</label><label style="color:red;font-size:18px;">*</label>                                   
                                <?= $this->Form->input('questiontypeid',['options' => $questioncategory,'class'=>'form-control','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                            <label for="name" style="floating:right">SubCategory Type</label><label style="color:red;font-size:18px;">*</label>                                   
                                <?= $this->Form->input('questiontypeid',['options' => $subquestion,'class'=>'form-control','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="qname" style="floating:right">Question (MM)</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('questionname',['class'=>'form-control','type' => 'textarea','label'=>false,'required','onchange'=>'CheckName(this)']) ?>
                            </div>
                             <div class="form-group">
                                <label for="qname" style="floating:right">Question (ENG)</label>
                                <?= $this->Form->input('questionnameeng',['class'=>'form-control','type' => 'textarea','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="weight" style="floating:right">Question Weight</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('questionweight',['class'=>'form-control','min' => 1 ,'max' => 10,'label'=>false,'required','onchange'=>'CheckWeight(this)']) ?>
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
    
    function CheckName(txtQName)
    {
         var rankDescriptionValue = txtQName.value.trim();
         if(rankDescriptionValue == "")
         {
          txtQName.setCustomValidity("Question Name Required!");  
         }
         else if(rankDescriptionValue.length<1)
         {
            txtQName.setCustomValidity("Question Name length error!");
         }else {
            txtQName.setCustomValidity("");
         }

    }

    function CheckWeight(txtWeight)
    {
         var rankDescriptionValue = txtWeight.value.trim();
         if(rankDescriptionValue == "")
         {
          txtWeight.setCustomValidity("Question Weight Required!");  
         }
         else if(rankDescriptionValue.length<1)
         {
            txtWeight.setCustomValidity("Question Weight length error!");
         }else {
            txtWeight.setCustomValidity("");
         }
    }
</script>