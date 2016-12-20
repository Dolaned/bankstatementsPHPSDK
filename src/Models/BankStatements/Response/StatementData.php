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
}
