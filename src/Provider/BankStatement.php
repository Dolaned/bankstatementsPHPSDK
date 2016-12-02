<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 17/11/16
 * Time: 1:29 AM
 */

namespace BankStatement\Provider;

use BankStatement\Models\BankStatements\Login;
use BankStatement\Models\BankStatements\Logout;
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

        return $response;


    }

    public function logout(Logout $logout)
    {
        // TODO: Implement logout() method.
    }

    public function verifyAPI()
    {
        // TODO: Implement verifyAPI() method.
    }

    public function listInstitutions()
    {
        // TODO: Implement listInstitutions() method.
    }

    public function loginPreload($bankSlug)
    {
        // TODO: Implement loginPreload() method.
    }

    public function getStatementData($args)
    {
        // TODO: Implement getStatementData() method.
    }
}