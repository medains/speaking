<?php
class MaintenanceCounterExample
    extends \UnrelatedNamespace\AbstractBaseTest {

    public function testAC19win_lines()
    {
        $s= $this->getTestData(20);
            $r = ClassBeignTested::findLines($s, 'AC19');

            $this->assertCount(20, $r);
        $r = $this->removeDup( $r );
            $this->assertCount( 20, $r);
                foreach( $r as $rt) {
                $this->assertCount(19, $rt);
 }
 }

}
