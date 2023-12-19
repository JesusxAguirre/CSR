<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\MockObject;

use function get_debug_type;
use function sprintf;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class IncompatibleReturnValueException extends \PHPUnit\Framework\Exception implements Exception
{
    public function __construct(ConfigurableMethod $method, mixed $value)
    {
        parent::__construct(
            sprintf(
                'Method %s may not return value of type %s, its declared return type is "%s"',
<<<<<<< HEAD
                $method->name(),
                get_debug_type($value),
                $method->returnTypeDeclaration(),
            ),
=======
                $method->getName(),
                is_object($value) ? get_class($value) : gettype($value),
                $method->getReturnTypeDeclaration()
            )
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
        );
    }
}
