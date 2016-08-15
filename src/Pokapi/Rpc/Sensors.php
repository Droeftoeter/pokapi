<?php
namespace Pokapi\Rpc;

use Pokapi\Utility\Random;

/**
 * Class Sensors
 *
 * Generates sensor data. Data is probably completely wrong. But wrong data is better than no data right?
 *
 * @package Pokapi\Rpc
 * @author Freek Post <freek@kobalt.blue>
 */
class Sensors
{

    /**
     * @var float
     */
    protected $magnX;

    /**
     * @var float
     */
    protected $magnY;

    /**
     * @var float
     */
    protected $magnZ;

    /**
     * @var float
     */
    protected $accX;

    /**
     * @var float
     */
    protected $accY;

    /**
     * @var float
     */
    protected $accZ;

    /**
     * @var float
     */
    protected $pitch;

    /**
     * @var float
     */
    protected $roll;

    /**
     * @var float
     */
    protected $azimuth;

    /**
     * @var float
     */
    protected $gyroX;

    /**
     * @var float
     */
    protected $gyroY;

    /**
     * @var float
     */
    protected $gyroZ;

    /**
     * Stores the last normalized data
     *
     * @var array
     */
    protected static $lastResult = [];

    /**
     *
     */
    const ALPHA = 0.15;

    /**
     * Sensors constructor.
     *
     * @param float $magnX
     * @param float $magnY
     * @param float $magnZ
     * @param float $accX
     * @param float $accY
     * @param float $accZ
     * @param float $pitch
     * @param float $roll
     * @param float $azimuth
     * @param float $gyroX
     * @param float $gyroY
     * @param float $gyroZ
     */
    public function __construct(float $magnX, float $magnY, float $magnZ, float $accX, float $accY, float $accZ, float $pitch, float $roll, float $azimuth, float $gyroX, float $gyroY, float $gyroZ)
    {
        $this->magnX = $magnX;
        $this->magnY = $magnY;
        $this->magnZ = $magnZ;

        $this->accX = $accX;
        $this->accY = $accY;
        $this->accZ = $accZ;

        $this->pitch = $pitch;
        $this->roll = $roll;
        $this->azimuth = $azimuth;

        $this->gyroX = $gyroX;
        $this->gyroY = $gyroY;
        $this->gyroZ = $gyroZ;

        $this->storeNormalizedAccel($accX, $accY, $accZ);
    }

    /**
     * Create random sensor data
     *
     * @param int $passes
     *
     * @return Sensors
     */
    public static function createRandom($passes = 1) : self
    {
        for($i = 0; $i < $passes; $i++) {
            $sensor = new self(
                Random::randomFloat(-0.3, 0.3),
                Random::randomFloat(-0.2, 2.5),
                Random::randomFloat(-0.2, 5),
                Random::randomFloat(0.08, 0.20),
                Random::randomFloat(0.45, 0.62),
                Random::randomFloat(9, 12),
                Random::randomFloat(40, 50),
                Random::randomFloat(-3, 3),
                Random::randomFloat(-125, -85),
                0,
                0,
                0
            );
        }

        return $sensor;
    }

    /**
     * Get magnetometer data (looks more like linear_accell?)
     *
     * @return float[]
     */
    public function getMagnetoData() : array
    {
        return [$this->magnX, $this->magnY, $this->magnZ];
    }

    /**
     * Get accelerometer data
     *
     * @return float[]
     */
    public function getAccelerometerData() : array
    {
        return [$this->accX, $this->accY, $this->accZ];
    }

    /**
     * Get normalized accelerometer data
     *
     * @return float[]
     */
    public function getNormalizedAccelerometerData() : array
    {
        return self::$lastResult;
    }


    /**
     * Get data about the angle
     *
     * @return float[]
     */
    public function getAngleData() : array
    {
        return [$this->pitch, $this->roll, $this->azimuth];
    }

    /**
     * Get the gyroscope data
     *
     * @return array
     */
    public function getGyroscopeData() : array
    {
        return [$this->gyroX, $this->gyroY, $this->gyroZ];
    }

    /**
     * Normalize
     *
     * @param float $accX
     * @param float $accY
     * @param float $accZ
     */
    protected function storeNormalizedAccel(float $accX, float $accY, float $accZ)
    {
        $axles = [$accX, $accY, $accZ];

        if (empty(self::$lastResult)) {
            self::$lastResult = $axles;
        }

        foreach($axles as $index => $axle) {
            $axles[$index] = self::$lastResult[$index] + self::ALPHA * ($axle - self::$lastResult[$index]);
        }

        self::$lastResult = $axles;
    }
}
