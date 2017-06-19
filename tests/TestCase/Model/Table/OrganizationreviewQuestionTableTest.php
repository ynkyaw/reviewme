<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrganizationreviewQuestionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrganizationreviewQuestionTable Test Case
 */
class OrganizationreviewQuestionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrganizationreviewQuestionTable
     */
    public $OrganizationreviewQuestion;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.organizationreview_question',
        'app.organizationreviews',
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
        $config = TableRegistry::exists('OrganizationreviewQuestion') ? [] : ['className' => 'App\Model\Table\OrganizationreviewQuestionTable'];
        $this->OrganizationreviewQuestion = TableRegistry::get('OrganizationreviewQuestion', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrganizationreviewQuestion);

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
