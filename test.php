<?php
    $str_json = '{"query":"insert_exam","examName":"Exam 2","questions":[{"qid":"14","points":"75"},{"qid":"15","points":"25"}]}';
    $response = json_decode($str_json, true);

    $questions = $response['questions'];
    $indices = count($questions);
    for ($x = 0; $x < $indices; $x++)
    {
        echo $questions[$x]['qid'];
    } 
?>