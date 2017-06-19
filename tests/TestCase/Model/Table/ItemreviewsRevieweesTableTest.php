<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemreviewsRevieweesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemreviewsRevieweesTable Test Case
 */
class ItemreviewsRevieweesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemreviewsRevieweesTable
     */
    public $ItemreviewsReviewees;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.itemreviews_reviewees',
        'app.itemreviews'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemreviewsReviewees') ? [] : ['className' => 'App\Model\Table\ItemreviewsRevieweesTable'];
        $this->ItemreviewsReviewees = TableRegistry::get('ItemreviewsReviewees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemreviewsReviewees);

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
