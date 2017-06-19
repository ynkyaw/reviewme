<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JobpositionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JobpositionTable Test Case
 */
class JobpositionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\JobpositionTable
     */
    public $Jobposition;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.jobposition'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Jobposition') ? [] : ['className' => 'App\Model\Table\JobpositionTable'];
        $this->Jobposition = TableRegistry::get('Jobposition', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Jobposition);

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
