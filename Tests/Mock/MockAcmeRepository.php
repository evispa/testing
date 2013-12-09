<?php

/*
 * This file is part of the Evispa package.
 *
 * (c) Evispa <php@evispa.lt>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evispa\Component\Testing\Tests\Mock;

use Evispa\Component\Testing\Mock\Doctrine\ORM\AbstractMockRepository;


/**
 * @author Darius Krištapavičius <darius@evispa.lt>
 */
class MockAcmeRepository extends AbstractMockRepository
{

    /**
     * Create object criteria array
     * Used for object findBy
     * Requires at least array('id' => value)
     *
     * @param MockAcmeEntity $object
     *
     * @return array
     */
    public function getObjectCriteria($object)
    {
        return array(
            'id' => $object->getId(),
            'child' => $object->getChild()
        );
    }

    /**
     * Returns the class name of the object managed by the repository.
     *
     * @return string
     */
    public function getClassName()
    {
        return 'Evispa\Component\Testing\Tests\Mock\MockAcmeEntity';
    }
}
 