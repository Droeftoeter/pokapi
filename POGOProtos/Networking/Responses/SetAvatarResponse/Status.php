<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : POGOProtos.Networking.Responses.proto
 */


namespace POGOProtos\Networking\Responses\SetAvatarResponse;

/**
 * Protobuf enum : POGOProtos.Networking.Responses.SetAvatarResponse.Status
 */
class Status extends \Protobuf\Enum
{

    /**
     * UNSET = 0
     */
    const UNSET_VALUE = 0;

    /**
     * SUCCESS = 1
     */
    const SUCCESS_VALUE = 1;

    /**
     * AVATAR_ALREADY_SET = 2
     */
    const AVATAR_ALREADY_SET_VALUE = 2;

    /**
     * FAILURE = 3
     */
    const FAILURE_VALUE = 3;

    /**
     * @var \POGOProtos\Networking\Responses\SetAvatarResponse\Status
     */
    protected static $UNSET = null;

    /**
     * @var \POGOProtos\Networking\Responses\SetAvatarResponse\Status
     */
    protected static $SUCCESS = null;

    /**
     * @var \POGOProtos\Networking\Responses\SetAvatarResponse\Status
     */
    protected static $AVATAR_ALREADY_SET = null;

    /**
     * @var \POGOProtos\Networking\Responses\SetAvatarResponse\Status
     */
    protected static $FAILURE = null;

    /**
     * @return \POGOProtos\Networking\Responses\SetAvatarResponse\Status
     */
    public static function UNSET()
    {
        if (self::$UNSET !== null) {
            return self::$UNSET;
        }

        return self::$UNSET = new self('UNSET', self::UNSET_VALUE);
    }

    /**
     * @return \POGOProtos\Networking\Responses\SetAvatarResponse\Status
     */
    public static function SUCCESS()
    {
        if (self::$SUCCESS !== null) {
            return self::$SUCCESS;
        }

        return self::$SUCCESS = new self('SUCCESS', self::SUCCESS_VALUE);
    }

    /**
     * @return \POGOProtos\Networking\Responses\SetAvatarResponse\Status
     */
    public static function AVATAR_ALREADY_SET()
    {
        if (self::$AVATAR_ALREADY_SET !== null) {
            return self::$AVATAR_ALREADY_SET;
        }

        return self::$AVATAR_ALREADY_SET = new self('AVATAR_ALREADY_SET', self::AVATAR_ALREADY_SET_VALUE);
    }

    /**
     * @return \POGOProtos\Networking\Responses\SetAvatarResponse\Status
     */
    public static function FAILURE()
    {
        if (self::$FAILURE !== null) {
            return self::$FAILURE;
        }

        return self::$FAILURE = new self('FAILURE', self::FAILURE_VALUE);
    }

    /**
     * @param int $value
     * @return \POGOProtos\Networking\Responses\SetAvatarResponse\Status
     */
    public static function valueOf($value)
    {
        switch ($value) {
            case 0: return self::UNSET();
            case 1: return self::SUCCESS();
            case 2: return self::AVATAR_ALREADY_SET();
            case 3: return self::FAILURE();
            default: return null;
        }
    }


}

