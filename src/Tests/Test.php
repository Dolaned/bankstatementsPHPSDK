<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 17/11/16
 * Time: 3:19 AM
 */


namespace BankStatement\Tests;
require '../../vendor/autoload.php';

use BankStatement\Models\BankStatements\Login;
use BankStatement\Provider\BankStatement;
use GuzzleHttp\Exception\ClientException;

$bank = new BankStatement('GUQ2E1NVW13LC6KF1SFX834WSE0VEVISAVQQIZKZ', true);
$loginCreds = new Login('cba','39415655','p5n-mx1992');

try{
    $accountCollection = $bank->login($loginCreds);
    $firstAccount =  $accountCollection->get(1);
    echo $firstAccount->getName();
    echo '<br/>';
    echo $firstAccount->getAccountNumber();
    echo '<br/>';
    echo $firstAccount->getBalance();
    echo '<br/>';
    echo $firstAccount->getBsb();
    echo '<br/>';
    echo $firstAccount->getAccountType();
    echo '<br/>';

}catch (ClientException $e){
    echo $e->getMessage();
}



$institutions = $bank->listInstitutions('au');
$firstInstitution = $institutions->first();
echo $firstInstitution->getName();
echo '<br/>';
echo $firstInstitution->getMaxDays();
echo '<br/>';

echo $bank->verifyAPI();


