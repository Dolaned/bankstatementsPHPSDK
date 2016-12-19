<?php

namespace BankStatement\Models;
use BankStatement\Models\BankStatements\Login;
use BankStatement\Models\BankStatements\Logout;
use BankStatement\Models\BankStatements\Request\StatementDataRequest;
use BankStatement\Models\BankStatements\Response\Institution;

/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 17/11/16
 * Time: 1:19 AM
 */
interface BankStatementsInterface
{


    public function login(Login $login);

    public function logout();

    public function verifyAPI();

    public function listInstitutions($region);

    public function getLoginPreload($bankSlug);

    public function putLoginPreload(Institution $institution);

    public function getStatementData(StatementDataRequest $dataRequest);

    public function LoginAndGetAllStatements();

    public function retreiveFiles($userToken);
    
    

}