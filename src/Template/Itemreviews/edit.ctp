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
                ['action' => 'delete', $itemreview->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $itemreview->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Itemreviews'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Question'), ['controller' => 'Question', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Question', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemreviews form large-9 medium-8 columns content">
    <?= $this->Form->create($itemreview) ?>
    <fieldset>
        <legend><?= __('Edit Itemreview') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('reviewtype_id');
            echo $this->Form->input('goal');
            echo $this->Form->input('owner_id');
            echo $this->Form->input('description');
            echo $this->Form->input('startdate');
            echo $this->Form->input('enddate');
            echo $this->Form->input('isdeleted');
            echo $this->Form->input('question._ids', ['options' => $question]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
