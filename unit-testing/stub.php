<?php
class ClassUnderTest {

    public function __construct($auth) {
        $this->auth = $auth;
    }

    public function authenticatedAction($authToken) {
        $authenticated = $this->auth->checkToken($authToken);

        if(!$authenticated) {
            throw NotAuthException();
        }
        return $this->protectedMethod();
    }
}
