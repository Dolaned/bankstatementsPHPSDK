<?php
namespace BankStatement\Tests;
require '../../vendor/autoload.php';

use BankStatement\Models\BankStatements\Login;
use BankStatement\Models\BankStatements\Request\StatementDataRequest;
use BankStatement\Provider\BankStatement;

$bank = new BankStatement('GUQ2E1NVW13LC6KF1SFX834WSE0VEVISAVQQIZKZ', true);
$loginCreds = new Login('bank_of_statements', '12345678', 'TestMyMoney');
$userToken = null;
$bankSlug = null;


try {
    $loginResponse = $bank->login($loginCreds);
    $accountCollection = $loginResponse['accounts'];
    $userToken = $loginResponse['userToken'];


    $firstAccount = $accountCollection->get(1);

    $statementRequest = new StatementDataRequest($firstAccount->getSlug(), array($firstAccount->getId()));

    $statementRequest->setGenerateRawFile(true);

    $statements = $bank->getStatementData($userToken, $statementRequest);


    $bank->retrieveFiles($userToken);
}catch(\Exception $e){

}