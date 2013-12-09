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

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\Validator\Constraints\Collection;


/**
 * @author Darius Krištapavičius <darius@evispa.lt>
 */
abstract class AbstractMockRepository implements ObjectRepository
{
    public $objects = array();
    protected $objectCriteriaMap = array();

    /**
     * Create object criteria array
     * Used for object findBy
     * Requires at least array('id' => value)
     *
     * @param $object
     *
     * @return array
     */
    abstract public function getObjectCriteria($object);

    /**
     * Add object
     *
     * @param $object
     *
     * @return mixed
     */
    public function addObject($object)
    {
        if (false === in_array($object, $this->objects, true)) {
            $hash = spl_object_hash($object);
            $this->objects[$hash] = $object;
            $this->objectCriteriaMap[$hash] = $this->getObjectCriteria($object);
        }
    }

    /**
     * Remove object
     *
     * @param $object
     *
     * @return mixed
     */
    public function removeObject($object)
    {
        $hash = spl_object_hash($object);

        if (isset($this->objects[$hash])) {
            unset($this->objects[$hash]);
            unset($this->objectCriteriaMap[$hash]);
        }
    }

    public function addObjectCriteria($object, $criteria)
    {
        $hash = spl_object_hash($object);

        if (isset($this->objects[$hash])) {
            if (false === isset($this->objectCriteriaMap[$hash])) {
                $this->objectCriteriaMap[$hash] = array();
            }

            $this->objectCriteriaMap[$hash] = array_merge($this->objectCriteriaMap[$hash], $criteria);
        }
    }

    /**
     * @param $objCriteria
     * @param $findCriteria
     *
     * @return bool
     */
    private function isSingleCriteriaMatch($objCriteria, $findCriteria)
    {
        if (false === is_array($objCriteria) && true === is_array($findCriteria)) {
            return in_array($objCriteria, $findCriteria, true) ? true : false;
        }

        return $objCriteria === $findCriteria ? true : false;
    }

    /**
     * Finds objects by a set of criteria.
     *
     * Optionally sorting and limiting details can be passed. An implementation may throw
     * an UnexpectedValueException if certain values of the sorting or limiting details are
     * not supported.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array The objects.
     *
     * @throws \UnexpectedValueException
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $result = array();
        foreach ($this->objectCriteriaMap as $hash => $objCriteria) {
            $ok = true;
            foreach ($criteria as $cKey => $cValue) {

                if ((false === isset($objCriteria[$cKey]))
                    ||
                    (false === $this->isSingleCriteriaMatch($objCriteria[$cKey], $cValue))
                ) {
                    $ok = false;
                    break;
                }
            }

            if ($ok === true && isset($this->objects[$hash])) {
                $result[] = $this->objects[$hash];
            }
        }

        $offset = ($offset === null) ? 0 : $offset;

        $result = array_slice($result, $offset, $limit);

        return $result;
    }

    /**
     * Finds a single object by a set of criteria.
     *
     * @param array $criteria The criteria.
     *
     * @return object The object.
     */
    public function findOneBy(array $criteria)
    {
        $result = $this->findBy($criteria, null, 1);

        return count($result) > 0 ? $result[0] : null;
    }

    /**
     * Finds all objects in the repository.
     *
     * @return array The objects.
     */
    public function findAll()
    {
        return array_values($this->objects);
    }

    /**
     * Finds an object by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     *
     * @return object The object.
     */
    public function find($id)
    {
        return $this->findOneBy(array('id' => $id));
    }

}
 