<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : POGOProtos.Networking.Responses.proto
 */


namespace POGOProtos\Networking\Responses\FortDeployPokemonResponse;

/**
 * Protobuf enum : POGOProtos.Networking.Responses.FortDeployPokemonResponse.Result
 */
class Result extends \Protobuf\Enum
{

    /**
     * NO_RESULT_SET = 0
     */
    const NO_RESULT_SET_VALUE = 0;

    /**
     * SUCCESS = 1
     */
    const SUCCESS_VALUE = 1;

    /**
     * ERROR_ALREADY_HAS_POKEMON_ON_FORT = 2
     */
    const ERROR_ALREADY_HAS_POKEMON_ON_FORT_VALUE = 2;

    /**
     * ERROR_OPPOSING_TEAM_OWNS_FORT = 3
     */
    const ERROR_OPPOSING_TEAM_OWNS_FORT_VALUE = 3;

    /**
     * ERROR_FORT_IS_FULL = 4
     */
    const ERROR_FORT_IS_FULL_VALUE = 4;

    /**
     * ERROR_NOT_IN_RANGE = 5
     */
    const ERROR_NOT_IN_RANGE_VALUE = 5;

    /**
     * ERROR_PLAYER_HAS_NO_TEAM = 6
     */
    const ERROR_PLAYER_HAS_NO_TEAM_VALUE = 6;

    /**
     * ERROR_POKEMON_NOT_FULL_HP = 7
     */
    const ERROR_POKEMON_NOT_FULL_HP_VALUE = 7;

    /**
     * ERROR_PLAYER_BELOW_MINIMUM_LEVEL = 8
     */
    const ERROR_PLAYER_BELOW_MINIMUM_LEVEL_VALUE = 8;

    /**
     * @var \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    protected static $NO_RESULT_SET = null;

    /**
     * @var \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    protected static $SUCCESS = null;

    /**
     * @var \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    protected static $ERROR_ALREADY_HAS_POKEMON_ON_FORT = null;

    /**
     * @var \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    protected static $ERROR_OPPOSING_TEAM_OWNS_FORT = null;

    /**
     * @var \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    protected static $ERROR_FORT_IS_FULL = null;

    /**
     * @var \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    protected static $ERROR_NOT_IN_RANGE = null;

    /**
     * @var \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    protected static $ERROR_PLAYER_HAS_NO_TEAM = null;

    /**
     * @var \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    protected static $ERROR_POKEMON_NOT_FULL_HP = null;

    /**
     * @var \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    protected static $ERROR_PLAYER_BELOW_MINIMUM_LEVEL = null;

    /**
     * @return \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    public static function NO_RESULT_SET()
    {
        if (self::$NO_RESULT_SET !== null) {
            return self::$NO_RESULT_SET;
        }

        return self::$NO_RESULT_SET = new self('NO_RESULT_SET', self::NO_RESULT_SET_VALUE);
    }

    /**
     * @return \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    public static function SUCCESS()
    {
        if (self::$SUCCESS !== null) {
            return self::$SUCCESS;
        }

        return self::$SUCCESS = new self('SUCCESS', self::SUCCESS_VALUE);
    }

    /**
     * @return \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    public static function ERROR_ALREADY_HAS_POKEMON_ON_FORT()
    {
        if (self::$ERROR_ALREADY_HAS_POKEMON_ON_FORT !== null) {
            return self::$ERROR_ALREADY_HAS_POKEMON_ON_FORT;
        }

        return self::$ERROR_ALREADY_HAS_POKEMON_ON_FORT = new self('ERROR_ALREADY_HAS_POKEMON_ON_FORT', self::ERROR_ALREADY_HAS_POKEMON_ON_FORT_VALUE);
    }

    /**
     * @return \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    public static function ERROR_OPPOSING_TEAM_OWNS_FORT()
    {
        if (self::$ERROR_OPPOSING_TEAM_OWNS_FORT !== null) {
            return self::$ERROR_OPPOSING_TEAM_OWNS_FORT;
        }

        return self::$ERROR_OPPOSING_TEAM_OWNS_FORT = new self('ERROR_OPPOSING_TEAM_OWNS_FORT', self::ERROR_OPPOSING_TEAM_OWNS_FORT_VALUE);
    }

    /**
     * @return \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    public static function ERROR_FORT_IS_FULL()
    {
        if (self::$ERROR_FORT_IS_FULL !== null) {
            return self::$ERROR_FORT_IS_FULL;
        }

        return self::$ERROR_FORT_IS_FULL = new self('ERROR_FORT_IS_FULL', self::ERROR_FORT_IS_FULL_VALUE);
    }

    /**
     * @return \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    public static function ERROR_NOT_IN_RANGE()
    {
        if (self::$ERROR_NOT_IN_RANGE !== null) {
            return self::$ERROR_NOT_IN_RANGE;
        }

        return self::$ERROR_NOT_IN_RANGE = new self('ERROR_NOT_IN_RANGE', self::ERROR_NOT_IN_RANGE_VALUE);
    }

    /**
     * @return \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    public static function ERROR_PLAYER_HAS_NO_TEAM()
    {
        if (self::$ERROR_PLAYER_HAS_NO_TEAM !== null) {
            return self::$ERROR_PLAYER_HAS_NO_TEAM;
        }

        return self::$ERROR_PLAYER_HAS_NO_TEAM = new self('ERROR_PLAYER_HAS_NO_TEAM', self::ERROR_PLAYER_HAS_NO_TEAM_VALUE);
    }

    /**
     * @return \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    public static function ERROR_POKEMON_NOT_FULL_HP()
    {
        if (self::$ERROR_POKEMON_NOT_FULL_HP !== null) {
            return self::$ERROR_POKEMON_NOT_FULL_HP;
        }

        return self::$ERROR_POKEMON_NOT_FULL_HP = new self('ERROR_POKEMON_NOT_FULL_HP', self::ERROR_POKEMON_NOT_FULL_HP_VALUE);
    }

    /**
     * @return \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    public static function ERROR_PLAYER_BELOW_MINIMUM_LEVEL()
    {
        if (self::$ERROR_PLAYER_BELOW_MINIMUM_LEVEL !== null) {
            return self::$ERROR_PLAYER_BELOW_MINIMUM_LEVEL;
        }

        return self::$ERROR_PLAYER_BELOW_MINIMUM_LEVEL = new self('ERROR_PLAYER_BELOW_MINIMUM_LEVEL', self::ERROR_PLAYER_BELOW_MINIMUM_LEVEL_VALUE);
    }

    /**
     * @param int $value
     * @return \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    public static function valueOf($value)
    {
        switch ($value) {
            case 0: return self::NO_RESULT_SET();
            case 1: return self::SUCCESS();
            case 2: return self::ERROR_ALREADY_HAS_POKEMON_ON_FORT();
            case 3: return self::ERROR_OPPOSING_TEAM_OWNS_FORT();
            case 4: return self::ERROR_FORT_IS_FULL();
            case 5: return self::ERROR_NOT_IN_RANGE();
            case 6: return self::ERROR_PLAYER_HAS_NO_TEAM();
            case 7: return self::ERROR_POKEMON_NOT_FULL_HP();
            case 8: return self::ERROR_PLAYER_BELOW_MINIMUM_LEVEL();
            default: return null;
        }
    }


}

