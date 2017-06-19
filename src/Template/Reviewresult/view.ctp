<?php
/**
  * @var \App\View\AppView $this
  */

echo "JSON".$reviewresult;
die();
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Reviewresult'), ['action' => 'edit', $reviewresult->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Reviewresult'), ['action' => 'delete', $reviewresult->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reviewresult->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Reviewresult'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reviewresult'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reviewresultdetail'), ['controller' => 'Reviewresultdetail', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reviewresultdetail'), ['controller' => 'Reviewresultdetail', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reviewresult view large-9 medium-8 columns content">
    <h3><?= h($reviewresult->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($reviewresult->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reviewid') ?></th>
            <td><?= $this->Number->format($reviewresult->reviewid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reviewerid') ?></th>
            <td><?= $this->Number->format($reviewresult->reviewerid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Revieweeid') ?></th>
            <td><?= $this->Number->format($reviewresult->revieweeid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($reviewresult->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($reviewresult->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsDeleted') ?></th>
            <td><?= $reviewresult->IsDeleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Reviewresultdetail') ?></h4>
        <?php if (!empty($reviewresult->reviewresultdetail)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Questionid') ?></th>
                <th scope="col"><?= __('Reviewresult Id') ?></th>
                <th scope="col"><?= __('Mark') ?></th>
                <th scope="col"><?= __('IsDeleted') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($reviewresult->reviewresultdetail as $reviewresultdetail): ?>
            <tr>
                <td><?= h($reviewresultdetail->id) ?></td>
                <td><?= h($reviewresultdetail->questionid) ?></td>
                <td><?= h($reviewresultdetail->reviewresult_id) ?></td>
                <td><?= h($reviewresultdetail->mark) ?></td>
                <td><?= h($reviewresultdetail->isDeleted) ?></td>
                <td><?= h($reviewresultdetail->created) ?></td>
                <td><?= h($reviewresultdetail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Reviewresultdetail', 'action' => 'view', $reviewresultdetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Reviewresultdetail', 'action' => 'edit', $reviewresultdetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reviewresultdetail', 'action' => 'delete', $reviewresultdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reviewresultdetail->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
