.. code:: php

    <?php
    class AtomicCounterExample extends PHPUnit_Framework_TestCase {
        protected static $fixture;
        public static function setupBeforeClass() {
            self::$fixture = new ClassUnderTest();
        }
        public function testSetValue() {
            self::$fixture->setValue(15);
            $this->assertEquals(15, self::$fixture->getValue());
        }
        public function testMultiplyValue() {
            self::$fixture->multipleValue(2);
            $this->assertEquals(30, self::$fixture->getValue());
        }
    }
