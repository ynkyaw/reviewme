<?php
/**
  * @var \App\View\AppView $this
  */
    $this->layout = 'superadmin';
?>
<style type="text/css">
    .row{
        padding-top: 10px;
    }
</style>
<br/>
<div class="row">

<div class="col-lg-3">
</div>
<div class="col-lg-8" >
<div class="row">
  <div class="col-xs-12">
    <?php 
        $message = $this->Flash->render();
        if($message!= null && $message!="")
        {
            echo "<div class='alert alert-success'>".$message."</div>";
        } 
    ?> 
  </div>
</div>
<div class="panel panel-primary" id="page-wrapper1" >
  <div class="panel-body">
    <?= $this->Form->create($company) ?>
    <fieldset>
        <legend><?= __('Company Profile') ?></legend>

        <div class="row">
            <div class="col-xs-2">
                <label >Company Name</label>
            </div>
            <div class="col-xs-10">
                 <?= $this->Form->input('name',['class'=>'form-control','label'=>false,'required']) ?>
            </div>
        </div>
         <div class="row">
            <div class="col-xs-2">
                <label >Industry</label>
            </div>
            <div class="col-xs-10">
                 <?= $this->Form->input('industry',['class'=>'form-control','label'=>false,'required']) ?>
            </div>
        </div>
         <div class="row">
            <div class="col-xs-2">
                <label >Address Line1</label>
            </div>
            <div class="col-xs-10">
                 <?= $this->Form->input('adderssline1',['class'=>'form-control','label'=>false,'required']) ?>
            </div>
        </div>
         <div class="row">
            <div class="col-xs-2">
                <label >Address Line2</label>
            </div>
            <div class="col-xs-10">
                 <?= $this->Form->input('addressline2',['class'=>'form-control','label'=>false,'required']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-2">
                <label >Township</label>
            </div>
            <div class="col-xs-10">
                 <?= $this->Form->input('township_id',['options'=> $townships ,'class'=>'form-control','label'=>false,'required']) ?>
            </div>
        </div>
         <div class="row">
            <div class="col-xs-2">
                <label >Website</label>
            </div>
            <div class="col-xs-10">
                 <?= $this->Form->input('website',['class'=>'form-control','label'=>false,'required']) ?>
            </div>
        </div>
         <div class="row">
            <div class="col-xs-2">
                <label >Fax</label>
            </div>
            <div class="col-xs-10">
                 <?= $this->Form->input('fax',['class'=>'form-control','label'=>false,'required']) ?>
            </div>
        </div>
         <div class="row">
            <div class="col-xs-2">
                <label >Phone</label>
            </div>
            <div class="col-xs-10">
                 <?= $this->Form->input('phone',['class'=>'form-control','label'=>false,'required']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-2">
                <label >Email</label>
            </div>
            <div class="col-xs-10">
                 <?= $this->Form->input('email',['class'=>'form-control','label'=>false,'required']) ?>
            </div>
        </div>
    </fieldset>
    <div class="row">
        <div class="col-xs-4"></div>
        <div class="col-xs-4">
            <?= $this->Form->button(__('Save'),['class'=>'btn btn-primary']) ?>
        </div>
        <div class="col-xs-4"></div>
    
    <?= $this->Form->end() ?>
    </div>
</div>
<div class="col-lg-1">
</div>
</div>


</div>
