<?php
class ClassUnderTest {

    public function __construct($abstractedDb) {
        $this->db = $abstractedDb;
    }

    protected function transform($data) {
        // manipulate the data
        return $transformed;
    }

    public function getSetDate($idArray) {
        $result = [];
        foreach($idArray as $id) {
            $row = $this->db->get($id);
            if($row) {
                $result[] = $this->transform($row);
            }
        }
        return $result;
    }
}
