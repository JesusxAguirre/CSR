<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Constraint;

<<<<<<< HEAD
use function str_starts_with;
use PHPUnit\Framework\EmptyStringException;
=======
use function strlen;
use function strpos;
use PHPUnit\Framework\InvalidArgumentException;
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)

/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class StringStartsWith extends Constraint
{
    private readonly string $prefix;

    /**
     * @throws EmptyStringException
     */
    public function __construct(string $prefix)
    {
<<<<<<< HEAD
        if ($prefix === '') {
            throw new EmptyStringException;
=======
        if (strlen($prefix) === 0) {
            throw InvalidArgumentException::create(1, 'non-empty string');
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
        }

        $this->prefix = $prefix;
    }

    /**
     * Returns a string representation of the constraint.
     */
    public function toString(): string
    {
        return 'starts with "' . $this->prefix . '"';
    }

    /**
     * Evaluates the constraint for parameter $other. Returns true if the
     * constraint is met, false otherwise.
     */
    protected function matches(mixed $other): bool
    {
        return str_starts_with((string) $other, $this->prefix);
    }
}
