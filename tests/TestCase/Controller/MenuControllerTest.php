<?php
namespace App\Test\TestCase\Controller;

use App\Controller\MenuController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\MenuController Test Case
 */
class MenuControllerTest extends IntegrationTestCase
{

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
        'app.review',
        'app.reviewcategory',
        'app.reviewcategory_question',
        'app.reviewcategory',
        'app.reviewcategory_reviewer',
        'app.reviewees',
        'app.itemreviews_reviewees',
        'app.products',
        'app.itemreviewsresults',
        'app.itemreviewsresultdetail',
        'app.itemreviewsresults',
        'app.itemreviews_reviewees_products',
        'app.review_reviewee',
        'app.employee_review_reviewee',
        'app.reviewee_review',
        'app.reviewers',
        'app.itemreviews_reviewers',
        'app.itemreviews_itemreviews_reviewers',
        'app.employee_itemreviews_reviewers',
        'app.users',
        'app.review_review_reviewer',
        'app.employee_review_reviewer',
        'app.reviewresult_reviewer',
        'app.reviewresult_reviewee',
        'app.itemreviewsresult',
        'app.itemreviewsresultdetail',
        'app.user',
        'app.role_menu'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
