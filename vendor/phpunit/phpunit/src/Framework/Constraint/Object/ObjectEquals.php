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

use function is_object;
use PHPUnit\Framework\ActualValueIsNotAnObjectException;
use PHPUnit\Framework\ComparisonMethodDoesNotAcceptParameterTypeException;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareBoolReturnTypeException;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareExactlyOneParameterException;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareParameterTypeException;
use PHPUnit\Framework\ComparisonMethodDoesNotExistException;
use ReflectionNamedType;
use ReflectionObject;

/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class ObjectEquals extends Constraint
{
    private readonly object $expected;
    private readonly string $method;

    public function __construct(object $object, string $method = 'equals')
    {
        $this->expected = $object;
        $this->method   = $method;
    }

    public function toString(): string
    {
        return 'two objects are equal';
    }

    /**
     * @throws ActualValueIsNotAnObjectException
     * @throws ComparisonMethodDoesNotAcceptParameterTypeException
     * @throws ComparisonMethodDoesNotDeclareBoolReturnTypeException
     * @throws ComparisonMethodDoesNotDeclareExactlyOneParameterException
     * @throws ComparisonMethodDoesNotDeclareParameterTypeException
     * @throws ComparisonMethodDoesNotExistException
     */
    protected function matches(mixed $other): bool
    {
        if (!is_object($other)) {
            throw new ActualValueIsNotAnObjectException;
        }

        $object = new ReflectionObject($other);

        if (!$object->hasMethod($this->method)) {
            throw new ComparisonMethodDoesNotExistException(
<<<<<<< HEAD
                $other::class,
                $this->method,
=======
                get_class($other),
                $this->method
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            );
        }

        $method = $object->getMethod($this->method);

        if (!$method->hasReturnType()) {
            throw new ComparisonMethodDoesNotDeclareBoolReturnTypeException(
<<<<<<< HEAD
                $other::class,
                $this->method,
=======
                get_class($other),
                $this->method
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            );
        }

        $returnType = $method->getReturnType();

        if (!$returnType instanceof ReflectionNamedType) {
            throw new ComparisonMethodDoesNotDeclareBoolReturnTypeException(
<<<<<<< HEAD
                $other::class,
                $this->method,
=======
                get_class($other),
                $this->method
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            );
        }

        if ($returnType->allowsNull()) {
            throw new ComparisonMethodDoesNotDeclareBoolReturnTypeException(
<<<<<<< HEAD
                $other::class,
                $this->method,
=======
                get_class($other),
                $this->method
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            );
        }

        if ($returnType->getName() !== 'bool') {
            throw new ComparisonMethodDoesNotDeclareBoolReturnTypeException(
<<<<<<< HEAD
                $other::class,
                $this->method,
=======
                get_class($other),
                $this->method
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            );
        }

        if ($method->getNumberOfParameters() !== 1 || $method->getNumberOfRequiredParameters() !== 1) {
            throw new ComparisonMethodDoesNotDeclareExactlyOneParameterException(
<<<<<<< HEAD
                $other::class,
                $this->method,
=======
                get_class($other),
                $this->method
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            );
        }

        $parameter = $method->getParameters()[0];

        if (!$parameter->hasType()) {
            throw new ComparisonMethodDoesNotDeclareParameterTypeException(
<<<<<<< HEAD
                $other::class,
                $this->method,
=======
                get_class($other),
                $this->method
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            );
        }

        $type = $parameter->getType();

        if (!$type instanceof ReflectionNamedType) {
            throw new ComparisonMethodDoesNotDeclareParameterTypeException(
<<<<<<< HEAD
                $other::class,
                $this->method,
=======
                get_class($other),
                $this->method
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            );
        }

        $typeName = $type->getName();

        if ($typeName === 'self') {
            $typeName = $other::class;
        }

        if (!$this->expected instanceof $typeName) {
            throw new ComparisonMethodDoesNotAcceptParameterTypeException(
                $other::class,
                $this->method,
<<<<<<< HEAD
                $this->expected::class,
=======
                get_class($this->expected)
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            );
        }

        return $other->{$this->method}($this->expected);
    }

    protected function failureDescription(mixed $other): string
    {
        return $this->toString(true);
    }
}
