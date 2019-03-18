<?php

namespace App\Service;

class DateTimeService
{
    public const UTC_TIMEZONE = 'UTC';

    public function getCurrentUTC(): \DateTime
    {
        return new \DateTime('now', new \DateTimeZone(self::UTC_TIMEZONE));
    }
}
