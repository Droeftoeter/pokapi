<?php
namespace Pokapi\Rpc;
use POGOProtos\Networking\Envelopes\Signature\DeviceInfo as SignatureDeviceInfo;

/**
 * Class DeviceInfo
 *
 * @package Pokapi\Rpc
 * @author Freek Post <freek@kobalt.blue>
 */
class DeviceInfo
{

    /**
     * @var string
     */
    protected $deviceId;

    /**
     * @var string
     */
    protected $firmwareType;

    /**
     * @var string
     */
    protected $deviceModelBoot;

    /**
     * @var string
     */
    protected $deviceModel;

    /**
     * @var string
     */
    protected $hardwareModel;

    /**
     * @var string
     */
    protected $firmwareBrand;

    /**
     * @var string
     */
    protected $deviceBrand;

    /**
     * @var string
     */
    protected $hardwareManufacturer;

    /**
     * DeviceInfo constructor.
     *
     * @param string|null $deviceId
     * @param string $firmwareType
     * @param string $deviceModelBoot
     * @param string $deviceModel
     * @param string $hardwareModel
     * @param string $firmwareBrand
     * @param string $deviceBrand
     * @param string $hardwareManufacturer
     */
    public function __construct(string $deviceId = null, string $firmwareType, string $deviceModelBoot, string $deviceModel, string $hardwareModel, string $firmwareBrand, string $deviceBrand, string $hardwareManufacturer)
    {
        $this->deviceId = $deviceId;
        $this->firmwareType = $firmwareType;
        $this->firmwareBrand = $firmwareBrand;
        $this->deviceModelBoot = $deviceModelBoot;
        $this->deviceModel = $deviceModel;
        $this->hardwareModel = $hardwareModel;
        $this->firmwareBrand = $firmwareBrand;
        $this->deviceBrand = $deviceBrand;
        $this->hardwareManufacturer = $hardwareManufacturer;
    }

    /**
     * Get the default.
     *
     * @param string $deviceId
     *
     * @return DeviceInfo
     */
    public static function getDefault(string $deviceId = null) : self
    {
        return new self(
            $deviceId,
            "9.3.2",
            "iPhone5,1",
            "iPhone",
            "N41AP",
            "iPhone OS",
            "Apple",
            "Apple"
        );
    }

    /**
     * Convert to protobuf message
     *
     * @return SignatureDeviceInfo
     */
    public function toProtobuf() : SignatureDeviceInfo
    {
        $deviceInfo = new SignatureDeviceInfo();
        if ($this->deviceId !== null) {
            $deviceInfo->setDeviceId($this->deviceId);
        }

        $deviceInfo->setDeviceBrand($this->deviceBrand);
        $deviceInfo->setDeviceModel($this->deviceModel);
        $deviceInfo->setDeviceModelBoot($this->deviceModelBoot);
        $deviceInfo->setFirmwareType($this->firmwareType);
        $deviceInfo->setFirmwareBrand($this->firmwareBrand);
        $deviceInfo->setHardwareModel($this->hardwareModel);
        $deviceInfo->setHardwareManufacturer($this->hardwareManufacturer);

        return $deviceInfo;
    }
}
