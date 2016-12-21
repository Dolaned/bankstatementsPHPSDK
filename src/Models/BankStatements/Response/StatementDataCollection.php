<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 22/12/16
 * Time: 12:09 AM
 */

namespace BankStatement\Models\BankStatements\Response;


class StatementDataCollection
{
    /**
     * @var StatementData
     */
    private $statements;


    /**
     * @param StatementData[] $statements
     */

    public function __construct(array $statements = [])
    {
        $this->statements = array_values($statements);
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
        return count($this->statements);
    }
    /**
     * @return StatementData
     */
    public function first()
    {
        if (empty($this->statements)) {
            //throw new CollectionIsEmpty('The AddressCollection instance is empty.');
        }
        return reset($this->statements);
    }
    /**
     * @return StatementData[]
     */
    public function slice($offset, $length = null)
    {

        return array_slice($this->statements, $offset, $length);
    }
    /**
     * @return bool
     */
    public function has($index)
    {
        return isset($this->statements[$index]);
    }
    /**
     * @return StatementData
     * @throws \OutOfBoundsException
     */
    public function get($index)
    {
        if (!isset($this->statements[$index])) {
            throw new \OutOfBoundsException(sprintf('The index "%s" does not exist in this collection.', $index));
        }
        return $this->statements[$index];
    }
    /**
     * @return StatementData[]
     */
    public function all()
    {
        return $this->statements;
    }

}