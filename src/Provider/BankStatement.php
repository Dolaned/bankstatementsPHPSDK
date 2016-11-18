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
use GuzzleHttp\Cookie\CookieJar;

class BankStatement implements BankStatementsInterface
{

    private $APIKey;

    private $isTest;

    private $client;

    private $cookieJar;

    /**
     * @var string
     */
    const ENDPOINT_URL = 'https://www.bankstatements.com.au/api/v1/';
    /**
     * @var string
     */
    const ENDPOINT_URL_TEST = 'https://test.bankstatements.com.au/api/v1/';


    public function __construct($apikey, $test = false)
    {
        $this->APIKey = $apikey;
        $this->isTest = $test;
        $this->cookieJar = new CookieJar();
    }

    //builds Guzzle Client and returns it
    public function buildClient(){

        $url = $this->isTest ? self::ENDPOINT_URL_TEST : self::ENDPOINT_URL;
        $client = new Client(['base_uri' => $url]);
        
        return $client;
    }

    public function executeQuery($location, $body){

        //build the Http client
        $this->client = $this->buildClient();

        //make the call
        return $this->client->request('GET', $location, [
            'headers' => [
                'X-API-KEY' => $this->APIKey,
                'Content-Type'     => 'application/json'
            ],
            'body' =>[
                $body
            ]
        ]);
    }

    public function login(Login $login)
    {

        $body = $login->toJSON();
        $this->cookieJar = new CookieJar('ASESSIONID');
        return $this->executeQuery('/login',$body);
        
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