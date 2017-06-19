<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductTable Test Case
 */
class ProductTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductTable
     */
    public $Product;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.product'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Product') ? [] : ['className' => 'App\Model\Table\ProductTable'];
        $this->Product = TableRegistry::get('Product', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Product);

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
