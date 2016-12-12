<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 5/12/16
 * Time: 3:27 PM
 */

namespace BankStatement\Models\BankStatements\Response;


class InstitutionCaptcha extends InstitutionCredentials
{
    private $src;

    private $width;

    private $height;

    private $alt;


    public function __construct($name, $fieldID, $type, $description, $values, $keyboardType, $src, $width, $height, $alt)
    {
        /*
         * instantiate parent class and subclasses captcha properties.
         * */
        parent::__construct($name, $fieldID, $type, $description, $values, $keyboardType);
        $this->src = $src;
        $this->width = $width;
        $this->height = $height;
        $this->alt = $alt;
    }

    /**
     * @return mixed
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * @param mixed $src
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }

}