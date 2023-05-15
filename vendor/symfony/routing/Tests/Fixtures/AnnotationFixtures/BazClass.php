<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Tests\Fixtures\AnnotationFixtures;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/1", name="route1", schemes={"https"}, methods={"GET"})
 * @Route("/2", name="route2", schemes={"https"}, methods={"GET"})
 */
class BazClass
{
    public function __invoke()
    {
    }
}
