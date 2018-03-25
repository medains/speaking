<?php

class SmallAssertionTest extends PHPUnit_Framework_TestCase {

    public function testSomeKindOfRenderFunction() {
        $config = new MockConfig();
        $response = new MockResponseDependency();
        $database = new MockDb();
        $templateData = [
            'report' => [
                'title' => 'Some kind of outline report',
                'campaigns' => [ 352789, 3248, 213980 ],
                'sites' => [8324, 214, 12, 35235],
                'start_date' => '2017-02-01',
                'end_date' => '2017-05-01'
            ]
        ];
        $fixture = \Mockery::mock('ControllerUnderTest[getReport]', [
            'getReport' => \Mockery::mock([
                'getTemplate' => $templateData
            ])
        ], [$config, $response]);
        SomeFactory::setInstance($database);
        $result = $fixture->action();
        A
            $this->assertTrue(false !== strpos($response->getBody(), 'outline report'));
    }
}
