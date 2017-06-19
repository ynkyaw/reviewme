<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $reviewresult->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $reviewresult->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Reviewresult'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Reviewresultdetail'), ['controller' => 'Reviewresultdetail', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reviewresultdetail'), ['controller' => 'Reviewresultdetail', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reviewresult form large-9 medium-8 columns content">
    <?= $this->Form->create($reviewresult) ?>
    <fieldset>
        <legend><?= __('Edit Reviewresult') ?></legend>
        <?php
            echo $this->Form->input('reviewid');
            echo $this->Form->input('reviewerid');
            echo $this->Form->input('revieweeid');
            echo $this->Form->input('IsDeleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
