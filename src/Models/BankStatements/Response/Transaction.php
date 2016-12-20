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
}