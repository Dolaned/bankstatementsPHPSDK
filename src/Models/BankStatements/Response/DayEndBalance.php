<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 20/12/16
 * Time: 6:29 PM
 */

namespace BankStatement\Models\BankStatements\Response;


class DayEndBalance
{
    private $date;
    private $balance;

    /**
     * DayEndBalance constructor.
     * @param $date
     * @param $balance
     */
    public function __construct($date, $balance)
    {
        $this->date = $date;
        $this->balance = $balance;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }
}