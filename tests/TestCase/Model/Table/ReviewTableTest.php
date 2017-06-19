<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReviewTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReviewTable Test Case
 */
class ReviewTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReviewTable
     */
    public $Review;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.review',
        'app.reviewtypes',
        'app.owners',
        'app.question',
        'app.questioncategory',
        'app.question',
        'app.review_question'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Review') ? [] : ['className' => 'App\Model\Table\ReviewTable'];
        $this->Review = TableRegistry::get('Review', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Review);

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
