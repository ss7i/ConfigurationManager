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
use Cake\Core\Exception\MissingPluginException;
use Cake\Core\Plugin;
use Cake\Event\EventManager;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

Configure::load('Uskur/ConfigurationManager.config');

function configFileName(){
	if(!isset($_SERVER['SERVER_NAME'])) {
		$hostname = Configure::read('Server.hostname');
		if(empty($hostname)) return "CLI";
	}
	else{
		$hostname = $_SERVER['SERVER_NAME'];
	}
	return $configFile = str_replace('.', '_', $hostname);
}

try {
	Configure::load(configFileName());
} catch (\Exception $e) {
	//@todo init here
}
