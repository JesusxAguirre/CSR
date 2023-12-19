<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\MockObject\Stub;

use function array_shift;
use PHPUnit\Framework\MockObject\Invocation;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class ConsecutiveCalls implements Stub
{
    private array $stack;

    public function __construct(array $stack)
    {
        $this->stack = $stack;
    }

    public function invoke(Invocation $invocation): mixed
    {
        $value = array_shift($this->stack);

        if ($value instanceof Stub) {
            $value = $value->invoke($invocation);
        }

<<<<<<< HEAD:vendor/phpunit/phpunit/src/Framework/MockObject/Runtime/Stub/ConsecutiveCalls.php
        return $value;
=======
        return $this->value;
    }

    public function toString(): string
    {
        $exporter = new Exporter;

        return sprintf(
            'return user-specified value %s',
            $exporter->export($this->value)
        );
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas):vendor/phpunit/phpunit/src/Framework/MockObject/Stub/ConsecutiveCalls.php
    }
}
