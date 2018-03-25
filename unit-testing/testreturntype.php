<?php

class testClass extends PHPUnit_Framework_TestCase {

    public function testStringReturn() {
        $fixture = new ClassUnderTest();
        $this->assertInternalType('string', $fixture->getTemplate());
    }
}

class ClassUnderTest {

    public function getTemplate() {
        return 'A template';
    }
}
