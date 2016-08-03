<?php
namespace Pokapi\Rpc;

use POGOProtos\Networking\Envelopes\AuthTicket as ProtoAuthTicket;

/**
 * Class AuthTicket
 *
 * @package Pokapi\Rpc
 * @author Freek Post <freek@kobalt.blue>
 */
class AuthTicket
{

    /**
     * @var string
     */
    protected $start;

    /**
     * @var string
     */
    protected $end;

    /**
     * @var int
     */
    protected $expiry;

    /**
     * AuthTicket constructor.
     *
     * @param string $start
     * @param string $end
     * @param int $expiry
     */
    public function __construct(string $start, string $end, int $expiry)
    {
        $this->start = $start;
        $this->end = $end;
        $this->expiry = $expiry;
    }

    /**
     * To prototicket
     *
     * @return ProtoAuthTicket
     */
    public function toProto() : ProtoAuthTicket
    {
        $ticket = new ProtoAuthTicket();
        $ticket->setStart($this->start);
        $ticket->setEnd($this->end);
        $ticket->setExpireTimestampMs($this->expiry);

        return $ticket;
    }

    /**
     * Check if expired
     *
     * @return bool
     */
    public function hasExpired() : bool
    {
        return ($this->expiry/100) < time();
    }

    /**
     * Create from prototicket
     *
     * @param ProtoAuthTicket $ticket
     * @return AuthTicket
     */
    public static function fromProto(ProtoAuthTicket $ticket) : self
    {
        return new self($ticket->getStart()->getContents(), $ticket->getEnd()->getContents(), $ticket->getExpireTimestampMs());
    }
}
