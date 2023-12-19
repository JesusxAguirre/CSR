<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Loader;

trigger_deprecation('symfony/routing', '6.4', 'The "%s" class is deprecated, use "%s" instead.', AnnotationDirectoryLoader::class, AttributeDirectoryLoader::class);

class_exists(AttributeDirectoryLoader::class);

if (false) {
    /**
     * @deprecated since Symfony 6.4, to be removed in 7.0, use {@link AttributeDirectoryLoader} instead
     */
    class AnnotationDirectoryLoader extends AttributeDirectoryLoader
    {
<<<<<<< HEAD
=======
        if (!is_dir($dir = $this->locator->locate($path))) {
            return parent::supports($path, $type) ? parent::load($path, $type) : new RouteCollection();
        }

        $collection = new RouteCollection();
        $collection->addResource(new DirectoryResource($dir, '/\.php$/'));
        $files = iterator_to_array(new \RecursiveIteratorIterator(
            new \RecursiveCallbackFilterIterator(
                new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::FOLLOW_SYMLINKS),
                function (\SplFileInfo $current) {
                    return !str_starts_with($current->getBasename(), '.');
                }
            ),
            \RecursiveIteratorIterator::LEAVES_ONLY
        ));
        usort($files, function (\SplFileInfo $a, \SplFileInfo $b) {
            return (string) $a > (string) $b ? 1 : -1;
        });

        foreach ($files as $file) {
            if (!$file->isFile() || !str_ends_with($file->getFilename(), '.php')) {
                continue;
            }

            if ($class = $this->findClass($file)) {
                $refl = new \ReflectionClass($class);
                if ($refl->isAbstract()) {
                    continue;
                }

                $collection->addCollection($this->loader->load($class, $type));
            }
        }

        return $collection;
    }

    public function supports(mixed $resource, string $type = null): bool
    {
        if (!\is_string($resource)) {
            return false;
        }

        if (\in_array($type, ['annotation', 'attribute'], true)) {
            return true;
        }

        if ($type) {
            return false;
        }

        try {
            return is_dir($this->locator->locate($resource));
        } catch (\Exception) {
            return false;
        }
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
    }
}
