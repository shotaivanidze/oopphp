<?php
include_once('Database.php');

class Test extends Database {
    public function startTest(){
        $sql = "SELECT * FROM words order by RAND() LIMIT 5";
        $stmt = $this->connect()->query($sql);
        $arr = $stmt->fetch();

    }
}

?>