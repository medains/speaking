<?php
class ClassUnderTest {

    const MAX = 200;

    public function __construct($logger) {
        $this->logger = $logger;
    }

    public function methodUnderTest($param1, $param2) {
        $this->logger->debug('this does something', $param1, $param2);
        // Manipulate params and do something
        $result = $param1 + $param2;
        if( $result > self::MAX ) {
            $this->logger->warn('result out of range', $result);
            return self::MAX;
        }
        return $result;
    }
}
