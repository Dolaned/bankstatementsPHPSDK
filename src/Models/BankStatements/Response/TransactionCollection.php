<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 20/12/16
 * Time: 6:20 PM
 */

namespace BankStatement\Models\BankStatements\Response;


class TransactionCollection
{

    /**
     * @var Transaction
     */
    private $transactions;


    /**
     * @param Transaction[] $transactions
     */

    public function __construct(array $transactions = [])
    {
        $this->transactions = array_values($transactions);
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
        return count($this->transactions);
    }
    /**
     * @return Institution
     */
    public function first()
    {
        if (empty($this->transactions)) {
            //throw new CollectionIsEmpty('The AddressCollection instance is empty.');
        }
        return reset($this->transactions);
    }
    /**
     * @return Institution[]
     */
    public function slice($offset, $length = null)
    {

        return array_slice($this->transactions, $offset, $length);
    }
    /**
     * @return bool
     */
    public function has($index)
    {
        return isset($this->transactions[$index]);
    }
    /**
     * @return Institution
     * @throws \OutOfBoundsException
     */
    public function get($index)
    {
        if (!isset($this->transactions[$index])) {
            throw new \OutOfBoundsException(sprintf('The index "%s" does not exist in this collection.', $index));
        }
        return $this->transactions[$index];
    }
    /**
     * @return Institution[]
     */
    public function all()
    {
        return $this->transactions;
    }
}