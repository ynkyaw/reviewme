<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemreviewsresultsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemreviewsresultsTable Test Case
 */
class ItemreviewsresultsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemreviewsresultsTable
     */
    public $Itemreviewsresults;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.itemreviewsresults',
        'app.itemreviews',
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
        'app.itemreviewsresult',
        'app.products',
        'app.itemreviews_reviewees',
        'app.itemreviews_reviewees_products',
        'app.itemreviewsresults',
        'app.itemreviewsresultdetail',
        'app.question',
        'app.questioncategory',
        'app.question',
        'app.subcategory',
        'app.question_review',
        'app.review_question',
        'app.itemreviewsresultdetail',
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
        'app.itemreviews_reviewers',
        'app.itemreviews_itemreviews_reviewers',
        'app.employee_itemreviews_reviewers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Itemreviewsresults') ? [] : ['className' => 'App\Model\Table\ItemreviewsresultsTable'];
        $this->Itemreviewsresults = TableRegistry::get('Itemreviewsresults', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Itemreviewsresults);

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
