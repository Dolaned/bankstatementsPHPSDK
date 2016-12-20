<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 5/12/16
 * Time: 4:31 PM
 */

namespace BankStatement\Models\BankStatements\Response;


class Transaction
{

    private $dateObject;
    
    private $date;

    private $text;

    private $amount;

    private $type;

    private $balance;

    private $tags = [];

    /**
     * Transaction constructor.
     * @param $dateObject
     * @param $date
     * @param $text
     * @param $amount
     * @param $type
     * @param $balance
     * @param array $tags
     */
    public function __construct(DateObject $dateObject, $date, $text, $amount, $type, $balance, array $tags)
    {
        $this->dateObject = $dateObject;
        $this->date = $date;
        $this->text = $text;
        $this->amount = $amount;
        $this->type = $type;
        $this->balance = $balance;
        $this->tags = $tags;
    }


    /**
     * @return DateObject
     */
    public function getDateObject()
    {
        return $this->dateObject;
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
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }


}