<?php

class WellStructuredTest extends PHPUnit_Framework_TestCase {
    protected $mockDependency;

    public function setUp() { // common setup (also setUpBeforeClass)
        $this->mockDependency = $this->getMock(Dependency::class, ['someMethod']);
    }
    public function tearDown() { // common teardown (also teardownAfterClass)
        unset $this->mockDependency;
    }
    public function testFunctionBehavesAsExpected() {
        // setup
        $underTest = new ClassUnderTest($this->mockDependency);
        // execute
        $result = $underTest->exercise('a thing');
        // verify
        $this->assertEquals('a result', $result);
        // teardown
        $underTest->closeFiles();
    }
}
