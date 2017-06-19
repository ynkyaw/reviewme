<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Townships'), ['controller' => 'Townships', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Township'), ['controller' => 'Townships', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Department'), ['controller' => 'Department', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Department', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Organizationreviews'), ['controller' => 'Organizationreviews', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Organizationreview'), ['controller' => 'Organizationreviews', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companies form large-9 medium-8 columns content">
    <?= $this->Form->create($company) ?>
    <fieldset>
        <legend><?= __('Add Company') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('industry');
            echo $this->Form->input('adderssline1');
            echo $this->Form->input('addressline2');
            echo $this->Form->input('township_id', ['options' => $townships]);
            echo $this->Form->input('website');
            echo $this->Form->input('fax');
            echo $this->Form->input('phone');
            echo $this->Form->input('email');
            echo $this->Form->input('isdeleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
