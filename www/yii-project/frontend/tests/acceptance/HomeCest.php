<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnRoute(Url::toRoute('/site/index'));
        $I->see('Оцени картинку');

        $I->seeLink('Login');
        $I->click('Login');
        $I->wait(2); // wait for Login page to be opened

        $I->see('Login');
    }
}
