<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 15/1/17
 * Time: 11:51 PM
 */

namespace BankStatement\Exception;


use Exception;

class EmptyJsonStringException extends \Exception
{

    public function __construct($message, $code, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }
}