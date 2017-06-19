<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Review'), ['action' => 'edit', $review->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Review'), ['action' => 'delete', $review->id], ['confirm' => __('Are you sure you want to delete # {0}?', $review->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Review'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Review'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Question'), ['controller' => 'Question', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Question', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="review view large-9 medium-8 columns content">
    <h3><?= h($review->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($review->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Goal') ?></th>
            <td><?= h($review->goal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($review->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($review->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reviewtypeid') ?></th>
            <td><?= $this->Number->format($review->reviewtypeid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ownerid') ?></th>
            <td><?= $this->Number->format($review->ownerid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Maxreview') ?></th>
            <td><?= $this->Number->format($review->maxreview) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Maxreviewed') ?></th>
            <td><?= $this->Number->format($review->maxreviewed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Minreview') ?></th>
            <td><?= $this->Number->format($review->minreview) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Startdate') ?></th>
            <td><?= h($review->startdate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Enddate') ?></th>
            <td><?= h($review->enddate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($review->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($review->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isdeleted') ?></th>
            <td><?= $review->isdeleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Question') ?></h4>
        <?php if (!empty($review->question)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Questiontypeid') ?></th>
                <th scope="col"><?= __('Questionname') ?></th>
                <th scope="col"><?= __('Questionweight') ?></th>
                <th scope="col"><?= __('Isactive') ?></th>
                <th scope="col"><?= __('Isdeleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($review->question as $question): ?>
            <tr>
                <td><?= h($question->id) ?></td>
                <td><?= h($question->questiontypeid) ?></td>
                <td><?= h($question->questionname) ?></td>
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
