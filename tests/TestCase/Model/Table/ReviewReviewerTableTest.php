<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReviewReviewerTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReviewReviewerTable Test Case
 */
class ReviewReviewerTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReviewReviewerTable
     */
    public $ReviewReviewer;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.review_reviewer'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReviewReviewer') ? [] : ['className' => 'App\Model\Table\ReviewReviewerTable'];
        $this->ReviewReviewer = TableRegistry::get('ReviewReviewer', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReviewReviewer);

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
