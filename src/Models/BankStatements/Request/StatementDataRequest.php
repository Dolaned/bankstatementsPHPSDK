<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 20/12/16
 * Time: 4:33 AM
 */

namespace BankStatement\Models\BankStatements\Request;


use BankStatement\Models\BankStatements\Response\AccountCollection;

class StatementDataRequest
{
    private $requestNumDays;
    private $generate_raw_file;
    private $accounts;
    private $password;

    public function __construct(AccountCollection $accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * @return mixed
     */
    public function getRequestNumDays()
    {
        return $this->requestNumDays;
    }

    /**
     * @param mixed $requestNumDays
     */
    public function setRequestNumDays($requestNumDays)
    {
        $this->requestNumDays = $requestNumDays;
    }

    /**
     * @return mixed
     */
    public function getGenerateRawFile()
    {
        return $this->generate_raw_file;
    }

    /**
     * @param mixed $generate_raw_file
     */
    public function setGenerateRawFile($generate_raw_file)
    {
        $this->generate_raw_file = $generate_raw_file;
    }

    /**
     * @return AccountCollection
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param array $accounts
     */
    public function setAccounts($accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



}