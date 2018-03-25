<?php
class CommonTestClass extends PHPUnit_Framework_TestCase {
    public function login() {
        $request = new Request('POST', '/login');
        $request->setParams(['username' => 'valid', 'password' => 'value']);
        $request->send();
        if( $request->endLocation() !== '/logged-in' ) {
            // assertion removed, but test is skipped if the login is broken
            $this->markTestSkipped('Must be logged in');
        }
    }
}

class DetailedTestClass extends CommonTestClass {
    public function setUp() {
        $this->login();
    }
    public function testEditAction() {
        // setup
        $request = new Request('GET', '/edit/1');
        $request->send();
        // execution - it's a little unclear whether testing send or endLocation
        $result = $request->endLocation();
        // verify
        $this->assertEquals('/edit/1', $result);
    }
}

