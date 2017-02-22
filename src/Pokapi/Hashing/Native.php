<?php
namespace Pokapi\Hashing;

use Pokapi\Hashing\Exception\UnsupportedVersionException;
use Pokapi\Utility\Hex;
use Pokapi\Version\Version;

/**
 * Native request hashing for (legacy) requests.
 * Depends on the php-xxhash extension.
 *
 * @package Pokapi\Hashing
 */
class Native implements Provider
{

    /**
     * Only supports legacy
     *
     * @param Version $version
     *
     * @return bool
     */
    public function supportsVersion(Version $version) : bool
    {
        return $version->getVersion() <= 4500;
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @throws UnsupportedVersionException
     */
    public function calculate(Request $request) : Response
    {
        if ($this->supportsVersion($request->getVersion())) {
            throw new UnsupportedVersionException($request->getVersion());
        }

        $ticket = $request->getAuthData()->getData();

        $locationAuth = $this->generateLocationAuth(
            $ticket,
            $request->getPosition()->getLatitude(),
            $request->getPosition()->getLongitude(),
            $request->getPosition()->getAltitude()
        );

        $locationHash = $this->generateLocation(
            $request->getPosition()->getLatitude(),
            $request->getPosition()->getLongitude(),
            $request->getPosition()->getAltitude()
        );

        $requestHashes = [];
        foreach ($request->getRequests() as $request) {
            $requestHashes[] = $this->generateRequestHash(
                $ticket,
                $request->toProtobufRequest()->toStream()->getContents()
            );
        }

        return new Response(
            $locationAuth,
            $locationHash,
            $requestHashes
        );
    }

    /**
     * Generate location auth hash
     *
     * @param string $authTicket
     * @param float $latitude
     * @param float $longitude
     * @param float $altitude
     *
     * @return number
     */
    protected function generateLocationAuth(string $authTicket, float $latitude, float $longitude, float $altitude = 0.0)
    {
        $seed = hexdec(xxhash32($authTicket, 0x1B845238));
        return (int)hexdec(xxhash32($this->getLocationBytes($latitude, $longitude, $altitude), (int)$seed));
    }

    /**
     * Generate location hash
     *
     * @param float $latitude
     * @param float $longitude
     * @param float $altitude
     *
     * @return int
     */
    protected function generateLocation(float $latitude, float $longitude, float $altitude = 0.0) : int
    {
        return (int)hexdec(xxhash32($this->getLocationBytes($latitude, $longitude, $altitude), 0x1B845238));
    }

    /**
     * Generate request hash
     *
     * @param string $authTicket
     * @param string $request
     *
     * @return int
     */
    protected function generateRequestHash(string $authTicket, string $request) : int
    {
        $seed = (unpack("J", pack("H*", xxhash64($authTicket, 0x1B845238))))[1];
        return (unpack("J", pack("H*", xxhash64($request, $seed))))[1];
    }

    /**
     * Get the location as bytes
     *
     * @param float $latitude
     * @param float $longitude
     * @param float $altitude
     *
     * @return string
     */
    protected function getLocationBytes(float $latitude, float $longitude, float $altitude) : string
    {
        return Hex::d2h($latitude) . Hex::d2h($longitude) . Hex::d2h($altitude);
    }
}
