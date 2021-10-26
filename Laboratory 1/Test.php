<?php
include_once('Database.php');

class Test extends Database {
    // Function to initiate the test and query the required words
    public function startTest(){

        // Selecting 5 random words from the database
        $sql = "SELECT * FROM words order by RAND() LIMIT 5";
        $stmt = $this->connect()->query($sql);

        // Saving queried words into $wordsArray
        $wordsArray = array();

        while($row = $stmt->fetch()){
            $wordsArray[] = $row;
        }

        // Starting session to save $wordsArray into session
        $_SESSION['wordsArray'] = $wordsArray;

        $this->drawTest();

    }

    // Draw the test into html
    public function drawTest(){
        $wordsArray = $_SESSION['wordsArray'];

        ?>
        <form action="" method="post">
            <?php
                // foreach loop for each word in words array to build a form from them
                foreach($wordsArray as $word){
                    $sql = "SELECT geo FROM words WHERE id != " .$word['id']. " order by RAND() LIMIT 3";
                    // Get 3 random answers 
                    $stmt = $this->connect()->query($sql);

                    // Create answers array and append quired random answers into it
                    $answers = array();
                    while($row = $stmt->fetch()){
                        $answers[] = $row['geo'];
                    }
                    
                    // Append correct answer into the answers array
                    $answers[] = $word['geo'];

                    // Shuffle answers array so the correct answer won't be always the last option
                    shuffle($answers);
                    ?>
                    
                    <label for="<?php echo $word['eng']?>"><?php echo $word['eng']?></label><br>
                    <?php 
                    // Loop for radio input answers
                    for($i=0; $i<4; $i++ ){
                        ?>
                        <input checked type="radio" name="<?php echo $word['eng']?>" value="<?php echo $answers[$i]?>">
                        <label for="<?php echo $answers[$i]?>"><?php echo $answers[$i]?></label><br>
                        <?php
                    }
                }
            ?>
            <br><input type="submit" name="submitTest" value="Submit Test">
        </form>
        <?php 
    }

    public function checkTest($answers){
        $wordsArray = $_SESSION['wordsArray'];
        $score = 0;
        
        $submittedAnswers = array();

        foreach($answers as $ans){
            $submittedAnswers[] = $ans;
        }

        for($i=0; $i<5; $i++){
            if($submittedAnswers[$i] == $wordsArray[$i]['geo']){
                $score += 1;
            }
        }

        echo 'Your test score is: ' . $score;
    }

}

?>