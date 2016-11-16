<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 17/11/16
 * Time: 2:38 AM
 */

namespace BankStatement\Models\BankStatements\Response;


use BankStatement\Models\BankStatements\Account;

class AccountCollection
{
    private $items = array();

    public function addItem(Account $obj, $key = null) {
    }

    public function deleteItem($key) {
    }

    public function getItem($key) {
    }
}