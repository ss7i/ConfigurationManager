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
namespace Uskur\ConfigurationManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;


/**
 * Configurations Model
 *
 * @method \Uskur\ConfigurationManager\Model\Entity\Configuration get($primaryKey, $options = [])
 * @method \Uskur\ConfigurationManager\Model\Entity\Configuration newEntity($data = null, array $options = [])
 * @method \Uskur\ConfigurationManager\Model\Entity\Configuration[] newEntities(array $data, array $options = [])
 * @method \Uskur\ConfigurationManager\Model\Entity\Configuration|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Uskur\ConfigurationManager\Model\Entity\Configuration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Uskur\ConfigurationManager\Model\Entity\Configuration[] patchEntities($entities, array $data, array $options = [])
 * @method \Uskur\ConfigurationManager\Model\Entity\Configuration findOrCreate($search, callable $callback = null)
 */
class ConfigurationsTable extends Table
{
	public $types = ['text','select','boolean','number','array'];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('configurations');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
        	->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('value');

        $validator
            ->boolean('editable')
            ->requirePresence('editable', 'create')
            ->notEmpty('editable');

        $validator
            ->allowEmpty('description');

        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->allowEmpty('options');

        $validator
            ->allowEmpty('default_value');

        return $validator;
    }
    
    public function install()
    {
    	$defaults = Configure::read('ConfigurationManager.defaults');
    	foreach($defaults as $default){
    		$configuration = $this->find('all', [
    			'conditions' => [
    				'category' => $default['category'],
    				'name' => $default['name']
    			]
    		])->first();
    		if (!$configuration) {
    			$configuration = $this->newEntity($default);
    			$configuration->set('options',$default['options']);
    		}
    		else{
    			$configuration->description = $default['description'];
    			$configuration->options = $default['options'];
    			$configuration->default_value = $default['default_value'];
    			$configuration->type = $default['type'];
    			$configuration->editable = $default['editable'];
    		}
    		$this->save($configuration);
    	}
    }
    
    public function init($host = null){
    	$configurations = $this->find('all');
    	if($configurations->count()==0) $this->install();
    	$configurations = $this->find('all');
    	foreach($configurations as $configuration){
    		Configure::write($configuration->full_name,$configuration->value);
    	}
    	$host = empty($host)?configFileName():$host;
    	
    	Configure::dump($host,'default',Configure::read('ConfigurationManager.categories'));
    }
    
    public function afterSave($event, $entity, $options){
    	$this->init();
    	return true;
    }
    
    public function beforeSave($event, $entity, $options)
    {
    	//set default value to value if it is a new entity and value is empty
    	if($entity->isNew() && empty($entity->value) && !is_numeric($entity->value)){
    		$entity->value = $entity->default_value;
    	}
    	return true;
    }
}
