<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 2/12/16
 * Time: 11:07 PM
 */

namespace BankStatement\Models\BankStatements\Response;


class InstitutionCollection
{
    /**
     * @var Institutions
     */
    private $institutions;


    /**
     * @param Institutions[] $addresses
     */

    public function __construct(array $institions = [])
    {
        $this->institutions = array_values($institions);
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
        return count($this->institutions);
    }
    /**
     * @return Institutions
     */
    public function first()
    {
        if (empty($this->institutions)) {
            //throw new CollectionIsEmpty('The AddressCollection instance is empty.');
        }
        return reset($this->institutions);
    }
    /**
     * @return Institutions[]
     */
    public function slice($offset, $length = null)
    {

        return array_slice($this->institutions, $offset, $length);
    }
    /**
     * @return bool
     */
    public function has($index)
    {
        return isset($this->institutions[$index]);
    }
    /**
     * @return Institutions
     * @throws \OutOfBoundsException
     */
    public function get($index)
    {
        if (!isset($this->institutions[$index])) {
            throw new \OutOfBoundsException(sprintf('The index "%s" does not exist in this collection.', $index));
        }
        return $this->institutions[$index];
    }
    /**
     * @return Institutions[]
     */
    public function all()
    {
        return $this->institutions;
    }
}