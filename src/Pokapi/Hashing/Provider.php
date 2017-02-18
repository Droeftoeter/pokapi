<?php
namespace Pokapi\Hashing;

use Pokapi\Version\Version;

interface Provider {

    /**
     * Check if a specific version is supported by the Hashing-provider.
     *
     * @param Version $version
     *
     * @return bool
     */
    public function supportsVersion(Version $version) : bool;

    /**
     * Put in a Request object, get a Response back.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function calculate(Request $request) : Response;
}
