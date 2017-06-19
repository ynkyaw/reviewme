<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RankTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RankTable Test Case
 */
class RankTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RankTable
     */
    public $Rank;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rank'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Rank') ? [] : ['className' => 'App\Model\Table\RankTable'];
        $this->Rank = TableRegistry::get('Rank', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Rank);

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
