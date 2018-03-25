<?php
class TrustworthyCounterExample extends PHPUnit_Framework_TestCase {
    public function testUnixTime() {
        $baseTime = 0; // Midnight 1st January 1970
        $this->assertEquals('1970-01-01', date('Y-m-d', $baseTime));
    }
}
