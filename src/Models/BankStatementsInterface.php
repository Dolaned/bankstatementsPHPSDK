<?php

namespace BankStatement\Models;
use BankStatement\Models\BankStatements\Login;
use BankStatement\Models\BankStatements\Logout;

/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 17/11/16
 * Time: 1:19 AM
 */
interface BankStatementsInterface
{


    public function login(Login $login);

    public function logout(Logout $logout);

    public function verifyAPI();

    public function listInstitutions();

    public function loginPreload($bankSlug);

    public function getStatementData($args);

    public function retreiveFiles($userToken);
    
    

}