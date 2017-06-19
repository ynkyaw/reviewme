<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrganizationreviewsresultsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrganizationreviewsresultsTable Test Case
 */
class OrganizationreviewsresultsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrganizationreviewsresultsTable
     */
    public $Organizationreviewsresults;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.organizationreviewsresults',
        'app.organizationreviews',
        'app.reviewtypes',
        'app.owners',
        'app.organizationreviewsresultdetail'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Organizationreviewsresults') ? [] : ['className' => 'App\Model\Table\OrganizationreviewsresultsTable'];
        $this->Organizationreviewsresults = TableRegistry::get('Organizationreviewsresults', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Organizationreviewsresults);

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
