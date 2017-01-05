<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 20/12/16
 * Time: 10:55 PM
 */

namespace BankStatement\Models\BankStatements\Response;


class AnalysisObject
{

    private $name;
    private $transactionCount;
    private $totalValue;
    private $monthAvg;
    private $minValue;
    private $maxValue;
    private $firstTransaction;
    private $lastTransaction;
    private $period;
    private $periodIsRegular;
    private $transactions;

    /**
     * AnalysisObject constructor.
     * @param $name
     * @param $transactionCount
     * @param $totalValue
     * @param $monthAvg
     * @param $minValue
     * @param $maxValue
     * @param $firstTransaction
     * @param $lastTransaction
     * @param $period
     * @param $periodIsRegular
     * @param $transactions
     */
    public function __construct($name, $transactionCount, $totalValue, $monthAvg, $minValue, $maxValue, $firstTransaction, $lastTransaction, $period, $periodIsRegular, TransactionCollection $transactions)
    {
        $this->name = $name;
        $this->transactionCount = $transactionCount;
        $this->totalValue = $totalValue;
        $this->monthAvg = $monthAvg;
        $this->minValue = $minValue;
        $this->maxValue = $maxValue;
        $this->firstTransaction = $firstTransaction;
        $this->lastTransaction = $lastTransaction;
        $this->period = $period;
        $this->periodIsRegular = $periodIsRegular;
        $this->transactions = $transactions;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getTransactionCount()
    {
        return $this->transactionCount;
    }

    /**
     * @return mixed
     */
    public function getTotalValue()
    {
        return $this->totalValue;
    }

    /**
     * @return mixed
     */
    public function getMonthAvg()
    {
        return $this->monthAvg;
    }

    /**
     * @return mixed
     */
    public function getMinValue()
    {
        return $this->minValue;
    }

    /**
     * @return mixed
     */
    public function getMaxValue()
    {
        return $this->maxValue;
    }

    /**
     * @return mixed
     */
    public function getFirstTransaction()
    {
        return $this->firstTransaction;
    }

    /**
     * @return mixed
     */
    public function getLastTransaction()
    {
        return $this->lastTransaction;
    }

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @return mixed
     */
    public function getPeriodIsRegular()
    {
        return $this->periodIsRegular;
    }

    /**
     * @return TransactionCollection
     */
    public function getTransactions()
    {
        return $this->transactions;
    }


}