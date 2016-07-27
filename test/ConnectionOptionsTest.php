<?php
namespace Stan\Test;
use Stan\ConnectionOptions;
/**
 * Class ConnectionOptionsTest
 */
class ConnectionOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Connection Options getters and setters.
     *
     * @return void
     */
    public function testSettersAndGetters()
    {
        $options = new ConnectionOptions();
        $options
            ->setHost('host')
            ->setPort(4222)
            ->setVersion('version');
        $this->assertEquals('host', $options->getHost());
        $this->assertEquals(4222, $options->getPort());
        $this->assertEquals('version', $options->getVersion());
    }
    /**
     * Tests Connection Options getters and setters without setting user and password.
     *
     * @return void
     */
    public function testSettersAndGettersWithoutCredentials()
    {
        $options = new ConnectionOptions();
        $options
            ->setHost('host')
            ->setPort(4222)
            ->setVersion('version');
        $this->assertEquals('host', $options->getHost());
        $this->assertEquals(4222, $options->getPort());
        $this->assertEquals('version', $options->getVersion());
    }
    /**
     * Test string representation of ConnectionOptions.
     *
     * @return void

    public function testStringRepresentation()
    {
        $options = new ConnectionOptions();
        $this->assertEquals("{\"version\":\"0.8.0\"}", $options->__toString());
    }*/
}