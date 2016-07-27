<?php
namespace Stan;

/**
 * Connection Class.
 */
class Connection
{
    /**
     * Connection options object.
     *
     * @var ConnectionOptions|null
     */
    private $options = null;


    /**
     * Constructor.
     *
     * @param ConnectionOptions $options Connection options object.
     */
    public function __construct(ConnectionOptions $options = null)
    {
        $this->options = $options;
    }

    /**
     * Sends data thought the stream.
     *
     * @param string $payload Message data.
     *
     * @return void
     */
    private function send($payload)
    {
        $msg = $payload."\r\n";
        fwrite($this->streamSocket, $msg, strlen($msg));
    }

    /**
     * Receives a message thought the stream.
     *
     * @param integer $len Number of bytes to receive.
     *
     * @return string
     */
    private function receive($len = null)
    {
        if ($len) {
            $chunkSize = $this->chunkSize;
            $line = null;
            $receivedBytes = 0;
            while ($receivedBytes < $len) {
                $bytesLeft = $len - $receivedBytes;
                if ($bytesLeft < $this->chunkSize) {
                    $chunkSize = $bytesLeft;
                }
                $readChunk = fread($this->streamSocket, $chunkSize);
                $receivedBytes += strlen($readChunk);
                $line .= $readChunk;
            }
        } else {
            $line = fgets($this->streamSocket);
        }
        return $line;
    }

    /**
     * Returns an stream socket to the desired server.
     *
     * @param string $address Server url string.
     * @param float  $timeout Number of seconds until the connect() system call should timeout.
     *
     * @return resource
     * @throws \Exception Exception raised if connection fails.
     */
    private function getStream($address, $timeout)
    {
        $errno = null;
        $errstr = null;
        $fp = stream_socket_client($address, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT);
        $timeout = number_format($timeout, 3);
        $seconds = floor($timeout);
        $microseconds = ($timeout - $seconds) * 1000;
        stream_set_timeout($fp, $seconds, $microseconds);
        if (!$fp) {
            throw new \Exception($errstr, $errno);
        }
        return $fp;
    }

    /**
     * Connect to server.
     *
     * @param float $timeout Number of seconds until the connect() system call should timeout.
     *
     * @throws \Exception Exception raised if connection fails.
     * @return void
     */
    public function connect($timeout = null)
    {
        if ($timeout === null) {
            $timeout = intval(ini_get('default_socket_timeout'));
        }
        $this->timeout = $timeout;
        $this->streamSocket = $this->getStream($this->options->getAddress(), $timeout);
        //$this->setStreamTimeout($timeout);
        $msg = 'CONNECT '.$this->options;
        $this->send($msg);
        $connect_response = $this->receive();
        if (strpos($connect_response, '-ERR')!== false) {
            throw new \Exception("Failing connection: $connect_response");
        }
    }

    /**
     * @param integer $chunkSize Set byte chunk len to read when reading from wire.
     * @return void
     */
    public function setChunkSize($chunkSize)
    {
        $this->chunkSize = $chunkSize;
    }
    /**
     * Close will close the connection to the server.
     *
     * @return void
     */
    public function close()
    {
        fclose($this->streamSocket);
        $this->streamSocket = null;
    }
    /**
     * @return resource
     */
    public function streamSocket()
    {
        return $this->streamSocket;
    }
}