<?php
namespace Stan\tests\Unit;

use Stan;
use Stan\ConnectionOptions;

/**
 * Class ConnectionTest.
 */
class ConnectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Client.
     *
     * @var Stan\Connection Client
     */
    private $c;

    /**
     * SetUp test suite.
     *
     * @return void
     */
    public function setUp()
    {
        $options = new ConnectionOptions();
        $this->c = new Stan\Connection($options);
        $this->c->connect();
    }

    /**
     * Test Connection.
     *
     * @return void
     */
    public function testConnection()
    {
        $this->assertTrue(true);
    }
}