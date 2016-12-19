<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 20/12/16
 * Time: 4:33 AM
 */

namespace BankStatement\Models\BankStatements\Request;


class StatementDataRequest
{
    private $numOfDays;
    private $rawData;
    private $accounts = array();
    private $password;

    public function __construct($accounts = array())
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
     * @return mixed
     */
    public function getRawData()
    {
        return $this->rawData;
    }

    /**
     * @return array
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @return mixed
     */
    public function getNumOfDays()
    {
        return $this->numOfDays;
    }

    /**
     * @param mixed $numOfDays
     */
    public function setNumOfDays($numOfDays)
    {
        $this->numOfDays = $numOfDays;
    }

    /**
     * @param mixed $rawData
     */
    public function setRawData($rawData)
    {
        $this->rawData = $rawData;
    }

    /**
     * @param array $accounts
     */
    public function setAccounts($accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


}