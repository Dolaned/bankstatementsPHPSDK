<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 17/11/16
 * Time: 3:19 AM
 */


namespace BankStatement\Tests;

use BankStatement\Models\BankStatements\Login;
use BankStatement\Provider\BankStatement;

$bank = new BankStatement('GUQ2E1NVW13LC6KF1SFX834WSE0VEVISAVQQIZKZ');
$loginCreds = new Login('cba','39415655','p5n-mx1992');
var_dump($bank->login($loginCreds));