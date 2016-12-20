<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 20/12/16
 * Time: 6:12 PM
 */

namespace BankStatement\Models\BankStatements\Response;


class DateObject
{

    private $date;
    private $timezone_type;
    private $timezone;

    /**
     * DateObject constructor.
     * @param $date
     * @param $timezone_type
     * @param $timezone
     */
    public function __construct($date, $timezone_type, $timezone)
    {
        $this->date = $date;
        $this->timezone_type = $timezone_type;
        $this->timezone = $timezone;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getTimezoneType()
    {
        return $this->timezone_type;
    }

    /**
     * @param mixed $timezone_type
     */
    public function setTimezoneType($timezone_type)
    {
        $this->timezone_type = $timezone_type;
    }

    /**
     * @return mixed
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param mixed $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }


}