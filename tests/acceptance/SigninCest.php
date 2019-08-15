<?php


class SigninCest
{
    public function _before(AcceptanceTester $I)
    {
		$I->amOnPage('/login');
        $I->fillField('Username','admin');
        $I->fillField('Password','admin');
        $I->click('Login');
        
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }
}
