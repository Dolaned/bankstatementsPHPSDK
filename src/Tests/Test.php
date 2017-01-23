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
use BankStatement\Models\BankStatements\Logout;
use BankStatement\Models\BankStatements\Request\StatementDataRequest;
use BankStatement\Provider\BankStatement;
use GuzzleHttp\Exception\ClientException;

$bank = new BankStatement('', true);
$loginCreds = new Login('bank_of_statements', '12345678', 'TestMyMoney');
$userToken = null;
$bankSlug = null;


try {
    $loginResponse = $bank->login($loginCreds);
    $accountCollection = $loginResponse['accounts'];
    $userToken = $loginResponse['userToken'];
    echo "Session Token : " . $userToken;


    echo '<br/>';
    echo '<br/>';
    $firstAccount = $accountCollection->get(1);
    echo 'Acc Name: ' . $firstAccount->getName();
    echo '<br/>';

    echo 'Acc Type: ' . $firstAccount->getAccountType();
    echo '<br/>';
    echo 'BSB: ' . $firstAccount->getBsb();
    echo '<br/>';
    echo 'Acc No: ' . $firstAccount->getAccountNumber();
    echo '<br/>';
    echo 'Acc Balance: ' . $firstAccount->getBalance();

    echo '<br/>';
    echo 'Account Holder: ' . $firstAccount->getAccountHolder();
    echo '<br/>';
    echo '<br/>';
    echo 'Statement Data for Requested Accounts';
    echo '<br/>';


    $statementRequest = new StatementDataRequest($firstAccount->getSlug(), array($firstAccount->getId()));


    $statements = $bank->getStatementData($userToken, $statementRequest);


    echo 'Account Holder ' . $statements->first()->getAccountHolder();
    echo '<br/>';
    echo '<br/>';

    //get transactions.
    $transactions = $statements->first()->getTransactionCollection()->all();
    
    $endofDayBalance = $statements->first()->getDayEndBalanceCollection()->all();
    
    

    if ($transactions != null) {

        foreach ($transactions as $transaction) {
            echo "Date : ".$transaction->getDate();
            echo '<br/>';
            echo "Transaction Type: " . $transaction->getType();
            echo '<br/>';
            echo "Transaction Amount: " . $transaction->getAmount();
            echo '<br/>';
            echo "Transaction Tags: ";
            foreach ($transaction->getTags() as $tag) {
                echo $tag . ' ';
            }
            echo '<br/>';
            echo "Transaction Text: " . $transaction->getText();

            echo '<br/>';
            echo '<br/>';
        }
    }


    //get other debits.

    if($statements->first()->getOtherDebtsCollection() != null){

        $otherDebits = $statements->first()->getOtherDebtsCollection()->all();

        if ($otherDebits != null) {

            foreach ($otherDebits as $otherDebit) {

                echo $otherDebit->getName();
                echo '<br/>';
            }
        }
    }

    //end users session.
    echo $bank->logout(new Logout($userToken));

} catch (ClientException $e) {
    echo $e->getMessage();
}




