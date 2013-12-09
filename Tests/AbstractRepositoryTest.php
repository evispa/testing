<?php

/*
 * This file is part of the Evispa package.
 *
 * (c) Evispa <php@evispa.lt>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evispa\Component\Testing\Tests;

use Evispa\Component\Testing\Tests\Mock\MockAcmeChildEntity;
use Evispa\Component\Testing\Tests\Mock\MockAcmeEntity;
use Evispa\Component\Testing\Tests\Mock\MockAcmeRepository;

/**
 * @author Darius Krištapavičius <darius@evispa.lt>
 */
class AbstractRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFindByObjectWithResults()
    {
        $repo = new MockAcmeRepository();

        $acmeEntity = new MockAcmeEntity('parent');
        $acmeChildEntity = new MockAcmeChildEntity('child');
        $acmeEntity->setChild($acmeChildEntity);

        $repo->addObject($acmeEntity);

        $result = $repo->findBy(array('child' => $acmeChildEntity));

        $this->assertEquals(1, count($result));
        $this->assertEquals(spl_object_hash($acmeEntity), spl_object_hash($result[0]));
    }

    public function testFindByObjectWithoutResults()
    {
        $repo = new MockAcmeRepository();

        $acmeEntity = new MockAcmeEntity('parent');
        $acmeChildEntity = new MockAcmeChildEntity('child');
        $acmeNewChildEntity = new MockAcmeChildEntity('child-new');
        $acmeEntity->setChild($acmeChildEntity);

        $repo->addObject($acmeEntity);

        $result = $repo->findBy(array('child' => $acmeNewChildEntity));

        $this->assertEquals(0, count($result));
    }
}
 