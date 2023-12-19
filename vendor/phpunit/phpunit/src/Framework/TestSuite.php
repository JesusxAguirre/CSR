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

use const PHP_EOL;
use function array_keys;
use function array_map;
use function assert;
use function call_user_func;
use function class_exists;
use function count;
use function implode;
use function is_callable;
use function is_file;
use function is_subclass_of;
use function sprintf;
use function str_ends_with;
use function str_starts_with;
use function trim;
use Iterator;
use IteratorAggregate;
use PHPUnit\Event;
use PHPUnit\Event\Code\TestMethod;
use PHPUnit\Event\NoPreviousThrowableException;
use PHPUnit\Metadata\Api\Dependencies;
use PHPUnit\Metadata\Api\Groups;
use PHPUnit\Metadata\Api\HookMethods;
use PHPUnit\Metadata\Api\Requirements;
use PHPUnit\Metadata\MetadataCollection;
use PHPUnit\Runner\Exception as RunnerException;
use PHPUnit\Runner\Filter\Factory;
use PHPUnit\Runner\PhptTestCase;
use PHPUnit\Runner\TestSuiteLoader;
use PHPUnit\TestRunner\TestResult\Facade as TestResultFacade;
use PHPUnit\Util\Filter;
use PHPUnit\Util\Reflection;
use PHPUnit\Util\Test as TestUtil;
use ReflectionClass;
use ReflectionMethod;
use SebastianBergmann\CodeCoverage\UnintentionallyCoveredCodeException;
use Throwable;

/**
 * @template-implements IteratorAggregate<int, Test>
 *
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
class TestSuite implements IteratorAggregate, Reorderable, SelfDescribing, Test
{
    /**
     * @psalm-var non-empty-string
     */
    private string $name;

    /**
     * @psalm-var array<string,list<Test>>
     */
    private array $groups         = [];
    private ?array $requiredTests = null;

    /**
     * @psalm-var list<Test>
     */
    private array $tests             = [];
    private ?array $providedTests    = null;
    private ?Factory $iteratorFilter = null;

    /**
     * @psalm-param non-empty-string $name
     */
    public static function empty(string $name): static
    {
<<<<<<< HEAD
        return new static($name);
    }
=======
        if (!is_string($theClass) && !$theClass instanceof ReflectionClass) {
            throw InvalidArgumentException::create(
                1,
                'ReflectionClass object or string'
            );
        }
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)

    /**
     * @psalm-param class-string $className
     */
    public static function fromClassName(string $className): static
    {
        assert(class_exists($className));

        $class = new ReflectionClass($className);

<<<<<<< HEAD
        return static::fromClassReflector($class);
    }
=======
                try {
                    $theClass = new ReflectionClass($theClass);
                } catch (ReflectionException $e) {
                    throw new Exception(
                        $e->getMessage(),
                        $e->getCode(),
                        $e
                    );
                }
                // @codeCoverageIgnoreEnd
            } else {
                $this->setName($theClass);
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)

    public static function fromClassReflector(ReflectionClass $class): static
    {
        $testSuite = new static($class->getName());

        $constructor = $class->getConstructor();

<<<<<<< HEAD
        if ($constructor !== null && !$constructor->isPublic()) {
            Event\Facade::emitter()->testRunnerTriggeredWarning(
                sprintf(
                    'Class "%s" has no public constructor.',
                    $class->getName(),
                ),
=======
            return;
        }

        if ($name !== '') {
            $this->setName($name);
        } else {
            $this->setName($theClass->getName());
        }

        $constructor = $theClass->getConstructor();

        if ($constructor !== null &&
            !$constructor->isPublic()) {
            $this->addTest(
                new WarningTestCase(
                    sprintf(
                        'Class "%s" has no public constructor.',
                        $theClass->getName()
                    )
                )
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            );

            return $testSuite;
        }

        foreach (Reflection::publicMethodsInTestClass($class) as $method) {
            if ($method->getDeclaringClass()->getName() === Assert::class) {
                continue;
            }

            if ($method->getDeclaringClass()->getName() === TestCase::class) {
                continue;
            }

            if (!TestUtil::isTestMethod($method)) {
                continue;
            }

            $testSuite->addTestMethod($class, $method);
        }

<<<<<<< HEAD
        if (count($testSuite) === 0) {
            Event\Facade::emitter()->testRunnerTriggeredWarning(
                sprintf(
                    'No tests found in class "%s".',
                    $class->getName(),
                ),
=======
        if (empty($this->tests)) {
            $this->addTest(
                new WarningTestCase(
                    sprintf(
                        'No tests found in class "%s".',
                        $theClass->getName()
                    )
                )
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            );
        }

        return $testSuite;
    }

    /**
     * @psalm-param non-empty-string $name
     */
    final private function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns a string representation of the test suite.
     */
    public function toString(): string
    {
        return $this->name();
    }

    /**
     * Adds a test to the suite.
     */
    public function addTest(Test $test, array $groups = []): void
    {
<<<<<<< HEAD
        $class = new ReflectionClass($test);
=======
        try {
            $class = new ReflectionClass($test);
            // @codeCoverageIgnoreStart
        } catch (ReflectionException $e) {
            throw new Exception(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
        // @codeCoverageIgnoreEnd
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)

        if (!$class->isAbstract()) {
            $this->tests[] = $test;
            $this->clearCaches();

            if ($test instanceof self && empty($groups)) {
                $groups = $test->groups();
            }

            if ($this->containsOnlyVirtualGroups($groups)) {
                $groups[] = 'default';
            }

            foreach ($groups as $group) {
                if (!isset($this->groups[$group])) {
                    $this->groups[$group] = [$test];
                } else {
                    $this->groups[$group][] = $test;
                }
            }

            if ($test instanceof TestCase) {
                $test->setGroups($groups);
            }
        }
    }

    /**
     * Adds the tests from the given class to the suite.
     *
     * @throws Exception
     */
    public function addTestSuite(ReflectionClass $testClass): void
    {
<<<<<<< HEAD
        if ($testClass->isAbstract()) {
            throw new Exception(
                sprintf(
                    'Class %s is abstract',
                    $testClass->getName(),
                ),
            );
        }

        if (!$testClass->isSubclassOf(TestCase::class)) {
            throw new Exception(
                sprintf(
                    'Class %s is not a subclass of %s',
                    $testClass->getName(),
                    TestCase::class,
                ),
            );
        }

        $this->addTest(self::fromClassReflector($testClass));
=======
        if (!(is_object($testClass) || (is_string($testClass) && class_exists($testClass)))) {
            throw InvalidArgumentException::create(
                1,
                'class name or object'
            );
        }

        if (!is_object($testClass)) {
            try {
                $testClass = new ReflectionClass($testClass);
                // @codeCoverageIgnoreStart
            } catch (ReflectionException $e) {
                throw new Exception(
                    $e->getMessage(),
                    $e->getCode(),
                    $e
                );
            }
            // @codeCoverageIgnoreEnd
        }

        if ($testClass instanceof self) {
            $this->addTest($testClass);
        } elseif ($testClass instanceof ReflectionClass) {
            $suiteMethod = false;

            if (!$testClass->isAbstract() && $testClass->hasMethod(BaseTestRunner::SUITE_METHODNAME)) {
                try {
                    $method = $testClass->getMethod(
                        BaseTestRunner::SUITE_METHODNAME
                    );
                    // @codeCoverageIgnoreStart
                } catch (ReflectionException $e) {
                    throw new Exception(
                        $e->getMessage(),
                        $e->getCode(),
                        $e
                    );
                }
                // @codeCoverageIgnoreEnd

                if ($method->isStatic()) {
                    $this->addTest(
                        $method->invoke(null, $testClass->getName())
                    );

                    $suiteMethod = true;
                }
            }

            if (!$suiteMethod && !$testClass->isAbstract() && $testClass->isSubclassOf(TestCase::class)) {
                $this->addTest(new self($testClass));
            }
        } else {
            throw new Exception;
        }
    }

    public function addWarning(string $warning): void
    {
        $this->warnings[] = $warning;
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
    }

    /**
     * Wraps both <code>addTest()</code> and <code>addTestSuite</code>
     * as well as the separate import statements for the user's convenience.
     *
     * If the named file cannot be read or there are no new tests that can be
     * added, a <code>PHPUnit\Framework\WarningTestCase</code> will be created instead,
     * leaving the current test run untouched.
     *
     * @throws Exception
     */
    public function addTestFile(string $filename): void
    {
        if (is_file($filename) && str_ends_with($filename, '.phpt')) {
            try {
                $this->addTest(new PhptTestCase($filename));
            } catch (RunnerException $e) {
                Event\Facade::emitter()->testRunnerTriggeredWarning(
                    $e->getMessage(),
                );
            }

            return;
        }

<<<<<<< HEAD
        try {
            $this->addTestSuite(
                (new TestSuiteLoader)->load($filename),
            );
        } catch (RunnerException $e) {
            Event\Facade::emitter()->testRunnerTriggeredWarning(
                $e->getMessage(),
=======
        $numTests = count($this->tests);

        // The given file may contain further stub classes in addition to the
        // test class itself. Figure out the actual test class.
        $filename   = FileLoader::checkAndLoad($filename);
        $newClasses = array_slice(get_declared_classes(), $this->declaredClassesPointer);

        // The diff is empty in case a parent class (with test methods) is added
        // AFTER a child class that inherited from it. To account for that case,
        // accumulate all discovered classes, so the parent class may be found in
        // a later invocation.
        if (!empty($newClasses)) {
            // On the assumption that test classes are defined first in files,
            // process discovered classes in approximate LIFO order, so as to
            // avoid unnecessary reflection.
            $this->foundClasses           = array_merge($newClasses, $this->foundClasses);
            $this->declaredClassesPointer = count(get_declared_classes());
        }

        // The test class's name must match the filename, either in full, or as
        // a PEAR/PSR-0 prefixed short name ('NameSpace_ShortName'), or as a
        // PSR-1 local short name ('NameSpace\ShortName'). The comparison must be
        // anchored to prevent false-positive matches (e.g., 'OtherShortName').
        $shortName      = basename($filename, '.php');
        $shortNameRegEx = '/(?:^|_|\\\\)' . preg_quote($shortName, '/') . '$/';

        foreach ($this->foundClasses as $i => $className) {
            if (preg_match($shortNameRegEx, $className)) {
                try {
                    $class = new ReflectionClass($className);
                    // @codeCoverageIgnoreStart
                } catch (ReflectionException $e) {
                    throw new Exception(
                        $e->getMessage(),
                        $e->getCode(),
                        $e
                    );
                }
                // @codeCoverageIgnoreEnd

                if ($class->getFileName() == $filename) {
                    $newClasses = [$className];
                    unset($this->foundClasses[$i]);

                    break;
                }
            }
        }

        foreach ($newClasses as $className) {
            try {
                $class = new ReflectionClass($className);
                // @codeCoverageIgnoreStart
            } catch (ReflectionException $e) {
                throw new Exception(
                    $e->getMessage(),
                    $e->getCode(),
                    $e
                );
            }
            // @codeCoverageIgnoreEnd

            if (dirname($class->getFileName()) === __DIR__) {
                continue;
            }

            if ($class->isAbstract() && $class->isSubclassOf(TestCase::class)) {
                $this->addWarning(
                    sprintf(
                        'Abstract test case classes with "Test" suffix are deprecated (%s)',
                        $class->getName()
                    )
                );
            }

            if (!$class->isAbstract()) {
                if ($class->hasMethod(BaseTestRunner::SUITE_METHODNAME)) {
                    try {
                        $method = $class->getMethod(
                            BaseTestRunner::SUITE_METHODNAME
                        );
                        // @codeCoverageIgnoreStart
                    } catch (ReflectionException $e) {
                        throw new Exception(
                            $e->getMessage(),
                            $e->getCode(),
                            $e
                        );
                    }
                    // @codeCoverageIgnoreEnd

                    if ($method->isStatic()) {
                        $this->addTest($method->invoke(null, $className));
                    }
                } elseif ($class->implementsInterface(Test::class)) {
                    // Do we have modern namespacing ('Foo\Bar\WhizBangTest') or old-school namespacing ('Foo_Bar_WhizBangTest')?
                    $isPsr0            = (!$class->inNamespace()) && (strpos($class->getName(), '_') !== false);
                    $expectedClassName = $isPsr0 ? $className : $shortName;

                    if (($pos = strpos($expectedClassName, '.')) !== false) {
                        $expectedClassName = substr(
                            $expectedClassName,
                            0,
                            $pos
                        );
                    }

                    if ($class->getShortName() !== $expectedClassName) {
                        $this->addWarning(
                            sprintf(
                                "Test case class not matching filename is deprecated\n               in %s\n               Class name was '%s', expected '%s'",
                                $filename,
                                $class->getShortName(),
                                $expectedClassName
                            )
                        );
                    }

                    $this->addTestSuite($class);
                }
            }
        }

        if (count($this->tests) > ++$numTests) {
            $this->addWarning(
                sprintf(
                    "Multiple test case classes per file is deprecated\n               in %s",
                    $filename
                )
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            );
        }
    }

    /**
     * Wrapper for addTestFile() that adds multiple test files.
     *
     * @throws Exception
     */
    public function addTestFiles(iterable $fileNames): void
    {
        foreach ($fileNames as $filename) {
            $this->addTestFile((string) $filename);
        }
    }

    /**
     * Counts the number of test cases that will be run by this test.
     */
    public function count(): int
    {
        $numTests = 0;

        foreach ($this as $test) {
            $numTests += count($test);
        }

        return $numTests;
    }

    public function isEmpty(): bool
    {
        return empty($this->tests);
    }

    /**
     * @psalm-return non-empty-string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Returns the test groups of the suite.
     *
     * @psalm-return list<string>
     */
    public function groups(): array
    {
        return array_map(
<<<<<<< HEAD
            'strval',
            array_keys($this->groups),
=======
            static function ($key): string
            {
                return (string) $key;
            },
            array_keys($this->groups)
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
        );
    }

    public function groupDetails(): array
    {
        return $this->groups;
    }

    /**
     * @throws \SebastianBergmann\CodeCoverage\InvalidArgumentException
     * @throws CodeCoverageException
     * @throws Event\RuntimeException
     * @throws Exception
     * @throws NoPreviousThrowableException
     * @throws UnintentionallyCoveredCodeException
     */
    public function run(): void
    {
        if (count($this) === 0) {
            return;
        }

        $emitter                       = Event\Facade::emitter();
        $testSuiteValueObjectForEvents = Event\TestSuite\TestSuiteBuilder::from($this);

        $emitter->testSuiteStarted($testSuiteValueObjectForEvents);

<<<<<<< HEAD
        if (!$this->invokeMethodsBeforeFirstTest($emitter, $testSuiteValueObjectForEvents)) {
            return;
=======
        $test = null;

        if ($this->testCase && class_exists($this->name, false)) {
            try {
                foreach ($hookMethods['beforeClass'] as $beforeClassMethod) {
                    if (method_exists($this->name, $beforeClassMethod)) {
                        if ($missingRequirements = TestUtil::getMissingRequirements($this->name, $beforeClassMethod)) {
                            $this->markTestSuiteSkipped(implode(PHP_EOL, $missingRequirements));
                        }

                        call_user_func([$this->name, $beforeClassMethod]);
                    }
                }
            } catch (SkippedTestSuiteError|SkippedTestError $error) {
                foreach ($this->tests() as $test) {
                    $result->startTest($test);
                    $result->addFailure($test, $error, 0);
                    $result->endTest($test, 0);
                }

                $result->endTestSuite($this);

                return $result;
            } catch (Throwable $t) {
                $errorAdded = false;

                foreach ($this->tests() as $test) {
                    if ($result->shouldStop()) {
                        break;
                    }

                    $result->startTest($test);

                    if (!$errorAdded) {
                        $result->addError($test, $t, 0);

                        $errorAdded = true;
                    } else {
                        $result->addFailure(
                            $test,
                            new SkippedTestError('Test skipped because of an error in hook method'),
                            0
                        );
                    }

                    $result->endTest($test, 0);
                }

                $result->endTestSuite($this);

                return $result;
            }
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
        }

        foreach ($this as $test) {
            if (TestResultFacade::shouldStop()) {
                $emitter->testRunnerExecutionAborted();

                break;
            }

            $test->run();
        }

        $this->invokeMethodsAfterLastTest($emitter);

        $emitter->testSuiteFinished($testSuiteValueObjectForEvents);
    }

    /**
     * Returns the tests as an enumeration.
     *
     * @psalm-return list<Test>
     */
    public function tests(): array
    {
        return $this->tests;
    }

    /**
     * Set tests of the test suite.
     *
     * @psalm-param list<Test> $tests
     */
    public function setTests(array $tests): void
    {
        $this->tests = $tests;
    }

    /**
     * Mark the test suite as skipped.
     *
     * @throws SkippedTestSuiteError
     */
    public function markTestSuiteSkipped(string $message = ''): never
    {
        throw new SkippedTestSuiteError($message);
    }

    /**
     * Returns an iterator for this test suite.
     */
    public function getIterator(): Iterator
    {
        $iterator = new TestSuiteIterator($this);

        if ($this->iteratorFilter !== null) {
            $iterator = $this->iteratorFilter->factory($iterator, $this);
        }

        return $iterator;
    }

    public function injectFilter(Factory $filter): void
    {
        $this->iteratorFilter = $filter;

        foreach ($this as $test) {
            if ($test instanceof self) {
                $test->injectFilter($filter);
            }
        }
    }

    /**
     * @psalm-return list<ExecutionOrderDependency>
     */
    public function provides(): array
    {
        if ($this->providedTests === null) {
            $this->providedTests = [];

            if (is_callable($this->sortId(), true)) {
                $this->providedTests[] = new ExecutionOrderDependency($this->sortId());
            }

            foreach ($this->tests as $test) {
                if (!($test instanceof Reorderable)) {
                    continue;
                }

                $this->providedTests = ExecutionOrderDependency::mergeUnique($this->providedTests, $test->provides());
            }
        }

        return $this->providedTests;
    }

    /**
     * @psalm-return list<ExecutionOrderDependency>
     */
    public function requires(): array
    {
        if ($this->requiredTests === null) {
            $this->requiredTests = [];

            foreach ($this->tests as $test) {
                if (!($test instanceof Reorderable)) {
                    continue;
                }

                $this->requiredTests = ExecutionOrderDependency::mergeUnique(
                    ExecutionOrderDependency::filterInvalid($this->requiredTests),
                    $test->requires()
                );
            }

            $this->requiredTests = ExecutionOrderDependency::diff($this->requiredTests, $this->provides());
        }

        return $this->requiredTests;
    }

    public function sortId(): string
    {
        return $this->name() . '::class';
    }

    /**
     * @psalm-assert-if-true class-string $this->name
     */
    public function isForTestClass(): bool
    {
        return class_exists($this->name, false) && is_subclass_of($this->name, TestCase::class);
    }

    /**
     * @throws \PHPUnit\Event\TestData\MoreThanOneDataSetFromDataProviderException
     * @throws Exception
     */
    protected function addTestMethod(ReflectionClass $class, ReflectionMethod $method): void
    {
        $className  = $class->getName();
        $methodName = $method->getName();

        assert(!empty($methodName));

        try {
            $test = (new TestBuilder)->build($class, $methodName);
        } catch (InvalidDataProviderException $e) {
            Event\Facade::emitter()->testTriggeredPhpunitError(
                new TestMethod(
                    $className,
                    $methodName,
                    $class->getFileName(),
                    $method->getStartLine(),
                    Event\Code\TestDoxBuilder::fromClassNameAndMethodName(
                        $className,
                        $methodName,
                    ),
                    MetadataCollection::fromArray([]),
                    Event\TestData\TestDataCollection::fromArray([]),
                ),
                sprintf(
                    "The data provider specified for %s::%s is invalid\n%s",
                    $className,
                    $methodName,
                    $this->throwableToString($e),
                ),
            );

            return;
        }

        if ($test instanceof TestCase || $test instanceof DataProviderTestSuite) {
            $test->setDependencies(
<<<<<<< HEAD
                Dependencies::dependencies($class->getName(), $methodName),
=======
                TestUtil::getDependencies($class->getName(), $methodName)
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
            );
        }

        $this->addTest(
            $test,
<<<<<<< HEAD
            (new Groups)->groups($class->getName(), $methodName),
=======
            TestUtil::getGroups($class->getName(), $methodName)
>>>>>>> parent of 97d0a381 (Merge branch 'aplicacion_asincronica' into Pruebas)
        );
    }

    private function clearCaches(): void
    {
        $this->providedTests = null;
        $this->requiredTests = null;
    }

    private function containsOnlyVirtualGroups(array $groups): bool
    {
        foreach ($groups as $group) {
            if (!str_starts_with($group, '__phpunit_')) {
                return false;
            }
        }

        return true;
    }

    private function methodDoesNotExistOrIsDeclaredInTestCase(string $methodName): bool
    {
        $reflector = new ReflectionClass($this->name);

        return !$reflector->hasMethod($methodName) ||
               $reflector->getMethod($methodName)->getDeclaringClass()->getName() === TestCase::class;
    }

    /**
     * @throws Exception
     */
    private function throwableToString(Throwable $t): string
    {
        $message = $t->getMessage();

        if (empty(trim($message))) {
            $message = '<no message>';
        }

        if ($t instanceof InvalidDataProviderException) {
            return sprintf(
                "%s\n%s",
                $message,
                Filter::getFilteredStacktrace($t),
            );
        }

        return sprintf(
            "%s: %s\n%s",
            $t::class,
            $message,
            Filter::getFilteredStacktrace($t),
        );
    }

    /**
     * @throws Exception
     * @throws NoPreviousThrowableException
     */
    private function invokeMethodsBeforeFirstTest(Event\Emitter $emitter, Event\TestSuite\TestSuite $testSuiteValueObjectForEvents): bool
    {
        if (!$this->isForTestClass()) {
            return true;
        }

        $methodsCalledBeforeFirstTest = [];

        $beforeClassMethods = (new HookMethods)->hookMethods($this->name)['beforeClass'];

        try {
            foreach ($beforeClassMethods as $beforeClassMethod) {
                if ($this->methodDoesNotExistOrIsDeclaredInTestCase($beforeClassMethod)) {
                    continue;
                }

                if ($missingRequirements = (new Requirements)->requirementsNotSatisfiedFor($this->name, $beforeClassMethod)) {
                    $this->markTestSuiteSkipped(implode(PHP_EOL, $missingRequirements));
                }

                $methodCalledBeforeFirstTest = new Event\Code\ClassMethod(
                    $this->name,
                    $beforeClassMethod,
                );

                $emitter->testBeforeFirstTestMethodCalled(
                    $this->name,
                    $methodCalledBeforeFirstTest,
                );

                $methodsCalledBeforeFirstTest[] = $methodCalledBeforeFirstTest;

                call_user_func([$this->name, $beforeClassMethod]);
            }
        } catch (SkippedTest|SkippedTestSuiteError $e) {
            $emitter->testSuiteSkipped(
                $testSuiteValueObjectForEvents,
                $e->getMessage(),
            );

            return false;
        } catch (Throwable $t) {
            assert(isset($methodCalledBeforeFirstTest));

            $emitter->testBeforeFirstTestMethodErrored(
                $this->name,
                $methodCalledBeforeFirstTest,
                Event\Code\ThrowableBuilder::from($t),
            );

            if (!empty($methodsCalledBeforeFirstTest)) {
                $emitter->testBeforeFirstTestMethodFinished(
                    $this->name,
                    ...$methodsCalledBeforeFirstTest,
                );
            }

            return false;
        }

        if (!empty($methodsCalledBeforeFirstTest)) {
            $emitter->testBeforeFirstTestMethodFinished(
                $this->name,
                ...$methodsCalledBeforeFirstTest,
            );
        }

        return true;
    }

    private function invokeMethodsAfterLastTest(Event\Emitter $emitter): void
    {
        if (!$this->isForTestClass()) {
            return;
        }

        $methodsCalledAfterLastTest = [];

        $afterClassMethods = (new HookMethods)->hookMethods($this->name)['afterClass'];

        foreach ($afterClassMethods as $afterClassMethod) {
            if ($this->methodDoesNotExistOrIsDeclaredInTestCase($afterClassMethod)) {
                continue;
            }

            try {
                call_user_func([$this->name, $afterClassMethod]);

                $methodCalledAfterLastTest = new Event\Code\ClassMethod(
                    $this->name,
                    $afterClassMethod,
                );

                $emitter->testAfterLastTestMethodCalled(
                    $this->name,
                    $methodCalledAfterLastTest,
                );

                $methodsCalledAfterLastTest[] = $methodCalledAfterLastTest;
            } catch (Throwable) {
                // @todo
            }
        }

        if (!empty($methodsCalledAfterLastTest)) {
            $emitter->testAfterLastTestMethodFinished(
                $this->name,
                ...$methodsCalledAfterLastTest,
            );
        }
    }
}
