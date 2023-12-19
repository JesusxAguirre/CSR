<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-code-coverage.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\CodeCoverage;

use function dirname;
use SebastianBergmann\Version as VersionId;

final class Version
{
    private static string $version = '';

    public static function id(): string
    {
<<<<<<< HEAD
        if (self::$version === '') {
            self::$version = (new VersionId('10.1.10', dirname(__DIR__)))->asString();
=======
        if (self::$version === null) {
            self::$version = (new VersionId('9.2.26', dirname(__DIR__)))->getVersion();
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
        }

        return self::$version;
    }
}
