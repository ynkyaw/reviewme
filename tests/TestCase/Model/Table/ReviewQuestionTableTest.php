<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReviewquestionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReviewquestionTable Test Case
 */
class ReviewquestionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReviewquestionTable
     */
    public $Reviewquestion;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reviewquestion',
        'app.review',
        'app.reviewtype',
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
        'app.reviewresult',
        'app.reviewresultdetail',
        'app.reviewcategory',
        'app.review',
        'app.reviewees',
        'app.reviewers',
        'app.question',
        'app.questioncategory',
        'app.question',
        'app.question_review',
        'app.review_question',
        'app.review_review_question',
        'app.question_review_question',
        'app.users',
        'app.role',
        'app.users',
        'app.reviewcategory_question',
        'app.reviewcategory_reviewer'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Reviewquestion') ? [] : ['className' => 'App\Model\Table\ReviewquestionTable'];
        $this->Reviewquestion = TableRegistry::get('Reviewquestion', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Reviewquestion);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
