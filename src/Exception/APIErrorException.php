<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 12/3/17
 * Time: 8:07 PM
 */

namespace BankStatement\Exception;


class APIErrorException extends \Exception
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