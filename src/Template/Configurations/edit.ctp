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
$this->Html->script('Uskur/ConfigurationManager.jsoneditor.min.js', [
    'block' => 'script'
]);
$this->Html->css('Uskur/ConfigurationManager.jsoneditor.min.css', [
    'block' => 'css'
]);

?>
<div class="row">
<nav class="large-3 medium-4 columns col-lg-4" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Configurations'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="configurations form large-9 medium-8 columns content col col-lg-8">
<dl>
	<dt><?= $configuration->full_name;?></dt>
	<dd><?= $configuration->description;?></dd>
</dl>
    <?= $this->Form->create($configuration,['id'=>'configuration']) ?>
        <?php
        if($configuration->type=='number') echo $this->Form->input('value',['type'=>'number','label'=>$configuration->full_name]);
        elseif($configuration->type=='select') echo $this->Form->input('value',['options'=>$configuration->options_array,'label'=>$configuration->full_name]);
        elseif($configuration->type=='boolean') echo $this->Form->input('value',['type'=>'checkbox','label'=>$configuration->full_name]);
        elseif($configuration->type=='json'){
            echo $this->Form->input('value',['type'=>'hidden']);
        }
        else echo $this->Form->input('value',['label'=>$configuration->full_name]);
        ?>
        <?php if($configuration->type =='json'):?>
         <div id="jsoneditor" class="flex mb-4"></div>
         <script type="text/javascript">
            <?php $this->Html->scriptStart(array('block' => 'script')); ?>
            var options = {
            	    mode: 'form',
            	    modes: ['code', 'form', 'tree'], // allowed modes
            	    onError: function (err) {
            	      alert(err.toString());
            	    },
            	    onModeChange: function (newMode, oldMode) {
            	      console.log('Mode switched from', oldMode, 'to', newMode);
            	    }
            	  };
            // create the editor
            var container = document.getElementById("jsoneditor");
            var editor = new JSONEditor(container, options);
            
            // set json
            var json = <?= $configuration->value ?>;
            editor.set(json);
            
            $(function () { 
            	$( "#configuration" ).submit(function() {
            		$( "#value" ).val(editor.getText());
            	});
            
            });
            <?php $this->Html->scriptEnd();?>
            </script>
        <?php endif;?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
