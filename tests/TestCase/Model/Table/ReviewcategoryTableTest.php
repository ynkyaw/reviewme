<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReviewcategoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReviewcategoryTable Test Case
 */
class ReviewcategoryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReviewcategoryTable
     */
    public $Reviewcategory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reviewcategory',
        'app.reviewees',
        'app.review_reviewees'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Reviewcategory') ? [] : ['className' => 'App\Model\Table\ReviewcategoryTable'];
        $this->Reviewcategory = TableRegistry::get('Reviewcategory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Reviewcategory);

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
