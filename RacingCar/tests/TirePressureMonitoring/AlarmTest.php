<?php

declare(strict_types=1);

namespace Tests\TirePressureMonitoring;

use PHPUnit\Framework\TestCase;
use RacingCar\TirePressureMonitoring\Alarm;
use RacingCar\TirePressureMonitoring\Sensor;

class AlarmTest extends TestCase
{
    public function testNoAlarm(): void
    {
        $alarm = new Alarm(new Sensor());
        $this->assertFalse($alarm->isAlarmOn());
    }

    public function testTooLowPressure(): void
    {
        $sensorMock = $this->createMock(Sensor::class);
        $sensorMock->expects(self::once())->method('popNextPressurePsiValue')->willReturn(
            Alarm::LOW_PRESSURE_THRESHOLD - 1
        );
        $alarm = new Alarm($sensorMock);
        $alarm->check();

        self::assertSame(true, $alarm->isAlarmOn());
    }

    public function testTooHighPressure(): void
    {
        $sensorMock = $this->createMock(Sensor::class);
        $sensorMock->expects(self::once())->method('popNextPressurePsiValue')->willReturn(
            Alarm::HIGH_PRESSURE_THRESHOLD + 1
        );
        $alarm = new Alarm($sensorMock);
        $alarm->check();

        self::assertSame(true, $alarm->isAlarmOn());
    }

    public function testRightPressure(): void
    {
        $sensorMock = $this->createMock(Sensor::class);
        $sensorMock->expects(self::once())->method('popNextPressurePsiValue')->willReturn(
            Alarm::LOW_PRESSURE_THRESHOLD
        );
        $alarm = new Alarm($sensorMock);
        $alarm->check();

        self::assertSame(false, $alarm->isAlarmOn());
    }
}
