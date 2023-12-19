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

use function sprintf;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class ReturnValueNotConfiguredException extends \PHPUnit\Framework\Exception implements Exception
{
    public function __construct(Invocation $invocation)
    {
        parent::__construct(
            sprintf(
<<<<<<< HEAD
                'No return value is configured for %s::%s() and return value generation is disabled',
                $invocation->className(),
                $invocation->methodName(),
            ),
=======
                'Return value inference disabled and no expectation set up for %s::%s()',
                $invocation->getClassName(),
                $invocation->getMethodName()
            )
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
        );
    }
}
