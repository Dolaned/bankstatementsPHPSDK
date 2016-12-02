<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 2/12/16
 * Time: 11:07 PM
 */

namespace BankStatement\Models\BankStatements\Response;


class InstitutionCredentials
{

    private $name;
    
    private $fieldID;
    
    private $type;
    
    private $description;
    
    private $values;
    
    private $keyboardType;

    /**
     * InstitutionCredentials constructor.
     * @param $name
     * @param $fieldID
     * @param $type
     * @param $description
     * @param $values
     * @param $keyboardType
     */
    public function __construct($name = null, $fieldID = null, $type = null, $description = null, $values = null, $keyboardType = null)
    {
        $this->name = $name;
        $this->fieldID = $fieldID;
        $this->type = $type;
        $this->description = $description;
        $this->values = $values;
        $this->keyboardType = $keyboardType;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getFieldID()
    {
        return $this->fieldID;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @return mixed
     */
    public function getKeyboardType()
    {
        return $this->keyboardType;
    }


}