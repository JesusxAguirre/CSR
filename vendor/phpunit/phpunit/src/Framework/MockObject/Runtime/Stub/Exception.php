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
use Throwable;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class Exception implements Stub
{
    private readonly Throwable $exception;

    public function __construct(Throwable $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @throws Throwable
     */
    public function invoke(Invocation $invocation): never
    {
        throw $this->exception;
    }
<<<<<<< HEAD:vendor/phpunit/phpunit/src/Framework/MockObject/Runtime/Stub/Exception.php
=======

    public function toString(): string
    {
        $exporter = new Exporter;

        return sprintf(
            'raise user-specified exception %s',
            $exporter->export($this->exception)
        );
    }
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas):vendor/phpunit/phpunit/src/Framework/MockObject/Stub/Exception.php
}
