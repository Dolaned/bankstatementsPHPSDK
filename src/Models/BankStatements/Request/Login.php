<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 17/11/16
 * Time: 2:15 AM
 */

namespace BankStatement\Models\BankStatements;


class Login
{

    /*
     * @var string
     * 
     * */
    private $institution;

    /*
     * @var string
     *
     * */

    private $username;


    /*
     * @var string
     *
     * */

    private $password;

    public function __construct($i, $u, $p){
        $this->institution = $i;
        $this->username =$u;
        $this->password = $p;
    }
}