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
        <li><?= $this->Html->link(__('List Configurations'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="configurations form large-9 medium-8 columns content">
<dl>
	<dt><?= $configuration->full_name;?></dt>
	<dd><?= $configuration->description;?></dd>
</dl>
    <?= $this->Form->create($configuration) ?>
        <?php
        if($configuration->type=='number') echo $this->Form->input('value',['type'=>'number','label'=>$configuration->full_name]);
        elseif($configuration->type=='select') echo $this->Form->input('value',['options'=>$configuration->options_array,'label'=>$configuration->full_name]);
        elseif($configuration->type=='boolean') echo $this->Form->input('value',['type'=>'checkbox','label'=>$configuration->full_name]);
        else echo $this->Form->input('value',['label'=>$configuration->full_name]);
        ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
