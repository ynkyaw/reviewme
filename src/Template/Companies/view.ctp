<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Company'), ['action' => 'edit', $company->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Company'), ['action' => 'delete', $company->id], ['confirm' => __('Are you sure you want to delete # {0}?', $company->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Townships'), ['controller' => 'Townships', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Township'), ['controller' => 'Townships', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Department'), ['controller' => 'Department', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Department', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organizationreviews'), ['controller' => 'Organizationreviews', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organizationreview'), ['controller' => 'Organizationreviews', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="companies view large-9 medium-8 columns content">
    <h3><?= h($company->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($company->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Industry') ?></th>
            <td><?= h($company->industry) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adderssline1') ?></th>
            <td><?= h($company->adderssline1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Addressline2') ?></th>
            <td><?= h($company->addressline2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Township') ?></th>
            <td><?= $company->has('township') ? $this->Html->link($company->township->name, ['controller' => 'Townships', 'action' => 'view', $company->township->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Website') ?></th>
            <td><?= h($company->website) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fax') ?></th>
            <td><?= h($company->fax) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($company->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($company->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($company->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isdeleted') ?></th>
            <td><?= $company->isdeleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Department') ?></h4>
        <?php if (!empty($company->department)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Organization Id') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Departmentname') ?></th>
                <th scope="col"><?= __('Isdeleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->department as $department): ?>
            <tr>
                <td><?= h($department->id) ?></td>
                <td><?= h($department->organization_id) ?></td>
                <td><?= h($department->company_id) ?></td>
                <td><?= h($department->departmentname) ?></td>
                <td><?= h($department->isdeleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Department', 'action' => 'view', $department->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Department', 'action' => 'edit', $department->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Department', 'action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Organizationreviews') ?></h4>
        <?php if (!empty($company->organizationreviews)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Goal') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Startdate') ?></th>
                <th scope="col"><?= __('Enddate') ?></th>
                <th scope="col"><?= __('Isdeleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->organizationreviews as $organizationreviews): ?>
            <tr>
                <td><?= h($organizationreviews->id) ?></td>
                <td><?= h($organizationreviews->company_id) ?></td>
                <td><?= h($organizationreviews->title) ?></td>
                <td><?= h($organizationreviews->goal) ?></td>
                <td><?= h($organizationreviews->employee_id) ?></td>
                <td><?= h($organizationreviews->startdate) ?></td>
                <td><?= h($organizationreviews->enddate) ?></td>
                <td><?= h($organizationreviews->isdeleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Organizationreviews', 'action' => 'view', $organizationreviews->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Organizationreviews', 'action' => 'edit', $organizationreviews->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Organizationreviews', 'action' => 'delete', $organizationreviews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organizationreviews->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Products') ?></h4>
        <?php if (!empty($company->products)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Organization Id') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Isdeleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->products as $products): ?>
            <tr>
                <td><?= h($products->id) ?></td>
                <td><?= h($products->organization_id) ?></td>
                <td><?= h($products->company_id) ?></td>
                <td><?= h($products->name) ?></td>
                <td><?= h($products->description) ?></td>
                <td><?= h($products->isdeleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
