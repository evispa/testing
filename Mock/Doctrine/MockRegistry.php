<?php

/*
 * This file is part of the Evispa package.
 *
 * (c) Evispa <info@evispa.lt>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evispa\Component\Testing\Mock\Doctrine;

use Doctrine\ORM\EntityManager;
use Evispa\Component\Testing\Mock\Doctrine\ORM\AbstractMockRepository;
use Evispa\Component\Testing\Mock\Doctrine\ORM\MockObjectManager;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @author Tadas Gliaubicas <tadas@evispa.lt>
 * 
 * @since 12/2/13 11:47 AM
 */
class MockRegistry implements RegistryInterface
{

    /**
     * @var MockObjectManager
     */
    private $mockObjectManager;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->mockObjectManager = new MockObjectManager();
    }

    /**
     * Add repository.
     *
     * @param string $className
     * @param AbstractMockRepository $repository
     */
    public function addRepository($className, AbstractMockRepository $repository)
    {
        $this->mockObjectManager->addRepository($className, $repository);
    }

    /**
     * Gets the default connection name.
     *
     * @return string The default connection name.
     */
    public function getDefaultConnectionName()
    {
        // TODO: Implement getDefaultConnectionName() method.
    }

    /**
     * Gets the named connection.
     *
     * @param string $name The connection name (null for the default one).
     *
     * @return object
     */
    public function getConnection($name = null)
    {
        // TODO: Implement getConnection() method.
    }

    /**
     * Gets an array of all registered connections.
     *
     * @return array An array of Connection instances.
     */
    public function getConnections()
    {
        // TODO: Implement getConnections() method.
    }

    /**
     * Gets all connection names.
     *
     * @return array An array of connection names.
     */
    public function getConnectionNames()
    {
        // TODO: Implement getConnectionNames() method.
    }

    /**
     * Gets the default object manager name.
     *
     * @return string The default object manager name.
     */
    public function getDefaultManagerName()
    {
        // TODO: Implement getDefaultManagerName() method.
    }

    /**
     * Gets a named object manager.
     *
     * @param string $name The object manager name (null for the default one).
     *
     * @return MockObjectManager
     */
    public function getManager($name = null)
    {
        return $this->mockObjectManager;
    }

    /**
     * Gets an array of all registered object managers.
     *
     * @return MockObjectManager[] An array of ObjectManager instances
     */
    public function getManagers()
    {
        // TODO: Implement getManagers() method.
    }

    /**
     * Resets a named object manager.
     *
     * This method is useful when an object manager has been closed
     * because of a rollbacked transaction AND when you think that
     * it makes sense to get a new one to replace the closed one.
     *
     * Be warned that you will get a brand new object manager as
     * the existing one is not useable anymore. This means that any
     * other object with a dependency on this object manager will
     * hold an obsolete reference. You can inject the registry instead
     * to avoid this problem.
     *
     * @param string|null $name The object manager name (null for the default one).
     *
     * @return MockObjectManager
     */
    public function resetManager($name = null)
    {
        // TODO: Implement resetManager() method.
    }

    /**
     * Resolves a registered namespace alias to the full namespace.
     *
     * This method looks for the alias in all registered object managers.
     *
     * @param string $alias The alias.
     *
     * @return string The full namespace.
     */
    public function getAliasNamespace($alias)
    {
        // TODO: Implement getAliasNamespace() method.
    }

    /**
     * Gets all connection names.
     *
     * @return array An array of connection names.
     */
    public function getManagerNames()
    {
        // TODO: Implement getManagerNames() method.
    }

    /**
     * Gets the ObjectRepository for an persistent object.
     *
     * @param string $persistentObjectName  The name of the persistent object.
     * @param string $persistentManagerName The object manager name (null for the default one).
     *
     * @return AbstractMockRepository
     */
    public function getRepository($persistentObjectName, $persistentManagerName = null)
    {
        return $this->mockObjectManager->getRepository($persistentObjectName);
    }

    /**
     * Gets the object manager associated with a given class.
     *
     * @param string $class A persistent object class name.
     *
     * @return MockObjectManager|null
     */
    public function getManagerForClass($class)
    {
        // TODO: Implement getManagerForClass() method.
    }

    /**
     * Gets the default entity manager name.
     *
     * @return string The default entity manager name
     */
    public function getDefaultEntityManagerName()
    {
        // TODO: Implement getDefaultEntityManagerName() method.
    }

    /**
     * Gets a named entity manager.
     *
     * @param string $name The entity manager name (null for the default one)
     *
     * @return EntityManager
     */
    public function getEntityManager($name = null)
    {
        // TODO: Implement getEntityManager() method.
    }

    /**
     * Gets an array of all registered entity managers
     *
     * @return array An array of EntityManager instances
     */
    public function getEntityManagers()
    {
        // TODO: Implement getEntityManagers() method.
    }

    /**
     * Resets a named entity manager.
     *
     * This method is useful when an entity manager has been closed
     * because of a rollbacked transaction AND when you think that
     * it makes sense to get a new one to replace the closed one.
     *
     * Be warned that you will get a brand new entity manager as
     * the existing one is not useable anymore. This means that any
     * other object with a dependency on this entity manager will
     * hold an obsolete reference. You can inject the registry instead
     * to avoid this problem.
     *
     * @param string $name The entity manager name (null for the default one)
     *
     * @return EntityManager
     */
    public function resetEntityManager($name = null)
    {
        // TODO: Implement resetEntityManager() method.
    }

    /**
     * Resolves a registered namespace alias to the full namespace.
     *
     * This method looks for the alias in all registered entity managers.
     *
     * @param string $alias The alias
     *
     * @return string The full namespace
     *
     * @see Configuration::getEntityNamespace
     */
    public function getEntityNamespace($alias)
    {
        // TODO: Implement getEntityNamespace() method.
    }

    /**
     * Gets all connection names.
     *
     * @return array An array of connection names
     */
    public function getEntityManagerNames()
    {
        // TODO: Implement getEntityManagerNames() method.
    }

    /**
     * Gets the entity manager associated with a given class.
     *
     * @param string $class A Doctrine Entity class name
     *
     * @return EntityManager|null
     */
    public function getEntityManagerForClass($class)
    {
        // TODO: Implement getEntityManagerForClass() method.
    }
}
