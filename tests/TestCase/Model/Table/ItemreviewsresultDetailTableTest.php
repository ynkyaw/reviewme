<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemreviewsresultdetailTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemreviewsresultdetailTable Test Case
 */
class ItemreviewsresultdetailTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemreviewsresultdetailTable
     */
    public $Itemreviewsresultdetail;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.itemreviewsresultdetail',
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
        'app.itemreviewsresultdetail',
        'app.question',
        'app.questioncategory',
        'app.question',
        'app.subcategory',
        'app.question_review',
        'app.review_question',
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
        $config = TableRegistry::exists('Itemreviewsresultdetail') ? [] : ['className' => 'App\Model\Table\ItemreviewsresultdetailTable'];
        $this->Itemreviewsresultdetail = TableRegistry::get('Itemreviewsresultdetail', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Itemreviewsresultdetail);

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
