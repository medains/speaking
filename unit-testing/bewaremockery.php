<?php
use \Mockery as m;

class MockeryInTest extends PHPUnit_Framework_TestCase {
    protected $request;
    protected $response;
    protected $config;
    protected $session;
    protected $controller;

    public function tearDown() {
        m::close();
    }

    public function setUp() {
        $this->request = m::mock(\Our\Request::class.'[isMethod,getParam]');
        $this->response = m::mock(\Our\Response::class.'[setCookie,setBody]');
        $this->session = m::mock(\Our\Session::class.'[set]');
        $this->config = new Mock\Lib\Config();

        $this->controller = new ClassUnderTest($this->request, $this->response, $this->config, $this->session);
    }

    public function testAntiImageLogoutAction() {
        $expires = strtotime('24 August 2014 14:00:00 GMT');
        $token = 'thisisatoken';
        $gif = sprintf('%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c',
            71,73,70,56,57,97,1,0,1,0,128,255,0,192,192,192,0,0,0,33,249,4,1,0,0,0,0,44,0,0,0,0,1,0,1,0,0,2,2,68,1,0,59);

        $this->response
            ->shouldReceive('setCookie')->with('loginCookie','',$expires,'/','',true)
            ->shouldReceive('setBody')->with($gif);

        $this->request
            ->shouldReceive('isMethod')->with('post')->andReturn(true)
            ->shouldReceive('getParam')->with('token')->andReturn($token);

        $this->session->shouldReceive('set')->with('ssotoken', $token);

        $this->controller->logoutAction('gif');
    }
}
