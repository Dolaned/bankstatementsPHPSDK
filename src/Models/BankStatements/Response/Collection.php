<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 28/2/17
 * Time: 8:33 PM
 */

namespace BankStatement\Models\BankStatements\Response;

trait Collection
{
    /**
     * @var \stdClass[]
     */
    private $objects;


    /**
     * @param array $objects
     * @internal param \stdClass[] $objects
     */

    public function __construct(array $objects = [])
    {
        $this->accounts = array_values($objects);
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
        return count($this->accounts);
    }
    /**
     * @return \stdClass
     */
    public function first()
    {
        if (empty($this->objects)) {
            //throw new CollectionIsEmpty('The AddressCollection instance is empty.');
        }
        return reset($this->objects);
    }
    /**
     * @return \stdClass[] $objects[]
     */
    public function slice($offset, $length = null)
    {

        return array_slice($this->objects, $offset, $length);
    }
    /**
     * @return bool
     */
    public function has($index)
    {
        return isset($this->objects[$index]);
    }

    /**
     * @param $index
     * @return \stdClass
     */
    public function get($index)
    {
        if (!isset($this->objects[$index])) {
            throw new \OutOfBoundsException(sprintf('The index "%s" does not exist in this collection.', $index));
        }
        return $this->objects[$index];
    }
    /**
     * @return \stdClass[]
     */
    public function all()
    {
        return $this->objects;
    }

}