<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : POGOProtos.Map.Fort.proto
 */


namespace POGOProtos\Map\Fort;

/**
 * Protobuf enum : POGOProtos.Map.Fort.FortRenderingType
 */
class FortRenderingType extends \Protobuf\Enum
{

    /**
     * DEFAULT = 0
     */
    const DEFAULT_VALUE = 0;

    /**
     * INTERNAL_TEST = 1
     */
    const INTERNAL_TEST_VALUE = 1;

    /**
     * @var \POGOProtos\Map\Fort\FortRenderingType
     */
    protected static $DEFAULT = null;

    /**
     * @var \POGOProtos\Map\Fort\FortRenderingType
     */
    protected static $INTERNAL_TEST = null;

    /**
     * @return \POGOProtos\Map\Fort\FortRenderingType
     */
    public static function DEFAULT()
    {
        if (self::$DEFAULT !== null) {
            return self::$DEFAULT;
        }

        return self::$DEFAULT = new self('DEFAULT', self::DEFAULT_VALUE);
    }

    /**
     * @return \POGOProtos\Map\Fort\FortRenderingType
     */
    public static function INTERNAL_TEST()
    {
        if (self::$INTERNAL_TEST !== null) {
            return self::$INTERNAL_TEST;
        }

        return self::$INTERNAL_TEST = new self('INTERNAL_TEST', self::INTERNAL_TEST_VALUE);
    }

    /**
     * @param int $value
     * @return \POGOProtos\Map\Fort\FortRenderingType
     */
    public static function valueOf($value)
    {
        switch ($value) {
            case 0: return self::DEFAULT();
            case 1: return self::INTERNAL_TEST();
            default: return null;
        }
    }


}

