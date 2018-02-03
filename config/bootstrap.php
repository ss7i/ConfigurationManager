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
    $hostname = 'CLI';
	if(!isset($_SERVER['SERVER_NAME'])) {
		$hostname = Configure::read('Server.hostname');
		if(empty($hostname)){
		    foreach($_SERVER['argv'] as $key=>$value) {
		        if(strpos($value, '--host') === 0) {
		            $hostname = str_replace('--host=', '', $value);
		            unset($_SERVER['argv'][$key]);
		        }
		    }
		}
	}
	else{
		$hostname = $_SERVER['SERVER_NAME'];
	}
	
	return str_replace('.', '_', $hostname);
}

try {
    $fileName = configFileName();
	Configure::load($fileName);
} catch (\Exception $e) {
    echo "Could not load config for ".$fileName;
    //@todo init here
}
