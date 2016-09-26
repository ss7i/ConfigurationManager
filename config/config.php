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
use Cake\Core\Configure;

$config = [
    'ConfigurationManager' => [
        //categories to be managed by the ConfigurationManager
        'categories' => ['SampleCategory'],
        //default configuration options to be installed
        'defaults' => [
        	[
        		'category'=>'SampleCategory',
        		'name'=>'samle_text',
        		'type'=>'text',
        		'editable'=>true,
        		'description'=>'Sample text configuration option.',
        		'default_value'=>'test',
        		'options'=>null
        	],
        	[
	        	'category'=>'SampleCategory',
	        	'name'=>'sample_select',
	        	'type'=>'select',
	        	'editable'=>true,
	        	'description'=>'Sample select configuration option.',
	        	'default_value'=>'a',
	        	'options'=>['a'=>'Apple','b'=>'Brownie']
        	],
        	[
	        	'category'=>'SampleCategory',
	        	'name'=>'sample_boolean',
	        	'type'=>'boolean',
	        	'editable'=>true,
	        	'description'=>'Sample boolean configuration option.',
	        	'default_value'=>'1',
	        	'options'=>null
        	],
        	[
	        	'category'=>'SampleCategory',
	        	'name'=>'sample_number',
	        	'type'=>'number',
	        	'editable'=>true,
	        	'description'=>'Sample number configuration option.',
	        	'default_value'=>'10',
	        	'options'=>null
        	],
        	[
	        	'category'=>'SampleCategory',
	        	'name'=>'sample_array',
	        	'type'=>'array',
	        	'editable'=>true,
	        	'description'=>'Sample array configuration option.',
	        	'default_value'=>"{'a'=>'Apple','b'=>'Brownie'}",
	        	'options'=>null
        	]
        ]
    ]
];

return $config;