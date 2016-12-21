<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 17/11/16
 * Time: 1:29 AM
 */

namespace BankStatement\Provider;

use BankStatement\Models\BankStatements\Account;
use BankStatement\Models\BankStatements\Login;
use BankStatement\Models\BankStatements\Request\StatementDataRequest;
use BankStatement\Models\BankStatements\Response\AccountCollection;
use BankStatement\Models\BankStatements\Response\DateObject;
use BankStatement\Models\BankStatements\Response\DayEndBalance;
use BankStatement\Models\BankStatements\Response\Institution;
use BankStatement\Models\BankStatements\Response\InstitutionCaptcha;
use BankStatement\Models\BankStatements\Response\InstitutionCollection;
use BankStatement\Models\BankStatements\Response\InstitutionCredentials;
use BankStatement\Models\BankStatements\Response\Transaction;
use BankStatement\Models\BankStatementsInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class BankStatement implements BankStatementsInterface
{

    private $accessToken;

    private $isTest;

    private $guzzleClient;

    private $cookieJar;

    private $userToken;


    /**
     * @var string
     */
    private static $baseUrl = 'https://www.bankstatements.com.au/api/v1/';
    /**
     * @var string
     */
    private static $baseTestUrl = 'https://test.bankstatements.com.au/api/v1/';


    public function __construct($apiKey, $test = false)
    {
        $this->accessToken = $apiKey;
        $this->isTest = $test;
        $url = $this->isTest ? self::$baseTestUrl : self::$baseUrl;
        $this->cookieJar = new CookieJar();
        $this->guzzleClient = new Client([
            'base_uri' => $url,
            //use our cookie jar
            'cookies' => $this->cookieJar,
            'headers' => array(
                'Content-Type' => 'application/json',
                'X-API-KEY' => $this->accessToken
            )
        ]);


    }

    public function login(Login $login)
    {
        $response = $this->guzzleClient->request('POST', 'login', ['body' => $login->toJSON()]);
        $content = $response->getBody();

        //set cookie once logged in
        $this->userToken = $this->cookieJar->toArray()[0]['Value'];

        $bankSlug = $login->getInstitution();

        $json = json_decode($content);

        if (!isset($json)) {
            echo "json is null";

        }

        if (isset($json->accounts)) {

        }
        $accounts = [];

        foreach ($json->accounts as $account) {
            $acc = new Account($account->accountType, $account->name, $account->accountNumber, $account->id, $account->bsb, $account->balance, $account->accountHolder, $account->available);
            $acc->setSlug($bankSlug);
            array_push($accounts, $acc);
        }

        return new AccountCollection($accounts);

    }

    public function logout()
    {
        $response = $this->guzzleClient->request('POST', 'logout');
        $success = $response->getStatusCode();

        return $success == 200 ? true : false;

    }

    public function verifyAPI()
    {
        $response = $this->guzzleClient->request('GET', 'verify');
        $content = $response->getBody();

        $json = json_decode($content);

        return settype($json->status, "boolean");
    }

    public function listInstitutions($region)
    {
        $response = $this->guzzleClient->request('GET', 'institutions', ['query' => ['region' => $region]]);
        $content = $response->getBody();

        $json = json_decode($content);
        if (!isset($json)) {
            echo "json is null";

        }

        if (isset($json->institutions)) {

        }
        $institutions = [];
        $institutionCreds = [];

        foreach ($json->institutions as $institution) {

            foreach ($institution->credentials as $creds) {
                array_push($institutionCreds, new InstitutionCredentials($creds->name, $creds->fieldID, $creds->type, $creds->description, $creds->values, $creds->keyboardType));
            }

            array_push($institutions, new Institution($institution->slug, $institution->name, $institutionCreds, $institution->status, $institution->searchable, $institution->display, $institution->searchVal, $institution->region, $institution->export_with_password, $institution->estatements_supported, $institution->transactions_listings_supported, $institution->requires_preload, $institution->requires_mfa, $institution->updated_at, $institution->max_days));
        }
        return new InstitutionCollection($institutions);
    }


    public function getStatementData(StatementDataRequest $statementDataRequest)
    {
        if (sizeof($statementDataRequest->getAccounts()) < 1) {
            //throw error.
        }

        //passed accounts.
        $accounts = $statementDataRequest->getAccounts()->all();

        //bankslug for the accounts
        $bankSlug = $accounts[0]->getSlug();

        //get all the id's for all the accounts passed in.
        $accountIdArray = [];
        foreach ($accounts as $account) {
            array_push($accountIdArray, $account->getId());
        }


        $jsonBody = json_encode(array('accounts' => array(
            $bankSlug => $accountIdArray),
            'password' => $statementDataRequest->getPassword() != null ? $statementDataRequest->getPassword() : 0,
            'requestNumDays' => $statementDataRequest->getRequestNumDays() != null ? $statementDataRequest->getRequestNumDays() : 90,
            'generate_raw_file' => $statementDataRequest->getGenerateRawFile() != null ? $statementDataRequest->getGenerateRawFile() : false
        ));


        $response = $this->guzzleClient->request('POST', 'statements',
            ['headers' => array('X-USER-TOKEN' => $this->userToken), 'body' => $jsonBody]);
        $content = $response->getBody();

        //decode json string
        $json = json_decode($content);

        //pull up the accounts using the bank slug.
        $jsonAccounts = $json->accounts->$bankSlug;

        //statement collection
        $statements = [];

        foreach ($jsonAccounts as $accountInfo) {

            //create holders for collections.
            $transactionArray = [];


            //Day End Balances Collection
            $dayEndBalanceCollection = [];

            //income collection
            $incomeCollection = [];
            $benifitCollection = [];
            $dishonourColection = [];
            $rentCollection = [];

            foreach ($accountInfo->statementData->details as $transaction) {

                //create the date object.
                $dateObject = new DateObject($transaction->dateObj->date, $transaction->dateObj->timezone_type, $transaction->dateObj->timezone);

                //create the tags array
                $tags = [];
                //parse the tags.
                foreach ($transaction->tags as $tag) {
                    array_push($tags, $tag);
                }

                //create the transaction with the tags and date object.
                $singleTrans = new Transaction($dateObject, $transaction->date, $transaction->text, $transaction->amount, $transaction->type, $transaction->balance, $tags);
                array_push($transactionArray, $singleTrans);


            }

            //pass each day end balance for this account.
            foreach ($accountInfo->dayEndBalance as $dayEndBalance) {
                $obj = new DayEndBalance($dayEndBalance->date, $dayEndBalance->balance);
                array_push($dayEndBalanceCollection, $obj);
            }

            //time to parse analysis arrays. woo

            foreach($accountInfo->income as $incomeAnalysis){
                if($incomeAnalysis == "total"){
                    if($incomeAnalysis->total->transactionCount == 0){
                        break;
                    }

                }else{
                    $transactions = [];
                    foreach ($incomeAnalysis->transactions as $transaction){
                        //create the date object.
                        $dateObject = new DateObject($transaction->dateObj->date, $transaction->dateObj->timezone_type, $transaction->dateObj->timezone);

                        //create the tags array
                        $tags = [];
                        //parse the tags.
                        foreach ($transaction->tags as $tag) {
                            array_push($tags, $tag);
                        }

                        //create the transaction with the tags and date object.
                        $singleTrans = new Transaction($dateObject, $transaction->date, $transaction->text, $transaction->amount, $transaction->type, $transaction->balance, $tags);
                        array_push($transactions, $singleTrans);
                    }
                }

            }

            foreach($accountInfo->Benefits as $benefitAnalysis){

            }

            foreach($accountInfo->Dishonours as $dishonourAnalysis){

            }

            foreach ($accountInfo->Loans as $loanAnalysis){

            }
            foreach($accountInfo->Gambling as $gamblingAnalysis){

            }

            foreach($accountInfo->{'Other Debits'} as $otherDebitsAnalysis){

            }


        }


        //var_dump($content->getContents());
        // TODO: Implement getStatementData() method.
    }

    public function retreiveFiles($userToken)
    {
        // TODO: Implement retreiveFiles() method.
    }

    public function getLoginPreload($bankSlug)
    {

        $response = $this->guzzleClient->request('GET', 'preload', ['query' => ['institution' => $bankSlug]]);
        $content = $response->getBody();

        $json = json_decode($content);
        if (!isset($json)) {
            echo "json is null";

        }

        if (!isset($json->institution)) {

        }
        $institution = $json->institution;
        $institutionCreds = [];


        foreach ($institution->credentials as $creds) {

            if ($institution->type == "captcha" || "CAPTCHA") {
                array_push($institutionCreds, new InstitutionCaptcha($creds->name, $creds->fieldID, $creds->type, $creds->description, $creds->values, $creds->keyboardType, $creds->src, $creds->width, $creds->wheight, $creds->alt));

            } else {
                array_push($institutionCreds, new InstitutionCredentials($creds->name, $creds->fieldID, $creds->type, $creds->description, $creds->values, $creds->keyboardType));
            }

        }

        return (new Institution($institution->slug, $institution->name, $institutionCreds, $institution->status, $institution->searchable, $institution->display, $institution->searchVal, $institution->region, $institution->export_with_password, $institution->estatements_supported, $institution->transactions_listings_supported, $institution->requires_preload, $institution->requires_mfa, $institution->updated_at, $institution->max_days));
    }

    public function putLoginPreload(Institution $institution)
    {
        $response = $this->guzzleClient->request('POST', 'preload', ['body' => ['institution' => $institution->getSlug()]]);
        $content = $response->getBody();

        $json = json_decode($content);
        if (!isset($json)) {
            echo "json is null";

        }

        if (isset($json->institution)) {

        }
        $institution = $json->institution;
        $institutionCreds = [];


        foreach ($institution->credentials as $creds) {

            if ($institution->type == "captcha" || "CAPTCHA") {
                array_push($institutionCreds, new InstitutionCaptcha($creds->name, $creds->fieldID, $creds->type, $creds->description, $creds->values, $creds->keyboardType, $creds->src, $creds->width, $creds->wheight, $creds->alt));

            } else {
                array_push($institutionCreds, new InstitutionCredentials($creds->name, $creds->fieldID, $creds->type, $creds->description, $creds->values, $creds->keyboardType));
            }

        }

        return (new Institution($institution->slug, $institution->name, $institutionCreds, $institution->status, $institution->searchable, $institution->display, $institution->searchVal, $institution->region, $institution->export_with_password, $institution->estatements_supported, $institution->transactions_listings_supported, $institution->requires_preload, $institution->requires_mfa, $institution->updated_at, $institution->max_days));
    }

    public function LoginAndGetAllStatements()
    {
        // TODO: Implement LoginAndGetAllStatements() method.
    }
}