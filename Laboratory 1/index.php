<?php 
include 'Words.php';
include 'Test.php';

session_start();
$words = new Words();
$test = new Test();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_POST['submitWord'])){
            $words->addWord($_POST['eng'], $_POST['geo']);
        }
    ?>
    <form action="" method="post">
        Add a word to the dictionary: <br>
        English: <input type="text" name="eng" id="eng"> - Georgian: <input type="text" name="geo" id="geo">
        <input type="submit" name="submitWord" value="Add">
    </form>
    <br>
    <strong>Dictionary database: </strong><br>
    <?php
        $words->getWords();
    ?>
    
    <br>
    <form action="" method="post">
        <input type="submit" name="startTest" value="Take a test">
    </form><br>

    <?php
        if(isset($_POST['startTest'])){
            $test->startTest();
        }
        if(isset($_POST['submitTest'])){
            $test->checkTest($_POST);
        }
    ?>
</body>
</html>