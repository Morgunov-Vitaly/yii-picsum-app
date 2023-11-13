<?php

namespace frontend\tests\unit;

use frontend\controllers\SiteController;
use PHPUnit\Framework\TestCase;

class SiteControllerTest extends TestCase
{
    public function testConvertToBool(): void
    {
        $this->assertTrue(SiteController::convertToBool('1'));
        $this->assertTrue(SiteController::convertToBool(1));
        $this->assertTrue(SiteController::convertToBool('true'));
        $this->assertTrue(SiteController::convertToBool('True'));
        $this->assertTrue(SiteController::convertToBool('TRUE'));
        $this->assertTrue(SiteController::convertToBool(true));

        $this->assertFalse(SiteController::convertToBool('0'));
        $this->assertFalse(SiteController::convertToBool(0));
        $this->assertFalse(SiteController::convertToBool('false'));
        $this->assertFalse(SiteController::convertToBool('FALSE'));
        $this->assertFalse(SiteController::convertToBool(false));
    }
}
