<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 17/11/16
 * Time: 2:16 AM
 */

namespace BankStatement\Models\BankStatements;


class Logout
{
    /*
     * @var string
     * User Token is all that is needed to logout.
     *
     * */
    private $userToken;

    public function __construct($tok)
    {
        $this->userToken = $tok;
    }
}