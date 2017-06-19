<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemreviewsQuestionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemreviewsQuestionTable Test Case
 */
class ItemreviewsQuestionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemreviewsQuestionTable
     */
    public $ItemreviewsQuestion;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.itemreviews_question',
        'app.itemreviews',
        'app.questions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemreviewsQuestion') ? [] : ['className' => 'App\Model\Table\ItemreviewsQuestionTable'];
        $this->ItemreviewsQuestion = TableRegistry::get('ItemreviewsQuestion', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemreviewsQuestion);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
