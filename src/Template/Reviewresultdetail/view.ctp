<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Reviewresultdetail'), ['action' => 'edit', $reviewresultdetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Reviewresultdetail'), ['action' => 'delete', $reviewresultdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reviewresultdetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Reviewresultdetail'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reviewresultdetail'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reviewresultdetail view large-9 medium-8 columns content">
    <h3><?= h($reviewresultdetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($reviewresultdetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Questionid') ?></th>
            <td><?= $this->Number->format($reviewresultdetail->questionid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reviewresult Id') ?></th>
            <td><?= $this->Number->format($reviewresultdetail->reviewresult_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mark') ?></th>
            <td><?= $this->Number->format($reviewresultdetail->mark) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($reviewresultdetail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($reviewresultdetail->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsDeleted') ?></th>
            <td><?= $reviewresultdetail->isDeleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
