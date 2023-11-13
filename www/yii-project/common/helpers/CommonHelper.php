<?php

namespace common\helpers;

class CommonHelper
{
    public static function convertToBool(mixed $isApproved): bool
    {
        if (is_bool($isApproved)) {
            return $isApproved;
        }

        $str = strtolower(trim($isApproved));

        return $str === '1' || $str === 'true' || $str === 'yes' || $str === 'ok';
    }
}