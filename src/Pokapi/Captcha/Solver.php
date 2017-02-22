<?php
namespace Pokapi\Captcha;

interface Solver
{

    /**
     * Solve a challenge
     *
     * @param string $challengeUrl
     *
     * @return string
     */
    public function solve(string $challengeUrl) : string;
}
