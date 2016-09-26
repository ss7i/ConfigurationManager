<?php
namespace Uskur\ConfigurationManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Uskur\ConfigurationManager\Model\Table\ConfigurationsTable;

/**
 * Uskur\ConfigurationManager\Model\Table\ConfigurationsTable Test Case
 */
class ConfigurationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Uskur\ConfigurationManager\Model\Table\ConfigurationsTable
     */
    public $Configurations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.configuration_manager.configurations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Configurations') ? [] : ['className' => 'Uskur\ConfigurationManager\Model\Table\ConfigurationsTable'];
        $this->Configurations = TableRegistry::get('Configurations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Configurations);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
