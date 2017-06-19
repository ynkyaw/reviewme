<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuestiontypeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuestiontypeTable Test Case
 */
class QuestiontypeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QuestiontypeTable
     */
    public $Questiontype;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.questiontype'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Questiontype') ? [] : ['className' => 'App\Model\Table\QuestiontypeTable'];
        $this->Questiontype = TableRegistry::get('Questiontype', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Questiontype);

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
