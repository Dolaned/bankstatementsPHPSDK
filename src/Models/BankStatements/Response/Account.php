<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 17/11/16
 * Time: 2:35 AM
 */

namespace BankStatement\Models\BankStatements;


class Account
{
    private $name;
    private $slug;
    private $accountNumber;
    private $id;
    private $bsb;
    private $balance;
    private $available;
    private $accountHolder;
    private $accountType;


    /**
     * Account constructor.
     * @param $accountType
     * @param $name
     * @param $accountNumber
     * @param $id
     * @param $bsb
     * @param $balance
     * @param $available
     * @param $accountHolder
     */
    public function __construct($accountType = null, $name = null, $accountNumber = null, $id = null, $bsb = null, $balance = null,$accountHolder = null, $available = null)
    {
        $this->accountType = $accountType;
        $this->name = $name;
        $this->accountNumber = $accountNumber;
        $this->id = $id;
        $this->bsb = $bsb;
        $this->balance = $balance;
        $this->available = $available;
        $this->accountHolder = $accountHolder;
    }

    /**
     * @return mixed
     */
    public function getAccountHolder()
    {
        return $this->accountHolder;
    }

    /**
     * @param mixed $accountHolder
     */
    public function setAccountHolder($accountHolder)
    {
        $this->accountHolder = $accountHolder;
    }


    /**
     * @return mixed
     */
    public function getAccountType()
    {
        return $this->accountType;
    }

    /**
     * @param mixed $accountType
     */
    public function setAccountType($accountType)
    {
        $this->accountType = $accountType;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param mixed $accountNumber
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getBsb()
    {
        return $this->bsb;
    }

    /**
     * @param mixed $bsb
     */
    public function setBsb($bsb)
    {
        $this->bsb = $bsb;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return mixed
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @param mixed $available
     */
    public function setAvailable($available)
    {
        $this->available = $available;
    }


    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

}