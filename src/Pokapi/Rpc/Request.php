<?php
namespace Pokapi\Rpc;
use POGOProtos\Networking\Requests\RequestType;
use Protobuf\AbstractMessage;

/**
 * Base Rpc Request object
 *
 * @package Pokapi\Rpc
 * @author Freek Post <freek@kobalt.blue>
 */
abstract class Request
{

    /**
     * @var string
     */
    protected $data;

    /**
     * Get the type
     *
     * @return RequestType
     */
    abstract public function getType() : RequestType;

    /**
     * Get an optional message
     *
     * @return AbstractMessage|null
     */
    abstract public function getMessage();

    /**
     * Get the response
     *
     * @param string $data
     *
     * @return AbstractMessage|null
     */
    abstract public function getResponse(string $data);

    /**
     * Converts Rpc Request to protobuf request
     *
     * @return \POGOProtos\Networking\Requests\Request
     */
    public function toProtobufRequest()
    {
        $request = new \POGOProtos\Networking\Requests\Request();
        $request->setRequestType($this->getType());

        if (($message = $this->getMessage()) !== null) {
            $request->setRequestMessage($message->toStream());
        }

        return $request;
    }
}
