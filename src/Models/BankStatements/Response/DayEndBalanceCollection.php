<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 20/12/16
 * Time: 6:29 PM
 */

namespace BankStatement\Models\BankStatements\Response;


class DayEndBalanceCollection
{

    /**
     * @var DayEndBalance
     */
    private $dayEndBalances;


    /**
     * @param DayEndBalance[] $dayEndBalances
     */

    public function __construct(array $dayEndBalances = [])
    {
        $this->dayEndBalances = array_values($dayEndBalances);
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
        return count($this->dayEndBalances);
    }
    /**
     * @return DayEndBalance
     */
    public function first()
    {
        if (empty($this->dayEndBalances)) {
            //throw new CollectionIsEmpty('The AddressCollection instance is empty.');
        }
        return reset($this->dayEndBalances);
    }
    /**
     * @return DayEndBalance[]
     */
    public function slice($offset, $length = null)
    {

        return array_slice($this->dayEndBalances, $offset, $length);
    }
    /**
     * @return bool
     */
    public function has($index)
    {
        return isset($this->dayEndBalances[$index]);
    }
    /**
     * @return DayEndBalance
     * @throws \OutOfBoundsException
     */
    public function get($index)
    {
        if (!isset($this->dayEndBalances[$index])) {
            throw new \OutOfBoundsException(sprintf('The index "%s" does not exist in this collection.', $index));
        }
        return $this->dayEndBalances[$index];
    }
    /**
     * @return DayEndBalance[]
     */
    public function all()
    {
        return $this->dayEndBalances;
    }

}