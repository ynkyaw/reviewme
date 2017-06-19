<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoleMenuTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoleMenuTable Test Case
 */
class RoleMenuTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoleMenuTable
     */
    public $RoleMenu;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.role_menu',
        'app.role',
        'app.menu',
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
        $config = TableRegistry::exists('RoleMenu') ? [] : ['className' => 'App\Model\Table\RoleMenuTable'];
        $this->RoleMenu = TableRegistry::get('RoleMenu', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoleMenu);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
