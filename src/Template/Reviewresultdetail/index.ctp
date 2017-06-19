<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Reviewresultdetail'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reviewresultdetail index large-9 medium-8 columns content">
    <h3><?= __('Reviewresultdetail') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('questionid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reviewresult_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mark') ?></th>
                <th scope="col"><?= $this->Paginator->sort('isDeleted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reviewresultdetail as $reviewresultdetail): ?>
            <tr>
                <td><?= $this->Number->format($reviewresultdetail->id) ?></td>
                <td><?= $this->Number->format($reviewresultdetail->questionid) ?></td>
                <td><?= $this->Number->format($reviewresultdetail->reviewresult_id) ?></td>
                <td><?= $this->Number->format($reviewresultdetail->mark) ?></td>
                <td><?= h($reviewresultdetail->isDeleted) ?></td>
                <td><?= h($reviewresultdetail->created) ?></td>
                <td><?= h($reviewresultdetail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $reviewresultdetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reviewresultdetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reviewresultdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reviewresultdetail->id),'style'=>'color:red']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
