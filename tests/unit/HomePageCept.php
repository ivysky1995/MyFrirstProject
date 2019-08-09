<?php 
$I = new UnitTester($scenario);
$I->wantTo('verify that the homepage welcomes me');
$I->amOnpage('/');
$I->see('Welcome');

