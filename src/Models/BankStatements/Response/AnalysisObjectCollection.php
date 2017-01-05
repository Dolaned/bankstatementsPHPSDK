<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 20/12/16
 * Time: 10:55 PM
 */

namespace BankStatement\Models\BankStatements\Response;


use BankStatement\Exception\CollectionIsEmpty;

class AnalysisObjectCollection
{
    /**
     * @var AnalysisObject
     */
    private $analysisObjects;
    private $transactionCount;
    private $totalValue;
    private $monthAvg;

    /**
     * @return mixed
     */
    public function getTransactionCount()
    {
        return $this->transactionCount;
    }

    /**
     * @param mixed $transactionCount
     */
    public function setTransactionCount($transactionCount)
    {
        $this->transactionCount = $transactionCount;
    }

    /**
     * @return mixed
     */
    public function getTotalValue()
    {
        return $this->totalValue;
    }

    /**
     * @param mixed $totalValue
     */
    public function setTotalValue($totalValue)
    {
        $this->totalValue = $totalValue;
    }

    /**
     * @return mixed
     */
    public function getMonthAvg()
    {
        return $this->monthAvg;
    }

    /**
     * @param mixed $monthAvg
     */
    public function setMonthAvg($monthAvg)
    {
        $this->monthAvg = $monthAvg;
    }


    /**
     * @param AnalysisObject[] $analysisObjects
     */

    public function __construct(array $analysisObjects = [])
    {
        $this->analysisObjects = array_values($analysisObjects);
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->all());
    }
    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return count($this->analysisObjects);
    }

    /**
     * @return AnalysisObject
     * @throws CollectionIsEmpty
     */
    public function first()
    {
        if (empty($this->analysisObjects)) {
            //throw new CollectionIsEmpty('The AddressCollection instance is empty.', 369 ,new \Exception());
        }
        return reset($this->analysisObjects);
    }
    /**
     * @return AnalysisObject[]
     */
    public function slice($offset, $length = null)
    {

        return array_slice($this->analysisObjects, $offset, $length);
    }
    /**
     * @return bool
     */
    public function has($index)
    {
        return isset($this->analysisObjects[$index]);
    }
    /**
     * @return AnalysisObject
     * @throws \OutOfBoundsException
     */
    public function get($index)
    {
        if (!isset($this->analysisObjects[$index])) {
            throw new \OutOfBoundsException(sprintf('The index "%s" does not exist in this collection.', $index));
        }
        return $this->analysisObjects[$index];
    }
    /**
     * @return AnalysisObject[]
     */
    public function all()
    {
        return $this->analysisObjects;
    }

}