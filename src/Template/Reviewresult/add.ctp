<?php
use Cake\Routing\Router;
/**
  * @var \App\View\AppView $this
  */
//$this->layout='admin';
?>

<div class="reviewresult form large-9 medium-8 columns content">
    <?= $this->Form->create($reviewresult) ?>
    <fieldset>
        <legend><?= __('Add Reviewresult') ?></legend>
       
        <?php

            echo $this->Form->input('reviewid');
            echo $this->Form->input('reviewerid');
            echo $this->Form->input('revieweeid');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
