<?php

/*
 * This file is part of the Evispa package.
 *
 * (c) Evispa <php@evispa.lt>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evispa\Component\Testing\Mock\Doctrine\ORM;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Darius Krištapavičius <darius@evispa.lt>
 */
class MockObjectManager implements ObjectManager
{
    /**
     * List of persisted objects
     *
     * @var array
     */
    private $persisted = array();

    /**
     * List of removed objects
     *
     * @var array
     */
    private $removed = array();

    /**
     * @var AbstractMockRepository[]
     */
    protected $repositories = array();

    /**
     * Add mock repository
     *
     * @param string                 $className
     * @param AbstractMockRepository $repo
     */
    public function addRepository($className, AbstractMockRepository $repo)
    {
        $this->repositories[$className] = $repo;
    }

    /**
     * Finds a object by its identifier.
     *
     * This is just a convenient shortcut for getRepository($className)->find($id).
     *
     * @param string $className The class name of the object to find.
     * @param mixed  $id        The identity of the object to find.
     *
     * @return object The found object.
     */
    public function find($className, $id)
    {
        return $this->getRepository($className)->find($id);
    }

    /**
     * Tells the ObjectManager to make an instance managed and persistent.
     *
     * The object will be entered into the database as a result of the flush operation.
     *
     * NOTE: The persist operation always considers objects that are not yet known to
     * this ObjectManager as NEW. Do not pass detached objects to the persist operation.
     *
     * @param object $object The instance to make managed and persistent.
     *
     * @return void
     */
    public function persist($object)
    {
        if (false === in_array($object, $this->persisted, true)) {
            $this->persisted[] = $object;
        }
    }

    /**
     * Removes an object instance.
     *
     * A removed object will be removed from the database as a result of the flush operation.
     *
     * @param object $object The object instance to remove.
     *
     * @return void
     */
    public function remove($object)
    {
        if (false === in_array($object, $this->removed, true)) {
            $this->removed[] = $object;
        }
    }

    /**
     * Merges the state of a detached object into the persistence context
     * of this ObjectManager and returns the managed copy of the object.
     * The object passed to merge will not become associated/managed with this ObjectManager.
     *
     * @param object $object
     *
     * @return object
     */
    public function merge($object)
    {
        // TODO: Implement merge() method.
    }

    /**
     * Clears the ObjectManager. All objects that are currently managed
     * by this ObjectManager become detached.
     *
     * @param string|null $objectName if given, only objects of this type will get detached.
     *
     * @return void
     */
    public function clear($objectName = null)
    {
        foreach ($this->repositories as $repository) {
            if (($repository->getClassName() === $objectName) || (null === $objectName)) {
                $repository->objects = array();
            }
        }

        if (null === $objectName) {
            $this->persisted = array();
            $this->removed = array();
        } else {
            foreach ($this->persisted as $key => $persist) {
                if (get_class($persist) === $objectName) {
                    unset($this->persisted[$key]);
                }
            }

            foreach ($this->removed as $key => $remove) {
                if (get_class($remove) === $objectName) {
                    unset($this->removed[$key]);
                }
            }
        }
    }

    /**
     * Detaches an object from the ObjectManager, causing a managed object to
     * become detached. Unflushed changes made to the object if any
     * (including removal of the object), will not be synchronized to the database.
     * Objects which previously referenced the detached object will continue to
     * reference it.
     *
     * @param object $object The object to detach.
     *
     * @return void
     */
    public function detach($object)
    {
        // TODO: Implement detach() method.
    }

    /**
     * Refreshes the persistent state of an object from the database,
     * overriding any local changes that have not yet been persisted.
     *
     * @param object $object The object to refresh.
     *
     * @return void
     */
    public function refresh($object)
    {
        // TODO: Implement refresh() method.
    }

    /**
     * Flushes all changes to objects that have been queued up to now to the database.
     * This effectively synchronizes the in-memory state of managed objects with the
     * database.
     *
     * @return void
     */
    public function flush()
    {
        foreach ($this->repositories as $repository) {
            foreach ($this->persisted as $object) {
                if ($repository->getClassName() === get_class($object)) {
                    $repository->addObject($object);
                }
            }

            foreach ($this->removed as $object) {
                if ($repository->getClassName() === get_class($object)) {
                    $repository->removeObject($object);
                }
            }
        }

        $this->persisted = array();
        $this->removed = array();
    }

    /**
     * Gets the repository for a class.
     *
     * @param string $className
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     *
     * @throws \LogicException
     */
    public function getRepository($className)
    {
        if (true === isset($this->repositories[$className])) {
            return $this->repositories[$className];
        }

        throw new \LogicException('Not found repository ' . $className);
    }

    /**
     * Returns the ClassMetadata descriptor for a class.
     *
     * The class name must be the fully-qualified class name without a leading backslash
     * (as it is returned by get_class($obj)).
     *
     * @param string $className
     *
     * @return \Doctrine\Common\Persistence\Mapping\ClassMetadata
     */
    public function getClassMetadata($className)
    {
        // TODO: Implement getClassMetadata() method.
    }

    /**
     * Gets the metadata factory used to gather the metadata of classes.
     *
     * @return \Doctrine\Common\Persistence\Mapping\ClassMetadataFactory
     */
    public function getMetadataFactory()
    {
        // TODO: Implement getMetadataFactory() method.
    }

    /**
     * Helper method to initialize a lazy loading proxy or persistent collection.
     *
     * This method is a no-op for other objects.
     *
     * @param object $obj
     *
     * @return void
     */
    public function initializeObject($obj)
    {
        // TODO: Implement initializeObject() method.
    }

    /**
     * Checks if the object is part of the current UnitOfWork and therefore managed.
     *
     * @param object $object
     *
     * @return bool
     */
    public function contains($object)
    {
        return in_array($object, $this->persisted, true);
    }
}
