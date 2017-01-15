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
use BankStatement\Models\BankStatements\Request\StatementDataRequest;
use BankStatement\Models\BankStatements\Response\AccountCollection;
use BankStatement\Provider\BankStatement;
use GuzzleHttp\Exception\ClientException;

$bank = new BankStatement('GUQ2E1NVW13LC6KF1SFX834WSE0VEVISAVQQIZKZ', true);
$loginCreds = new Login('cba','39415655','p5n-mx1992');


try{
    $accountCollection = $bank->login($loginCreds);
    $firstAccount =  $accountCollection->get(1);
    echo 'Acc Name: '.$firstAccount->getName();
    echo '<br/>';

    echo 'Acc Type: '.$firstAccount->getAccountType();
    echo '<br/>';
    echo 'BSB: '.$firstAccount->getBsb();
    echo '<br/>';
    echo 'Acc No: '.$firstAccount->getAccountNumber();
    echo '<br/>';
    echo 'Acc Balance: '.$firstAccount->getBalance();

    echo '<br/>';
    echo 'Account Holder: '.$firstAccount->getAccountHolder();
    echo '<br/>';
    echo '<br/>';
    echo 'Statement Request Test';
    echo '<br/>';


    $accNew = [];
    array_push($accNew, $firstAccount);
    $collection = new AccountCollection($accNew);

    $statementRequest = new StatementDataRequest($collection);
    $statements = $bank->getStatementData($statementRequest);



    echo 'Account Holder '.$statements->first()->getAccountHolder();
    echo '<br/>';
    echo '<br/>';
    $transactions = $statements->first()->getTransactionCollection()->all();

    if($transactions != null){

        foreach ($transactions as $transaction){
            echo "Transaction Type: ".$transaction->getType();
            echo '<br/>';
            echo "Transaction Amount: ".$transaction->getAmount();
            echo '<br/>';
            echo "Transaction Tags: ";
            foreach ($transaction->getTags() as $tag){
                echo $tag.' ';
            }
            echo '<br/>';
            echo "Transaction Text: ".$transaction->getText();

            echo '<br/>';echo '<br/>';
        }
    }
    //echo "<pre>"; print_r($statements); echo "</pre>";

}catch (ClientException $e){
    echo $e->getMessage();
}



