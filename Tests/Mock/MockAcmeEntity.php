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


/**
 * @author Darius Krištapavičius <darius@evispa.lt>
 */
class MockAcmeEntity
{
    private $id;

    /** @var MockAcmeChildEntity */
    private $child;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Evispa\Component\Testing\Tests\Mock\MockAcmeChildEntity $child
     */
    public function setChild($child)
    {
        $this->child = $child;
    }

    /**
     * @return \Evispa\Component\Testing\Tests\Mock\MockAcmeChildEntity
     */
    public function getChild()
    {
        return $this->child;
    }
}
 