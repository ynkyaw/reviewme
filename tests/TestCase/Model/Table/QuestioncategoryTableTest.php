<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuestioncategoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuestioncategoryTable Test Case
 */
class QuestioncategoryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QuestioncategoryTable
     */
    public $Questioncategory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.questioncategory'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Questioncategory') ? [] : ['className' => 'App\Model\Table\QuestioncategoryTable'];
        $this->Questioncategory = TableRegistry::get('Questioncategory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Questioncategory);

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
