<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ProductsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ProductsController Test Case
 */
class ProductsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.products',
        'app.itemreviews_reviewees',
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
        'app.itemreviewsresultdetail',
        'app.itemreviewsresults',
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
        'app.employee_itemreviews_reviewers',
        'app.itemreviews_reviewees_products',
        'app.itemreviewsresults'
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