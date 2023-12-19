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

use PHPUnit\Framework\MockObject\Invocation;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class ReturnStub implements Stub
{
    private readonly mixed $value;

    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    public function invoke(Invocation $invocation): mixed
    {
        return $this->value;
    }
<<<<<<< HEAD:vendor/phpunit/phpunit/src/Framework/MockObject/Runtime/Stub/ReturnStub.php
=======

    public function toString(): string
    {
        $exporter = new Exporter;

        return sprintf(
            'return user-specified value %s',
            $exporter->export($this->value)
        );
    }
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas):vendor/phpunit/phpunit/src/Framework/MockObject/Stub/ReturnStub.php
}
