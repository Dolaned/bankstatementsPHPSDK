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
    private $requestNumDays;
    private $generate_raw_file;
    private $accountsIds;
    private $password;
    private $bankSlug;
    private $referralCode;



    public function __construct($bankSlug, $accountIds)
    {
        $this->accountsIds = $accountIds;
        $this->bankSlug = $bankSlug;
    }

    /**
     * @return mixed
     */
    public function getReferralCode()
    {
        return $this->referralCode;
    }

    /**
     * @param mixed $referralCode
     */
    public function setReferralCode($referralCode)
    {
        $this->referralCode = $referralCode;
    }

    /**
     * @return mixed
     */
    public function getBankSlug()
    {
        return $this->bankSlug;
    }

    /**
     * @param mixed $bankSlug
     */
    public function setBankSlug($bankSlug)
    {
        $this->bankSlug = $bankSlug;
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
     * @return mixed
     */
    public function getAccountsIds()
    {
        return $this->accountsIds;
    }

    /**
     * @param mixed $accountsIds
     */
    public function setAccountsIds($accountsIds)
    {
        $this->accountsIds = $accountsIds;
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