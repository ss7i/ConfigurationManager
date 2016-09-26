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
namespace Uskur\ConfigurationManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Configuration Entity
 *
 * @property string $id
 * @property string $category
 * @property string $name
 * @property string $value
 * @property bool $editable
 * @property string $description
 * @property string $type
 * @property string $options
 * @property string $default_value
 */
class Configuration extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
    
    protected function _setOptions($options)
    {
    	if(is_array($options)) return json_encode($options);
    	return $options;
    }
    
    protected function _getOptionsArray()
    {
    	if(!empty($this->_properties['options'])) return json_decode($this->_properties['options'],true);
    	return $this->_properties['options'];
    }
    
    protected function _getDisplayValue()
    {
    	if(!empty($this->_properties['options'])){
    		return $this->optionsArray[$this->_properties['value']];
    	}
    	return $this->_properties['value'];
    }
    
    protected function _getFullName()
    {
    	return "{$this->_properties['category']}.{$this->_properties['name']}";
    }
}
