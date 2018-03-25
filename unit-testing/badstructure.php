<?php
class CommonTestClass extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $this->login();
    }
    public function login() {
        $request = new Request('POST', '/login');
        $request->setParams(['username' => 'valid', 'password' => 'value']);
        $request->send();
        $this->assertEquals('/logged-in', $request->endLocation());
    }
}

class DetailedTestClass extends CommonTestClass {
    public function testEditAction() {
        $request = new Request('GET', '/edit/1');
        $request->send();
        $this->assertEquals('/edit/1', $request->endLocation());
    }
}

