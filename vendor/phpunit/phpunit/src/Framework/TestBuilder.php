<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework;

use function assert;
use PHPUnit\Metadata\Api\DataProvider;
use PHPUnit\Metadata\Api\Groups;
use PHPUnit\Metadata\BackupGlobals;
use PHPUnit\Metadata\BackupStaticProperties;
use PHPUnit\Metadata\ExcludeGlobalVariableFromBackup;
use PHPUnit\Metadata\ExcludeStaticPropertyFromBackup;
use PHPUnit\Metadata\Parser\Registry as MetadataRegistry;
use PHPUnit\Metadata\PreserveGlobalState;
use PHPUnit\TextUI\Configuration\Registry as ConfigurationRegistry;
use ReflectionClass;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class TestBuilder
{
    /**
     * @psalm-param non-empty-string $methodName
     *
     * @throws InvalidDataProviderException
     */
    public function build(ReflectionClass $theClass, string $methodName): Test
    {
        $className = $theClass->getName();

<<<<<<< HEAD
        $data = (new DataProvider)->providedData(
            $className,
            $methodName,
        );

        if ($data !== null) {
            return $this->buildDataProviderTestSuite(
                $methodName,
                $className,
                $data,
                $this->shouldTestMethodBeRunInSeparateProcess($className, $methodName),
                $this->shouldGlobalStateBePreserved($className, $methodName),
                $this->shouldAllTestMethodsOfTestClassBeRunInSingleSeparateProcess($className),
                $this->backupSettings($className, $methodName),
            );
        }

        $test = new $className($methodName);

        assert($test instanceof TestCase);

        $this->configureTestCase(
            $test,
            $this->shouldTestMethodBeRunInSeparateProcess($className, $methodName),
            $this->shouldGlobalStateBePreserved($className, $methodName),
            $this->shouldAllTestMethodsOfTestClassBeRunInSingleSeparateProcess($className),
            $this->backupSettings($className, $methodName),
        );

        return $test;
    }

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     * @psalm-param array{backupGlobals: ?bool, backupGlobalsExcludeList: list<string>, backupStaticProperties: ?bool, backupStaticPropertiesExcludeList: array<string,list<string>>} $backupSettings
     */
    private function buildDataProviderTestSuite(string $methodName, string $className, array $data, bool $runTestInSeparateProcess, ?bool $preserveGlobalState, bool $runClassInSeparateProcess, array $backupSettings): DataProviderTestSuite
    {
        $dataProviderTestSuite = DataProviderTestSuite::empty(
            $className . '::' . $methodName,
        );

        $groups = (new Groups)->groups($className, $methodName);

        foreach ($data as $_dataName => $_data) {
            $_test = new $className($methodName);
=======
        if (!$theClass->isInstantiable()) {
            return new ErrorTestCase(
                sprintf('Cannot instantiate class "%s".', $className)
            );
        }

        $backupSettings = TestUtil::getBackupSettings(
            $className,
            $methodName
        );

        $preserveGlobalState = TestUtil::getPreserveGlobalStateSettings(
            $className,
            $methodName
        );

        $runTestInSeparateProcess = TestUtil::getProcessIsolationSettings(
            $className,
            $methodName
        );

        $runClassInSeparateProcess = TestUtil::getClassProcessIsolationSettings(
            $className,
            $methodName
        );
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)

            assert($_test instanceof TestCase);

            $_test->setData($_dataName, $_data);

<<<<<<< HEAD
=======
        $parameters = $constructor->getParameters();

        // TestCase() or TestCase($name)
        if (count($parameters) < 2) {
            $test = $this->buildTestWithoutData($className);
        } // TestCase($name, $data)
        else {
            try {
                $data = TestUtil::getProvidedData(
                    $className,
                    $methodName
                );
            } catch (IncompleteTestError $e) {
                $message = sprintf(
                    "Test for %s::%s marked incomplete by data provider\n%s",
                    $className,
                    $methodName,
                    $this->throwableToString($e)
                );

                $data = new IncompleteTestCase($className, $methodName, $message);
            } catch (SkippedTestError $e) {
                $message = sprintf(
                    "Test for %s::%s skipped by data provider\n%s",
                    $className,
                    $methodName,
                    $this->throwableToString($e)
                );

                $data = new SkippedTestCase($className, $methodName, $message);
            } catch (Throwable $t) {
                $message = sprintf(
                    "The data provider specified for %s::%s is invalid.\n%s",
                    $className,
                    $methodName,
                    $this->throwableToString($t)
                );

                $data = new ErrorTestCase($message);
            }

            // Test method with @dataProvider.
            if (isset($data)) {
                $test = $this->buildDataProviderTestSuite(
                    $methodName,
                    $className,
                    $data,
                    $runTestInSeparateProcess,
                    $preserveGlobalState,
                    $runClassInSeparateProcess,
                    $backupSettings
                );
            } else {
                $test = $this->buildTestWithoutData($className);
            }
        }

        if ($test instanceof TestCase) {
            $test->setName($methodName);
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            $this->configureTestCase(
                $_test,
                $runTestInSeparateProcess,
                $preserveGlobalState,
                $runClassInSeparateProcess,
                $backupSettings
            );

<<<<<<< HEAD
            $dataProviderTestSuite->addTest($_test, $groups);
=======
        return $test;
    }

    /** @psalm-param class-string $className */
    private function buildTestWithoutData(string $className)
    {
        return new $className;
    }

    /** @psalm-param class-string $className */
    private function buildDataProviderTestSuite(
        string $methodName,
        string $className,
        $data,
        bool $runTestInSeparateProcess,
        ?bool $preserveGlobalState,
        bool $runClassInSeparateProcess,
        array $backupSettings
    ): DataProviderTestSuite {
        $dataProviderTestSuite = new DataProviderTestSuite(
            $className . '::' . $methodName
        );

        $groups = TestUtil::getGroups($className, $methodName);

        if ($data instanceof ErrorTestCase ||
            $data instanceof SkippedTestCase ||
            $data instanceof IncompleteTestCase) {
            $dataProviderTestSuite->addTest($data, $groups);
        } else {
            foreach ($data as $_dataName => $_data) {
                $_test = new $className($methodName, $_data, $_dataName);

                assert($_test instanceof TestCase);

                $this->configureTestCase(
                    $_test,
                    $runTestInSeparateProcess,
                    $preserveGlobalState,
                    $runClassInSeparateProcess,
                    $backupSettings
                );

                $dataProviderTestSuite->addTest($_test, $groups);
            }
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
        }

        return $dataProviderTestSuite;
    }

    /**
     * @psalm-param array{backupGlobals: ?bool, backupGlobalsExcludeList: list<string>, backupStaticProperties: ?bool, backupStaticPropertiesExcludeList: array<string,list<string>>} $backupSettings
     */
    private function configureTestCase(TestCase $test, bool $runTestInSeparateProcess, ?bool $preserveGlobalState, bool $runClassInSeparateProcess, array $backupSettings): void
    {
        if ($runTestInSeparateProcess) {
            $test->setRunTestInSeparateProcess(true);
        }

        if ($runClassInSeparateProcess) {
            $test->setRunClassInSeparateProcess(true);
        }

        if ($preserveGlobalState !== null) {
            $test->setPreserveGlobalState($preserveGlobalState);
        }

        if ($backupSettings['backupGlobals'] !== null) {
            $test->setBackupGlobals($backupSettings['backupGlobals']);
        } else {
            $test->setBackupGlobals(ConfigurationRegistry::get()->backupGlobals());
        }

<<<<<<< HEAD
        $test->setBackupGlobalsExcludeList($backupSettings['backupGlobalsExcludeList']);

        if ($backupSettings['backupStaticProperties'] !== null) {
            $test->setBackupStaticProperties($backupSettings['backupStaticProperties']);
        } else {
            $test->setBackupStaticProperties(ConfigurationRegistry::get()->backupStaticProperties());
=======
        if ($backupSettings['backupStaticAttributes'] !== null) {
            $test->setBackupStaticAttributes(
                $backupSettings['backupStaticAttributes']
            );
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
        }

        $test->setBackupStaticPropertiesExcludeList($backupSettings['backupStaticPropertiesExcludeList']);
    }

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     *
     * @psalm-return array{backupGlobals: ?bool, backupGlobalsExcludeList: list<string>, backupStaticProperties: ?bool, backupStaticPropertiesExcludeList: array<string,list<string>>}
     */
    private function backupSettings(string $className, string $methodName): array
    {
        $metadataForClass          = MetadataRegistry::parser()->forClass($className);
        $metadataForMethod         = MetadataRegistry::parser()->forMethod($className, $methodName);
        $metadataForClassAndMethod = MetadataRegistry::parser()->forClassAndMethod($className, $methodName);

        $backupGlobals            = null;
        $backupGlobalsExcludeList = [];

        if ($metadataForMethod->isBackupGlobals()->isNotEmpty()) {
            $metadata = $metadataForMethod->isBackupGlobals()->asArray()[0];

            assert($metadata instanceof BackupGlobals);

            if ($metadata->enabled()) {
                $backupGlobals = true;
            }
        } elseif ($metadataForClass->isBackupGlobals()->isNotEmpty()) {
            $metadata = $metadataForClass->isBackupGlobals()->asArray()[0];

            assert($metadata instanceof BackupGlobals);

            if ($metadata->enabled()) {
                $backupGlobals = true;
            }
        }

<<<<<<< HEAD
        foreach ($metadataForClassAndMethod->isExcludeGlobalVariableFromBackup() as $metadata) {
            assert($metadata instanceof ExcludeGlobalVariableFromBackup);

            $backupGlobalsExcludeList[] = $metadata->globalVariableName();
        }

        $backupStaticProperties            = null;
        $backupStaticPropertiesExcludeList = [];

        if ($metadataForMethod->isBackupStaticProperties()->isNotEmpty()) {
            $metadata = $metadataForMethod->isBackupStaticProperties()->asArray()[0];

            assert($metadata instanceof BackupStaticProperties);

            if ($metadata->enabled()) {
                $backupStaticProperties = true;
            }
        } elseif ($metadataForClass->isBackupStaticProperties()->isNotEmpty()) {
            $metadata = $metadataForClass->isBackupStaticProperties()->asArray()[0];

            assert($metadata instanceof BackupStaticProperties);

            if ($metadata->enabled()) {
                $backupStaticProperties = true;
            }
        }

        foreach ($metadataForClassAndMethod->isExcludeStaticPropertyFromBackup() as $metadata) {
            assert($metadata instanceof ExcludeStaticPropertyFromBackup);

            if (!isset($backupStaticPropertiesExcludeList[$metadata->className()])) {
                $backupStaticPropertiesExcludeList[$metadata->className()] = [];
            }

            $backupStaticPropertiesExcludeList[$metadata->className()][] = $metadata->propertyName();
        }

        return [
            'backupGlobals'                     => $backupGlobals,
            'backupGlobalsExcludeList'          => $backupGlobalsExcludeList,
            'backupStaticProperties'            => $backupStaticProperties,
            'backupStaticPropertiesExcludeList' => $backupStaticPropertiesExcludeList,
        ];
    }

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     */
    private function shouldGlobalStateBePreserved(string $className, string $methodName): ?bool
    {
        $metadataForMethod = MetadataRegistry::parser()->forMethod($className, $methodName);

        if ($metadataForMethod->isPreserveGlobalState()->isNotEmpty()) {
            $metadata = $metadataForMethod->isPreserveGlobalState()->asArray()[0];

            assert($metadata instanceof PreserveGlobalState);

            return $metadata->enabled();
        }

        $metadataForClass = MetadataRegistry::parser()->forClass($className);

        if ($metadataForClass->isPreserveGlobalState()->isNotEmpty()) {
            $metadata = $metadataForClass->isPreserveGlobalState()->asArray()[0];

            assert($metadata instanceof PreserveGlobalState);

            return $metadata->enabled();
        }

        return null;
    }

    /**
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
     */
    private function shouldTestMethodBeRunInSeparateProcess(string $className, string $methodName): bool
    {
        if (MetadataRegistry::parser()->forClass($className)->isRunTestsInSeparateProcesses()->isNotEmpty()) {
            return true;
        }

        if (MetadataRegistry::parser()->forMethod($className, $methodName)->isRunInSeparateProcess()->isNotEmpty()) {
            return true;
        }

        return false;
    }

    /**
     * @psalm-param class-string $className
     */
    private function shouldAllTestMethodsOfTestClassBeRunInSingleSeparateProcess(string $className): bool
    {
        return MetadataRegistry::parser()->forClass($className)->isRunClassInSeparateProcess()->isNotEmpty();
=======
        if ($t instanceof InvalidDataSetException) {
            return sprintf(
                "%s\n%s",
                $message,
                Filter::getFilteredStacktrace($t)
            );
        }

        return sprintf(
            "%s: %s\n%s",
            get_class($t),
            $message,
            Filter::getFilteredStacktrace($t)
        );
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
    }
}
