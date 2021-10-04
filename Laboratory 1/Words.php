<?php
include_once('Database.php');

class Words extends Database{
    public function addWord($eng, $geo){
        $sql = "INSERT INTO words (eng, geo) VALUES (?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$eng, $geo]);
    }

    public function getWords(){
        $sql = "SELECT * FROM words";
        $stmt = $this->connect()->query($sql);
        while($row = $stmt->fetch()){
            echo 'English: ' . $row['eng'] . ' - Georgian: ' . $row['geo'] . '</br>';
        }
    }
}

?>