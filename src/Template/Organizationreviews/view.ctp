<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Organizationreview'), ['action' => 'edit', $organizationreview->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Organizationreview'), ['action' => 'delete', $organizationreview->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organizationreview->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Organizationreviews'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organizationreview'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="organizationreviews view large-9 medium-8 columns content">
    <h3><?= h($organizationreview->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($organizationreview->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Goal') ?></th>
            <td><?= h($organizationreview->goal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($organizationreview->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($organizationreview->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reviewtype Id') ?></th>
            <td><?= $this->Number->format($organizationreview->reviewtype_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Owner Id') ?></th>
            <td><?= $this->Number->format($organizationreview->owner_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Startdate') ?></th>
            <td><?= h($organizationreview->startdate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Enddate') ?></th>
            <td><?= h($organizationreview->enddate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($organizationreview->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($organizationreview->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isdeleted') ?></th>
            <td><?= $organizationreview->isdeleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
