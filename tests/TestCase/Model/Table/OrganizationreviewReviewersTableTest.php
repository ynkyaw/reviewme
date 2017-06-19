<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrganizationreviewReviewersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrganizationreviewReviewersTable Test Case
 */
class OrganizationreviewReviewersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrganizationreviewReviewersTable
     */
    public $OrganizationreviewReviewers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.organizationreview_reviewers',
        'app.organizationreviews'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('OrganizationreviewReviewers') ? [] : ['className' => 'App\Model\Table\OrganizationreviewReviewersTable'];
        $this->OrganizationreviewReviewers = TableRegistry::get('OrganizationreviewReviewers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrganizationreviewReviewers);

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
