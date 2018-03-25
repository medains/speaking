<?php
class NotAUnitTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $config = Config::getConfig();
        Config::setConfigOption("redirect.ids", array(100, 101);
        $dir = $config->db->fixture->sqlpath;
        $loader = new Test_FixtureLoader($dir);
        Config::setFeatureForTest('featureundertest', false);
    }
    public function tearDown() {
        Factory::reset();
    }
    public function test_redirect() {
        Factory::mockRedirectLookup();
        $this->dispatch('/redirect-me/something/100');
        $this->assertRedirect();
    }
    public function dispatch($url) {
        // lots of code bootstrapping the app and routing the request
    }
}
