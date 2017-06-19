<?php
/**
  * @var \App\View\AppView $this
  */
//echo $reviewresult;

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Reviewresult'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reviewresultdetail'), ['controller' => 'Reviewresultdetail', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reviewresultdetail'), ['controller' => 'Reviewresultdetail', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reviewresult index large-9 medium-8 columns content">
    <h3><?= __('Reviewresult') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reviewid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reviewerid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('revieweeid') ?></th>
                <!-- <th scope="col"><?= $this->Paginator->sort('IsDeleted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th> -->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reviewresult as $reviewresult): ?>
            <tr>
                <td><?= $this->Number->format($reviewresult->id) ?></td>
                <td><?= $this->Number->format($reviewresult->reviewid) ?></td>
                <td><?= $this->Number->format($reviewresult->reviewerid) ?></td>
                <td><?= $this->Number->format($reviewresult->revieweeid) ?></td>
               <!--  <td><?= h($reviewresult->IsDeleted) ?></td>
                <td><?= h($reviewresult->created) ?></td>
                <td><?= h($reviewresult->modified) ?></td> -->
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $reviewresult->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reviewresult->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reviewresult->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reviewresult->id),'style'=>'color:red']) ?>
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
