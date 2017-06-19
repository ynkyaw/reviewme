<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemreviewsresultTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemreviewsresultTable Test Case
 */
class ItemreviewsresultTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemreviewsresultTable
     */
    public $Itemreviewsresult;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.itemreviewsresult',
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
        'app.reviewcategory',
        'app.review',
        'app.reviewees',
        'app.reviewers',
        'app.question',
        'app.questioncategory',
        'app.question',
        'app.subcategory',
        'app.question_review',
        'app.review_question',
        'app.users',
        'app.role',
        'app.users',
        'app.reviewcategory_question',
        'app.reviewcategory',
        'app.reviewcategory_reviewer',
        'app.itemreviews_question',
        'app.itemreviews_reviewers',
        'app.itemreviews_itemreviews_reviewers',
        'app.itemreviews_reviewees',
        'app.product',
        'app.itemreviewsresults',
        'app.itemreviews_reviewees_product',
        'app.itemreviewsresult_detail',
        'app.itemreviewsresults'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Itemreviewsresult') ? [] : ['className' => 'App\Model\Table\ItemreviewsresultTable'];
        $this->Itemreviewsresult = TableRegistry::get('Itemreviewsresult', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Itemreviewsresult);

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
