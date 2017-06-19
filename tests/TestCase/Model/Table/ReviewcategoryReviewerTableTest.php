<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReviewcategoryReviewerTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReviewcategoryReviewerTable Test Case
 */
class ReviewcategoryReviewerTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReviewcategoryReviewerTable
     */
    public $ReviewcategoryReviewer;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reviewcategory_reviewer',
        'app.reviewcategory',
        'app.review',
        'app.reviewtype',
        'app.review',
        'app.employee',
        'app.rank',
        'app.employee',
        'app.department',
        'app.jobposition',
        'app.employee_group',
        'app.employees_employeegroups',
        'app.employee_employeegroup',
        'app.employeegroup',
        'app.reviewer_review',
        'app.review_reviewer',
        'app.review_review_reviewer',
        'app.employee_review_reviewer',
        'app.reviewee_review',
        'app.review_reviewee',
        'app.employee_review_reviewee',
        'app.reviewresult_reviewer',
        'app.reviewresult_reviewee',
        'app.reviewcategory',
        'app.question',
        'app.questioncategory',
        'app.question',
        'app.question_review',
        'app.review_question',
        'app.reviewcategory_question',
        'app.reviewees',
        'app.reviewers',
        'app.users',
        'app.role',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReviewcategoryReviewer') ? [] : ['className' => 'App\Model\Table\ReviewcategoryReviewerTable'];
        $this->ReviewcategoryReviewer = TableRegistry::get('ReviewcategoryReviewer', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReviewcategoryReviewer);

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
