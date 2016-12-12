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
use BankStatement\Models\BankStatements\Logout;
use BankStatement\Models\BankStatements\Response\AccountCollection;
use BankStatement\Models\BankStatements\Response\Institution;
use BankStatement\Models\BankStatements\Response\InstitutionCaptcha;
use BankStatement\Models\BankStatements\Response\InstitutionCollection;
use BankStatement\Models\BankStatements\Response\InstitutionCredentials;
use BankStatement\Models\BankStatementsInterface;
use GuzzleHttp\Client;

class BankStatement implements BankStatementsInterface
{

    private $accessToken;

    private $isTest;

    private $guzzleClient;

    private $cookieJar;


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

        $bankSlug = $login->getInstitution();

        $json = json_decode($content);

        if (!isset($json)) {
            echo "json is null";

        }

        if (isset($json->accounts)) {

        }
        $accounts = [];

        foreach ($json->accounts as $account) {
            $acc = new Account($account->accountType, $account->name, $account->accountNumber, $account->id, $account->bsb, $account->balance, $account->available);
            $acc->setSlug($bankSlug);
            array_push($accounts, $acc);
        }
        return new AccountCollection($accounts);

    }

    public function logout(Logout $logout)
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

    public function listInstitutions($region = null)
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


    public function getStatementData($args)
    {

        $response = $this->guzzleClient->request('POST', 'statements', ['query' => ['institution' => $bankSlug]]);
        $content = $response->getBody();
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