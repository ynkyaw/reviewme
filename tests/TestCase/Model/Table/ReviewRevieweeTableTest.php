<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReviewRevieweeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReviewRevieweeTable Test Case
 */
class ReviewRevieweeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReviewRevieweeTable
     */
    public $ReviewReviewee;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.review_reviewee'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReviewReviewee') ? [] : ['className' => 'App\Model\Table\ReviewRevieweeTable'];
        $this->ReviewReviewee = TableRegistry::get('ReviewReviewee', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReviewReviewee);

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
