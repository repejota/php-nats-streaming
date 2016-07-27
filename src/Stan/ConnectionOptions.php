<?php
namespace Nats;
/**
 * ConnectionOptions Class.
 */
class ConnectionOptions
{
    /**
     * Hostname or IP to connect.
     *
     * @var string
     */
    private $host = "localhost";

    /**
     * Port number to connect.
     *
     * @var integer
     */
    private $port = 4222;

    /**
     * Version of this client.
     *
     * @var string
     */
    private $version = "0.8.0";

    /**
     * Get the URI for a server.
     *
     * @return string
     */
    public function getAddress()
    {
        return "tcp://" . $this->host . ":" . $this->port;
    }

    /**
     * Get host.
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }
    /**
     * Set host.
     *
     * @param string $host Host.
     *
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }
    /**
     * Get port.
     *
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }
    /**
     * Set port.
     *
     * @param integer $port Port.
     *
     * @return $this
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * Get version.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }
    /**
     * Set version.
     *
     * @param string $version Version number.
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }
}