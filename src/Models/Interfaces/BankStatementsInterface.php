<?php

namespace BankStatement\Models\Interfaces;
use BankStatement\Models\BankStatements\Login;
use BankStatement\Models\BankStatements\Logout;
use BankStatement\Models\BankStatements\Request\StatementDataRequest;
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 17/11/16
 * Time: 1:19 AM
 */
interface BankStatementsInterface
{


    public function login(Login $login, $userToken = null);

    public function logout(Logout $logout);

    public function verifyAPI();

    public function listInstitutions($region);

    public function getLoginPreload($bankSlug);

    public function putLoginPreload($bankSlug);

    public function getStatementData($userToken, StatementDataRequest $dataRequest);

    public function loginAndGetAllStatements(Login $login, StatementDataRequest $statementDataRequest, $userToken = null);

    public function retrieveFiles($userToken);
    
    

}