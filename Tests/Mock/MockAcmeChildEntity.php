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
class MockAcmeChildEntity
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

}
 