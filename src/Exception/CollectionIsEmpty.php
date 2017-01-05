<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 5/1/17
 * Time: 1:17 AM
 */

namespace BankStatement\Exception;


use Exception;

class CollectionIsEmpty extends \Exception
{
    public function __construct($message, $code, Exception $previous)
    {
        parent::__construct($message, $code, $previous);
    }

}