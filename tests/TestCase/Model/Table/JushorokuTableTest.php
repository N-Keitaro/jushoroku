<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JushorokuTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JushorokuTable Test Case
 */
class JushorokuTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\JushorokuTable
     */
    public $Jushoroku;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Jushoroku',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Jushoroku') ? [] : ['className' => JushorokuTable::class];
        $this->Jushoroku = TableRegistry::getTableLocator()->get('Jushoroku', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Jushoroku);

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
