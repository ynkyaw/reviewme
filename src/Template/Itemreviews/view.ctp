<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Itemreview'), ['action' => 'edit', $itemreview->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Itemreview'), ['action' => 'delete', $itemreview->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemreview->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Itemreviews'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Itemreview'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Question'), ['controller' => 'Question', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Question', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemreviews view large-9 medium-8 columns content">
    <h3><?= h($itemreview->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($itemreview->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Goal') ?></th>
            <td><?= h($itemreview->goal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($itemreview->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemreview->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reviewtype Id') ?></th>
            <td><?= $this->Number->format($itemreview->reviewtype_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Owner Id') ?></th>
            <td><?= $this->Number->format($itemreview->owner_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Startdate') ?></th>
            <td><?= h($itemreview->startdate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Enddate') ?></th>
            <td><?= h($itemreview->enddate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($itemreview->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($itemreview->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isdeleted') ?></th>
            <td><?= $itemreview->isdeleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Question') ?></h4>
        <?php if (!empty($itemreview->question)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Questiontypeid') ?></th>
                <th scope="col"><?= __('Questionname') ?></th>
                <th scope="col"><?= __('Questionnameeng') ?></th>
                <th scope="col"><?= __('Questiontype') ?></th>
                <th scope="col"><?= __('Questionweight') ?></th>
                <th scope="col"><?= __('Isactive') ?></th>
                <th scope="col"><?= __('Isdeleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($itemreview->question as $question): ?>
            <tr>
                <td><?= h($question->id) ?></td>
                <td><?= h($question->questiontypeid) ?></td>
                <td><?= h($question->questionname) ?></td>
                <td><?= h($question->questionnameeng) ?></td>
                <td><?= h($question->questiontype) ?></td>
                <td><?= h($question->questionweight) ?></td>
                <td><?= h($question->isactive) ?></td>
                <td><?= h($question->isdeleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Question', 'action' => 'view', $question->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Question', 'action' => 'edit', $question->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Question', 'action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
