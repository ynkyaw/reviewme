<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemreviewsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemreviewsTable Test Case
 */
class ItemreviewsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemreviewsTable
     */
    public $Itemreviews;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.itemreviews',
        'app.reviewtypes',
        'app.owners',
        'app.question',
        'app.questioncategory',
        'app.question',
        'app.question_review',
        'app.review_question',
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
        'app.reviewresult_reviewer',
        'app.reviewresult_reviewee',
        'app.reviewcategory',
        'app.review',
        'app.reviewees',
        'app.reviewers',
        'app.users',
        'app.role',
        'app.users',
        'app.reviewcategory_question',
        'app.reviewcategory',
        'app.reviewcategory_reviewer',
        'app.itemreviews_question',
        'app.questions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Itemreviews') ? [] : ['className' => 'App\Model\Table\ItemreviewsTable'];
        $this->Itemreviews = TableRegistry::get('Itemreviews', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Itemreviews);

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
