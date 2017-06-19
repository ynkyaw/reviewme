<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Reviewresultdetail'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="reviewresultdetail form large-9 medium-8 columns content">
    <?= $this->Form->create($reviewresultdetail) ?>
    <fieldset>
        <legend><?= __('Add Reviewresultdetail') ?></legend>
        <?php
            echo $this->Form->input('questionid');
            echo $this->Form->input('reviewresult_id');
            echo $this->Form->input('mark');
            echo $this->Form->input('isDeleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
