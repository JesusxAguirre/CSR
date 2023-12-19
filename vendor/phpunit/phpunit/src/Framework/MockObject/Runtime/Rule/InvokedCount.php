<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\MockObject\Rule;

use function sprintf;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\MockObject\Invocation as BaseInvocation;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class InvokedCount extends InvocationOrder
{
    private readonly int $expectedCount;

    public function __construct(int $expectedCount)
    {
        $this->expectedCount = $expectedCount;
    }

    public function isNever(): bool
    {
        return $this->expectedCount === 0;
    }

    public function toString(): string
    {
        return sprintf(
            'invoked %d time%s',
            $this->expectedCount,
            $this->expectedCount !== 1 ? 's' : '',
        );
    }

    public function matches(BaseInvocation $invocation): bool
    {
        return true;
    }

    /**
     * Verifies that the current expectation is valid. If everything is OK the
     * code should just return, if not it must throw an exception.
     *
     * @throws ExpectationFailedException
     */
    public function verify(): void
    {
        $actualCount = $this->numberOfInvocations();

        if ($actualCount !== $this->expectedCount) {
            throw new ExpectationFailedException(
                sprintf(
                    'Method was expected to be called %d time%s, actually called %d time%s.',
                    $this->expectedCount,
<<<<<<< HEAD:vendor/phpunit/phpunit/src/Framework/MockObject/Runtime/Rule/InvokedCount.php
                    $this->expectedCount !== 1 ? 's' : '',
                    $actualCount,
                    $actualCount !== 1 ? 's' : '',
                ),
=======
                    $count
                )
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas):vendor/phpunit/phpunit/src/Framework/MockObject/Rule/InvokedCount.php
            );
        }
    }

    /**
     * @throws ExpectationFailedException
     */
    protected function invokedDo(BaseInvocation $invocation): void
    {
        $count = $this->numberOfInvocations();

        if ($count > $this->expectedCount) {
            $message = $invocation->toString() . ' ';

<<<<<<< HEAD:vendor/phpunit/phpunit/src/Framework/MockObject/Runtime/Rule/InvokedCount.php
            $message .= match ($this->expectedCount) {
                0       => 'was not expected to be called.',
                1       => 'was not expected to be called more than once.',
                default => sprintf(
                    'was not expected to be called more than %d times.',
                    $this->expectedCount,
                ),
            };
=======
            switch ($this->expectedCount) {
                case 0:
                    $message .= 'was not expected to be called.';

                    break;

                case 1:
                    $message .= 'was not expected to be called more than once.';

                    break;

                default:
                    $message .= sprintf(
                        'was not expected to be called more than %d times.',
                        $this->expectedCount
                    );
            }
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas):vendor/phpunit/phpunit/src/Framework/MockObject/Rule/InvokedCount.php

            throw new ExpectationFailedException($message);
        }
    }
}
