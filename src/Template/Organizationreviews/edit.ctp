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
                ['action' => 'delete', $organizationreview->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $organizationreview->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Organizationreviews'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="organizationreviews form large-9 medium-8 columns content">
    <?= $this->Form->create($organizationreview) ?>
    <fieldset>
        <legend><?= __('Edit Organizationreview') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('reviewtype_id');
            echo $this->Form->input('goal');
            echo $this->Form->input('owner_id');
            echo $this->Form->input('description');
            echo $this->Form->input('startdate');
            echo $this->Form->input('enddate');
            echo $this->Form->input('isdeleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
