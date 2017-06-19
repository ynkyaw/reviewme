<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReviewcategoryQuestionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReviewcategoryQuestionTable Test Case
 */
class ReviewcategoryQuestionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReviewcategoryQuestionTable
     */
    public $ReviewcategoryQuestion;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reviewcategory_question',
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
        'app.reviewcategory_reviewer',
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
        $config = TableRegistry::exists('ReviewcategoryQuestion') ? [] : ['className' => 'App\Model\Table\ReviewcategoryQuestionTable'];
        $this->ReviewcategoryQuestion = TableRegistry::get('ReviewcategoryQuestion', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReviewcategoryQuestion);

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
