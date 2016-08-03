<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : POGOProtos.Inventory.Item.proto
 */


namespace POGOProtos\Inventory\Item;

/**
 * Protobuf enum : POGOProtos.Inventory.Item.ItemType
 */
class ItemType extends \Protobuf\Enum
{

    /**
     * ITEM_TYPE_NONE = 0
     */
    const ITEM_TYPE_NONE_VALUE = 0;

    /**
     * ITEM_TYPE_POKEBALL = 1
     */
    const ITEM_TYPE_POKEBALL_VALUE = 1;

    /**
     * ITEM_TYPE_POTION = 2
     */
    const ITEM_TYPE_POTION_VALUE = 2;

    /**
     * ITEM_TYPE_REVIVE = 3
     */
    const ITEM_TYPE_REVIVE_VALUE = 3;

    /**
     * ITEM_TYPE_MAP = 4
     */
    const ITEM_TYPE_MAP_VALUE = 4;

    /**
     * ITEM_TYPE_BATTLE = 5
     */
    const ITEM_TYPE_BATTLE_VALUE = 5;

    /**
     * ITEM_TYPE_FOOD = 6
     */
    const ITEM_TYPE_FOOD_VALUE = 6;

    /**
     * ITEM_TYPE_CAMERA = 7
     */
    const ITEM_TYPE_CAMERA_VALUE = 7;

    /**
     * ITEM_TYPE_DISK = 8
     */
    const ITEM_TYPE_DISK_VALUE = 8;

    /**
     * ITEM_TYPE_INCUBATOR = 9
     */
    const ITEM_TYPE_INCUBATOR_VALUE = 9;

    /**
     * ITEM_TYPE_INCENSE = 10
     */
    const ITEM_TYPE_INCENSE_VALUE = 10;

    /**
     * ITEM_TYPE_XP_BOOST = 11
     */
    const ITEM_TYPE_XP_BOOST_VALUE = 11;

    /**
     * ITEM_TYPE_INVENTORY_UPGRADE = 12
     */
    const ITEM_TYPE_INVENTORY_UPGRADE_VALUE = 12;

    /**
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected static $ITEM_TYPE_NONE = null;

    /**
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected static $ITEM_TYPE_POKEBALL = null;

    /**
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected static $ITEM_TYPE_POTION = null;

    /**
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected static $ITEM_TYPE_REVIVE = null;

    /**
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected static $ITEM_TYPE_MAP = null;

    /**
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected static $ITEM_TYPE_BATTLE = null;

    /**
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected static $ITEM_TYPE_FOOD = null;

    /**
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected static $ITEM_TYPE_CAMERA = null;

    /**
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected static $ITEM_TYPE_DISK = null;

    /**
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected static $ITEM_TYPE_INCUBATOR = null;

    /**
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected static $ITEM_TYPE_INCENSE = null;

    /**
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected static $ITEM_TYPE_XP_BOOST = null;

    /**
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected static $ITEM_TYPE_INVENTORY_UPGRADE = null;

    /**
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function ITEM_TYPE_NONE()
    {
        if (self::$ITEM_TYPE_NONE !== null) {
            return self::$ITEM_TYPE_NONE;
        }

        return self::$ITEM_TYPE_NONE = new self('ITEM_TYPE_NONE', self::ITEM_TYPE_NONE_VALUE);
    }

    /**
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function ITEM_TYPE_POKEBALL()
    {
        if (self::$ITEM_TYPE_POKEBALL !== null) {
            return self::$ITEM_TYPE_POKEBALL;
        }

        return self::$ITEM_TYPE_POKEBALL = new self('ITEM_TYPE_POKEBALL', self::ITEM_TYPE_POKEBALL_VALUE);
    }

    /**
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function ITEM_TYPE_POTION()
    {
        if (self::$ITEM_TYPE_POTION !== null) {
            return self::$ITEM_TYPE_POTION;
        }

        return self::$ITEM_TYPE_POTION = new self('ITEM_TYPE_POTION', self::ITEM_TYPE_POTION_VALUE);
    }

    /**
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function ITEM_TYPE_REVIVE()
    {
        if (self::$ITEM_TYPE_REVIVE !== null) {
            return self::$ITEM_TYPE_REVIVE;
        }

        return self::$ITEM_TYPE_REVIVE = new self('ITEM_TYPE_REVIVE', self::ITEM_TYPE_REVIVE_VALUE);
    }

    /**
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function ITEM_TYPE_MAP()
    {
        if (self::$ITEM_TYPE_MAP !== null) {
            return self::$ITEM_TYPE_MAP;
        }

        return self::$ITEM_TYPE_MAP = new self('ITEM_TYPE_MAP', self::ITEM_TYPE_MAP_VALUE);
    }

    /**
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function ITEM_TYPE_BATTLE()
    {
        if (self::$ITEM_TYPE_BATTLE !== null) {
            return self::$ITEM_TYPE_BATTLE;
        }

        return self::$ITEM_TYPE_BATTLE = new self('ITEM_TYPE_BATTLE', self::ITEM_TYPE_BATTLE_VALUE);
    }

    /**
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function ITEM_TYPE_FOOD()
    {
        if (self::$ITEM_TYPE_FOOD !== null) {
            return self::$ITEM_TYPE_FOOD;
        }

        return self::$ITEM_TYPE_FOOD = new self('ITEM_TYPE_FOOD', self::ITEM_TYPE_FOOD_VALUE);
    }

    /**
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function ITEM_TYPE_CAMERA()
    {
        if (self::$ITEM_TYPE_CAMERA !== null) {
            return self::$ITEM_TYPE_CAMERA;
        }

        return self::$ITEM_TYPE_CAMERA = new self('ITEM_TYPE_CAMERA', self::ITEM_TYPE_CAMERA_VALUE);
    }

    /**
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function ITEM_TYPE_DISK()
    {
        if (self::$ITEM_TYPE_DISK !== null) {
            return self::$ITEM_TYPE_DISK;
        }

        return self::$ITEM_TYPE_DISK = new self('ITEM_TYPE_DISK', self::ITEM_TYPE_DISK_VALUE);
    }

    /**
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function ITEM_TYPE_INCUBATOR()
    {
        if (self::$ITEM_TYPE_INCUBATOR !== null) {
            return self::$ITEM_TYPE_INCUBATOR;
        }

        return self::$ITEM_TYPE_INCUBATOR = new self('ITEM_TYPE_INCUBATOR', self::ITEM_TYPE_INCUBATOR_VALUE);
    }

    /**
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function ITEM_TYPE_INCENSE()
    {
        if (self::$ITEM_TYPE_INCENSE !== null) {
            return self::$ITEM_TYPE_INCENSE;
        }

        return self::$ITEM_TYPE_INCENSE = new self('ITEM_TYPE_INCENSE', self::ITEM_TYPE_INCENSE_VALUE);
    }

    /**
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function ITEM_TYPE_XP_BOOST()
    {
        if (self::$ITEM_TYPE_XP_BOOST !== null) {
            return self::$ITEM_TYPE_XP_BOOST;
        }

        return self::$ITEM_TYPE_XP_BOOST = new self('ITEM_TYPE_XP_BOOST', self::ITEM_TYPE_XP_BOOST_VALUE);
    }

    /**
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function ITEM_TYPE_INVENTORY_UPGRADE()
    {
        if (self::$ITEM_TYPE_INVENTORY_UPGRADE !== null) {
            return self::$ITEM_TYPE_INVENTORY_UPGRADE;
        }

        return self::$ITEM_TYPE_INVENTORY_UPGRADE = new self('ITEM_TYPE_INVENTORY_UPGRADE', self::ITEM_TYPE_INVENTORY_UPGRADE_VALUE);
    }

    /**
     * @param int $value
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public static function valueOf($value)
    {
        switch ($value) {
            case 0: return self::ITEM_TYPE_NONE();
            case 1: return self::ITEM_TYPE_POKEBALL();
            case 2: return self::ITEM_TYPE_POTION();
            case 3: return self::ITEM_TYPE_REVIVE();
            case 4: return self::ITEM_TYPE_MAP();
            case 5: return self::ITEM_TYPE_BATTLE();
            case 6: return self::ITEM_TYPE_FOOD();
            case 7: return self::ITEM_TYPE_CAMERA();
            case 8: return self::ITEM_TYPE_DISK();
            case 9: return self::ITEM_TYPE_INCUBATOR();
            case 10: return self::ITEM_TYPE_INCENSE();
            case 11: return self::ITEM_TYPE_XP_BOOST();
            case 12: return self::ITEM_TYPE_INVENTORY_UPGRADE();
            default: return null;
        }
    }


}

