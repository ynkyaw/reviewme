<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrganizationreviewRevieweesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrganizationreviewRevieweesTable Test Case
 */
class OrganizationreviewRevieweesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrganizationreviewRevieweesTable
     */
    public $OrganizationreviewReviewees;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.organizationreview_reviewees',
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
        $config = TableRegistry::exists('OrganizationreviewReviewees') ? [] : ['className' => 'App\Model\Table\OrganizationreviewRevieweesTable'];
        $this->OrganizationreviewReviewees = TableRegistry::get('OrganizationreviewReviewees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrganizationreviewReviewees);

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
