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
use BankStatement\Models\BankStatements\Response\AnalysisObject;
use BankStatement\Models\BankStatements\Response\AnalysisObjectCollection;
use BankStatement\Models\BankStatements\Response\DateObject;
use BankStatement\Models\BankStatements\Response\DayEndBalance;
use BankStatement\Models\BankStatements\Response\DayEndBalanceCollection;
use BankStatement\Models\BankStatements\Response\Institution;
use BankStatement\Models\BankStatements\Response\InstitutionCaptcha;
use BankStatement\Models\BankStatements\Response\InstitutionCollection;
use BankStatement\Models\BankStatements\Response\InstitutionCredentials;
use BankStatement\Models\BankStatements\Response\StatementData;
use BankStatement\Models\BankStatements\Response\StatementDataCollection;
use BankStatement\Models\BankStatements\Response\Transaction;
use BankStatement\Models\BankStatements\Response\TransactionCollection;
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
        $jsonAccounts = $json->accounts->$bankSlug->accounts;

        //statement collection
        $statements = [];

        foreach ($jsonAccounts as $accountInfo) {

            //create holders for collections.
            $transactionArray = [];


            //Day End Balances Collection
            $dayEndBalanceCollection = [];


            //These are all the array collections for all the different analysises completed by bank statements, we use this as an easy way to access all these objects.

            $incomeCollection = [];
            $benefitCollection = [];
            $loanCollection = [];
            $dishonourCollection = [];
            $gamblingCollection = [];
            $otherDebtsCollection = [];


            //for loop for transactions on the account.

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
            $dayEndBalances = $accountInfo->statementData->dayEndBalances;
            foreach ($dayEndBalances as $dayEndBalance) {
                $obj = new DayEndBalance($dayEndBalance->date, $dayEndBalance->balance);
                array_push($dayEndBalanceCollection, $obj);
            }


            //time to parse analysis arrays. woo


            //forloop to set correct

            foreach ($accountInfo->statementData->analysis as $analysisObjects) {
                //switch between the


                switch ($analysisObjects) {

                    case property_exists($analysisObjects, 'Wages') :
                        $incomeCollection = $this->processAnalysisObjects($analysisObjects, 'Income');
                        break;
                    case property_exists($analysisObjects, 'Pension'):
                        $benefitCollection = $this->processAnalysisObjects($analysisObjects, 'Benefits');
                        break;
                    case property_exists($analysisObjects, 'Home Loan'):
                        $loanCollection = $this->processAnalysisObjects($analysisObjects, 'Loans');
                        break;
                    case property_exists($analysisObjects, 'Dishonour'):
                        $dishonourCollection = $this->processAnalysisObjects($analysisObjects, 'Dishonours');
                        break;
                    case property_exists($analysisObjects, 'Casino'):
                        $gamblingCollection = $this->processAnalysisObjects($analysisObjects, 'Gambling');
                        break;
                    case property_exists($analysisObjects, 'SPER'):
                        $otherDebtsCollection = $this->processAnalysisObjects($analysisObjects, 'Other Debits');
                        break;

                    /*
                    Don't know if this needs to be here.

                    case property_exists($analysisObjects, 'Rent'):
                    $rentCollection = $this->processAnalysisObjects($analysisObjects, 'Rent');
                     * */
                }

            }


            //create new account here. TODO Constructor too big refractor later.
            $account = new Account($accountInfo->accountType, $accountInfo->name, $accountInfo->accountNumber, $accountInfo->id, $accountInfo->bsb, $accountInfo->balance, $accountInfo->accountHolder, $accountInfo->available);
            $account->setSlug($bankSlug);


            $statementData = new StatementData($accountInfo->statementData->totalCredits, $accountInfo->statementData->totalDebits, $accountInfo->statementData->openingBalance, $accountInfo->statementData->closingBalance, $accountInfo->statementData->startDate, $accountInfo->statementData->endDate, $accountInfo->statementData->minBalance, $accountInfo->statementData->maxBalance, $accountInfo->statementData->minDayEndBalance, $accountInfo->statementData->maxDayEndBalance, $accountInfo->statementData->daysInNegative, $accountInfo->statementData->errorMessage, $account, $bankSlug);


            //null check these rather than a large constructor.
            if ($transactionArray != null) {
                $statementData->setTransactionCollection(new TransactionCollection($transactionArray));
            }

            if ($dayEndBalanceCollection != null) {
                $statementData->setDayEndBalanceCollection(new DayEndBalanceCollection($dayEndBalanceCollection));
            }

            if ($incomeCollection != null)
                $statementData->setIncomeCollection(new AnalysisObjectCollection($incomeCollection));

            if ($benefitCollection != null)
                $statementData->setBenefitCollection(new AnalysisObjectCollection($benefitCollection));

            if ($dishonourCollection != null)
                $statementData->setDishonourColection(new AnalysisObjectCollection($dishonourCollection));

            if ($loanCollection != null)
                $statementData->setLoanCollection(new AnalysisObjectCollection($loanCollection));

            if ($gamblingCollection != null)
                $statementData->setGamblingCollection(new AnalysisObjectCollection($gamblingCollection));

            if ($otherDebtsCollection != null)
                $statementData->setOtherDebtsCollection(new AnalysisObjectCollection($otherDebtsCollection));


            //also push it to the account array.
            array_push($statements, $statementData);
        }

        //from here create the statement data collection and return.
        return new StatementDataCollection($statements);
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

    //use this function to remove duplicate code in the statement data function.
    public function processAnalysisObjects($analysisObjects, $name)
    {
        $analysisObjectsArray = [];

        foreach ($analysisObjects as $analysisObject) {

            $transactions = [];

            if (!property_exists($analysisObject, "firstTransaction")) {
                if ($analysisObject->transactionCount == 0) {
                    continue;
                }

            } else {
                $objectTransactions = $analysisObject->transactions;

                if (isset($objectTransactions) && count($objectTransactions) > 0) {

                    foreach ($objectTransactions as $transaction) {
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

                if ($analysisObject->transactionCount != 0) {

                    $object = new AnalysisObject($name, $analysisObject->transactionCount, $analysisObject->totalValue, $analysisObject->monthAvg, $analysisObject->minValue, $analysisObject->maxValue, $analysisObject->firstTransaction, $analysisObject->lastTransaction, $analysisObject->period, $analysisObject->periodIsRegular, new TransactionCollection($transactions));
                    array_push($analysisObjectsArray, $object);
                }
            }
        }

        return $analysisObjectsArray;
    }


    public function getLatestJsonError()
    {

        // Add this switch to your code
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                echo ' - No errors';
                break;
            case JSON_ERROR_DEPTH:
                echo ' - Maximum stack depth exceeded';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                echo ' - Underflow or the modes mismatch';
                break;
            case JSON_ERROR_CTRL_CHAR:
                echo ' - Unexpected control character found';
                break;
            case JSON_ERROR_SYNTAX:
                echo ' - Syntax error, malformed JSON';
                break;
            case JSON_ERROR_UTF8:
                echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
                break;
            default:
                echo ' - Unknown error';
                break;
        }
    }
}