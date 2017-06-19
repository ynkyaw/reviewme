<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrganizationreviewsresultdetailTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrganizationreviewsresultdetailTable Test Case
 */
class OrganizationreviewsresultdetailTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrganizationreviewsresultdetailTable
     */
    public $Organizationreviewsresultdetail;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.organizationreviewsresultdetail',
        'app.organizationreviewsresults',
        'app.organizationreviews',
        'app.reviewtype',
        'app.review',
        'app.employee',
        'app.rank',
        'app.employee',
        'app.department',
        'app.organizationreviews_reviewees',
        'app.department',
        'app.department_organizationreviews_reviewees',
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
        'app.organizationreviews_reviewers',
        'app.employee_organizationreviews_reviewers',
        'app.reviewresult_reviewer',
        'app.reviewresult_reviewee',
        'app.itemreviewsresult',
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
        'app.itemreviewsresultdetail',
        'app.user',
        'app.reviewcategory',
        'app.review',
        'app.users',
        'app.role',
        'app.menu',
        'app.headermenu',
        'app.role',
        'app.role_menu',
        'app.reviewcategory_question',
        'app.reviewcategory',
        'app.reviewcategory_reviewer',
        'app.organizationreviews_question'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Organizationreviewsresultdetail') ? [] : ['className' => 'App\Model\Table\OrganizationreviewsresultdetailTable'];
        $this->Organizationreviewsresultdetail = TableRegistry::get('Organizationreviewsresultdetail', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Organizationreviewsresultdetail);

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
