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
final class ReturnReference implements Stub
{
    private mixed $reference;

    public function __construct(mixed &$reference)
    {
        $this->reference = &$reference;
    }

    public function invoke(Invocation $invocation): mixed
    {
        return $this->reference;
    }
<<<<<<< HEAD:vendor/phpunit/phpunit/src/Framework/MockObject/Runtime/Stub/ReturnReference.php
=======

    public function toString(): string
    {
        $exporter = new Exporter;

        return sprintf(
            'return user-specified reference %s',
            $exporter->export($this->reference)
        );
    }
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas):vendor/phpunit/phpunit/src/Framework/MockObject/Stub/ReturnReference.php
}
