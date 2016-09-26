<?php
/**
 * Uskur
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Uskur (http://uskur.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Install'), ['action' => 'install']) ?></li>
        <li><?= $this->Html->link(__('New Configuration'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="row collapse">
<?= $this->Form->create(null,['type'=>'get']) ?>
	<div class="form large-3 columns">
		<?php echo $this->Form->input('category',['label'=>false]);?>
	</div>
	<div class="form large-3 columns">
		<?php echo $this->Form->input('name',['label'=>false,'placeholder'=>'name']);?>
	</div>
	<div class="form large-3 columns">
		<?= $this->Form->button(__('Search')) ?>
	</div>
<?= $this->Form->end() ?>
</div>
<div class="row">
<div class="configurations index large-9 medium-8 columns content">
    <h3><?= __('Configurations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('value') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($configurations as $configuration): ?>
            <tr>
                <td><?= h($configuration->category) ?></td>
                <td><?= h($configuration->name) ?></td>
                <td><?= h($configuration->displayValue) ?></td>
                <td><?= h($configuration->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $configuration->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
</div>