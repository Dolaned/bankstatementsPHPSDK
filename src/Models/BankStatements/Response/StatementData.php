<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 20/12/16
 * Time: 5:11 PM
 */

namespace BankStatement\Models\BankStatements\Response;


use BankStatement\Models\BankStatements\Account;

class StatementData extends Account
{

    //Transaction collection
    private $transactionCollection;
    
    //Day End Balances Collection
    private $dayEndBalanceCollection;

    //income collection
    private $incomeCollection;
    private $benifitCollection;
    private $dishonourColection;
    private $rentCollection;
    //

    private $totalCredits;
    private $totalDebits;
    private $openingBalance;
    private $closingBalance;
    private $startDate;
    private $endDate;
    private $minBalance;
    private $maxBalance;

    private $minDayEndBalance;
    private $maxDayEndBalance;
    private $daysInNegative;
    private $errorMessage;

    /**
     * StatementData constructor.
     * @param $transactionCollection
     * @param $dayEndBalanceCollection
     * @param $incomeCollection
     * @param $benifitCollection
     * @param $dishonourColection
     * @param $rentCollection
     * @param $totalCredits
     * @param $totalDebits
     * @param $openingBalance
     * @param $closingBalance
     * @param $startDate
     * @param $endDate
     * @param $minBalance
     * @param $maxBalance
     * @param $minDayEndBalance
     * @param $maxDayEndBalance
     * @param $daysInNegative
     * @param $errorMessage
     * @param $account
     * @param $bankSlug
     */
    public function __construct(TransactionCollection $transactionCollection, DayEndBalanceCollection $dayEndBalanceCollection, AnalysisObjectCollection $incomeCollection, AnalysisObjectCollection $benifitCollection, AnalysisObjectCollection $dishonourColection, AnalysisObjectCollection $rentCollection, $totalCredits, $totalDebits, $openingBalance, $closingBalance, $startDate, $endDate, $minBalance, $maxBalance, $minDayEndBalance, $maxDayEndBalance, $daysInNegative, $errorMessage, Account $account, $bankSlug)
    {
        $this->transactionCollection = $transactionCollection;
        $this->dayEndBalanceCollection = $dayEndBalanceCollection;
        $this->incomeCollection = $incomeCollection;
        $this->benifitCollection = $benifitCollection;
        $this->dishonourColection = $dishonourColection;
        $this->rentCollection = $rentCollection;
        $this->totalCredits = $totalCredits;
        $this->totalDebits = $totalDebits;
        $this->openingBalance = $openingBalance;
        $this->closingBalance = $closingBalance;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->minBalance = $minBalance;
        $this->maxBalance = $maxBalance;
        $this->minDayEndBalance = $minDayEndBalance;
        $this->maxDayEndBalance = $maxDayEndBalance;
        $this->daysInNegative = $daysInNegative;
        $this->errorMessage = $errorMessage;

        parent::__construct($account->getAccountType(), $account->getName(), $account->getAccountNumber(), $account->getId(),$account->getBsb(), $account->getBalance(), $account->getAvailable());
        parent::setSlug($bankSlug);
    }

    /**
     * @return TransactionCollection
     */
    public function getTransactionCollection()
    {
        return $this->transactionCollection;
    }

    /**
     * @param TransactionCollection $transactionCollection
     */
    public function setTransactionCollection($transactionCollection)
    {
        $this->transactionCollection = $transactionCollection;
    }

    /**
     * @return DayEndBalanceCollection
     */
    public function getDayEndBalanceCollection()
    {
        return $this->dayEndBalanceCollection;
    }

    /**
     * @param DayEndBalanceCollection $dayEndBalanceCollection
     */
    public function setDayEndBalanceCollection($dayEndBalanceCollection)
    {
        $this->dayEndBalanceCollection = $dayEndBalanceCollection;
    }

    /**
     * @return AnalysisObjectCollection
     */
    public function getIncomeCollection()
    {
        return $this->incomeCollection;
    }

    /**
     * @param AnalysisObjectCollection $incomeCollection
     */
    public function setIncomeCollection($incomeCollection)
    {
        $this->incomeCollection = $incomeCollection;
    }

    /**
     * @return AnalysisObjectCollection
     */
    public function getBenifitCollection()
    {
        return $this->benifitCollection;
    }

    /**
     * @param AnalysisObjectCollection $benifitCollection
     */
    public function setBenifitCollection($benifitCollection)
    {
        $this->benifitCollection = $benifitCollection;
    }

    /**
     * @return AnalysisObjectCollection
     */
    public function getDishonourColection()
    {
        return $this->dishonourColection;
    }

    /**
     * @param AnalysisObjectCollection $dishonourColection
     */
    public function setDishonourColection($dishonourColection)
    {
        $this->dishonourColection = $dishonourColection;
    }

    /**
     * @return AnalysisObjectCollection
     */
    public function getRentCollection()
    {
        return $this->rentCollection;
    }

    /**
     * @param AnalysisObjectCollection $rentCollection
     */
    public function setRentCollection($rentCollection)
    {
        $this->rentCollection = $rentCollection;
    }

    /**
     * @return null
     */
    public function getTotalCredits()
    {
        return $this->totalCredits;
    }

    /**
     * @param null $totalCredits
     */
    public function setTotalCredits($totalCredits)
    {
        $this->totalCredits = $totalCredits;
    }

    /**
     * @return mixed
     */
    public function getTotalDebits()
    {
        return $this->totalDebits;
    }

    /**
     * @param mixed $totalDebits
     */
    public function setTotalDebits($totalDebits)
    {
        $this->totalDebits = $totalDebits;
    }

    /**
     * @return mixed
     */
    public function getOpeningBalance()
    {
        return $this->openingBalance;
    }

    /**
     * @param mixed $openingBalance
     */
    public function setOpeningBalance($openingBalance)
    {
        $this->openingBalance = $openingBalance;
    }

    /**
     * @return mixed
     */
    public function getClosingBalance()
    {
        return $this->closingBalance;
    }

    /**
     * @param mixed $closingBalance
     */
    public function setClosingBalance($closingBalance)
    {
        $this->closingBalance = $closingBalance;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getMinBalance()
    {
        return $this->minBalance;
    }

    /**
     * @param mixed $minBalance
     */
    public function setMinBalance($minBalance)
    {
        $this->minBalance = $minBalance;
    }

    /**
     * @return mixed
     */
    public function getMaxBalance()
    {
        return $this->maxBalance;
    }

    /**
     * @param mixed $maxBalance
     */
    public function setMaxBalance($maxBalance)
    {
        $this->maxBalance = $maxBalance;
    }

    /**
     * @return mixed
     */
    public function getMinDayEndBalance()
    {
        return $this->minDayEndBalance;
    }

    /**
     * @param mixed $minDayEndBalance
     */
    public function setMinDayEndBalance($minDayEndBalance)
    {
        $this->minDayEndBalance = $minDayEndBalance;
    }

    /**
     * @return mixed
     */
    public function getMaxDayEndBalance()
    {
        return $this->maxDayEndBalance;
    }

    /**
     * @param mixed $maxDayEndBalance
     */
    public function setMaxDayEndBalance($maxDayEndBalance)
    {
        $this->maxDayEndBalance = $maxDayEndBalance;
    }

    /**
     * @return mixed
     */
    public function getDaysInNegative()
    {
        return $this->daysInNegative;
    }

    /**
     * @param mixed $daysInNegative
     */
    public function setDaysInNegative($daysInNegative)
    {
        $this->daysInNegative = $daysInNegative;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param mixed $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    


}
