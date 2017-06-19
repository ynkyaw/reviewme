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
                ['action' => 'delete', $reviewresultdetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $reviewresultdetail->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Reviewresultdetail'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="reviewresultdetail form large-9 medium-8 columns content">
    <?= $this->Form->create($reviewresultdetail) ?>
    <fieldset>
        <legend><?= __('Edit Reviewresultdetail') ?></legend>
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
