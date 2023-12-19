<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class ActualValueIsNotAnObjectException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            'Actual value is not an object',
<<<<<<< HEAD:vendor/phpunit/phpunit/src/Framework/Exception/ObjectEquals/ActualValueIsNotAnObjectException.php
=======
            0,
            null
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas):vendor/phpunit/phpunit/src/Framework/Exception/ActualValueIsNotAnObjectException.php
        );
    }
}
