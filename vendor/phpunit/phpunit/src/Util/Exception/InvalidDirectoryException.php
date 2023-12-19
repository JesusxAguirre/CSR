<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Util;

use function sprintf;
use RuntimeException;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class InvalidDirectoryException extends RuntimeException implements Exception
{
    public function __construct(string $directory)
    {
<<<<<<< HEAD:vendor/phpunit/phpunit/src/Util/Exception/InvalidDirectoryException.php
        parent::__construct(
            sprintf(
                '"%s" is not a directory',
                $directory,
            ),
=======
        return ErrorHandler::invokeIgnoringWarnings(
            static function () use ($pattern, $subject)
            {
                return preg_match($pattern, $subject);
            }
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas):vendor/phpunit/phpunit/src/Util/RegularExpression.php
        );
    }
}
