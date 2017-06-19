<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployeeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployeeTable Test Case
 */
class EmployeeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmployeeTable
     */
    public $Employee;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.employee'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Employee') ? [] : ['className' => 'App\Model\Table\EmployeeTable'];
        $this->Employee = TableRegistry::get('Employee', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Employee);

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
