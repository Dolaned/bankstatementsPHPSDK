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

    private $APIKey;

    private $isTest;

    private $client;

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
    }

    public function buildQuery($input){

    }

    public function executeQuery($query){

        //add any other headers to the query.
        $query = $this->buildQuery($query);
    }

    public function login(Login $login)
    {

        $query = sprintf(
            $this->isTest ? self::ENDPOINT_URL_TEST : self::ENDPOINT_URL,
            rawurlencode($login)
        );

        return $this->executeQuery($query);
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