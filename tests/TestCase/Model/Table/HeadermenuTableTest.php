<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HeadermenuTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HeadermenuTable Test Case
 */
class HeadermenuTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HeadermenuTable
     */
    public $Headermenu;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.headermenu'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Headermenu') ? [] : ['className' => 'App\Model\Table\HeadermenuTable'];
        $this->Headermenu = TableRegistry::get('Headermenu', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Headermenu);

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
