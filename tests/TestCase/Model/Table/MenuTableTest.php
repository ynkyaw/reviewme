<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MenuTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MenuTable Test Case
 */
class MenuTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MenuTable
     */
    public $Menu;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.menu',
        'app.role',
        'app.users',
        'app.role',
        'app.employee',
        'app.rank',
        'app.department',
        'app.jobposition',
        'app.employee_group',
        'app.employee',
        'app.employee_employeegroup',
        'app.employeegroup',
        'app.employees_employeegroups',
        'app.reviewer_review',
        'app.review_reviewer',
        'app.review',
        'app.reviewtype',
        'app.itemreviews',
        'app.question',
        'app.questioncategory',
        'app.question',
        'app.subcategory',
        'app.question_review',
        'app.review_question',
        'app.itemreviews_question',
        'app.reviewers',
        'app.itemreviews_reviewers',
        'app.itemreviews_itemreviews_reviewers',
        'app.employee_itemreviews_reviewers',
        'app.reviewees',
        'app.itemreviews_reviewees',
        'app.products',
        'app.itemreviewsresults',
        'app.itemreviewsresultdetail',
        'app.itemreviewsresults',
        'app.itemreviews_reviewees_products',
        'app.reviewcategory',
        'app.review',
        'app.review_reviewee',
        'app.employee_review_reviewee',
        'app.users',
        'app.reviewcategory_question',
        'app.reviewcategory',
        'app.reviewcategory_reviewer',
        'app.review_review_reviewer',
        'app.employee_review_reviewer',
        'app.reviewee_review',
        'app.reviewresult_reviewer',
        'app.reviewresult_reviewee',
        'app.itemreviewsresult',
        'app.itemreviewsresultdetail',
        'app.user',
        'app.role_menu'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Menu') ? [] : ['className' => 'App\Model\Table\MenuTable'];
        $this->Menu = TableRegistry::get('Menu', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Menu);

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
