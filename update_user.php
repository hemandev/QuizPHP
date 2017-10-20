<?php
/**
 * Created by PhpStorm.
 * User: Hemand
 * Date: 10/18/2017
 * Time: 7:03 PM
 */
session_start();
include 'DB_CONNECT.php';

$conn = get_connection();
$user_ans = $_POST['answer'];

$username = $_SESSION['uid'];

$uid_query = "SELECT  id FROM user WHERE email='$username';";
$uid = $conn->query($uid_query)->fetch_assoc();
$uid = (int)$uid['id'];

$sql = "SELECT * FROM user_test_attempts WHERE user_id='$uid' AND attempt_status='IN PROGRESS';";
$sql = $conn->query($sql)->fetch_assoc();
$id = (int)$sql['id'];
$current_question = (int)$sql['current_question'];
$attemp_id = (int)$sql['id'];
$score = (int)$sql['score'];
$flag = 0;
$count = (int)$sql['count'];
if($count <= 9) {



$questions = (array)json_decode($sql['questions']);


$questions = (array)$questions[$count];

}
else{
    $flag = 1;
}
$count++;


$sql3 = "SELECT * FROM question WHERE id='$current_question'";
$sql3 = $conn->query($sql3)->fetch_assoc();
$ans = $sql3['ans'];
$result = 0;
if ($ans === $user_ans) {
    global $result, $score;
    $score++;
    $result = 1;
}


$sql4 = "INSERT INTO attemp_answer (attempt_id, question_id, answer, result)
          VALUES ('$attemp_id', '$current_question', '$user_ans','$result')";
$sql4 = $conn->query($sql4);

if ($flag == 1)
    $next_question_id = $current_question;
else
    $next_question_id = (int)$questions['id'];


$sql2 = $conn->prepare("UPDATE user_test_attempts SET count=?,  score=?, current_question=?  WHERE id=?");
$sql2->bind_param("iiii", $count, $score, $next_question_id, $id);
$sql2->execute();
$sql2->close();


//$sql2 = $conn->query($sql2);

if ($flag == 1) {


    $sql2 = $conn->prepare("UPDATE user_test_attempts SET  attempt_status=?  WHERE id=?");
    $com = "COMPLETED";
    $sql2->bind_param("si", $com, $id);
    $sql2->execute();
    $sql2->close();

    $ans_array = array();
    $ans_array['score'] = $score;
    $ans_array['count'] = 11;
    echo json_encode($ans_array);


} else {

    $sql5 = "SELECT id,question,op1,op2,op3,op4 FROM question WHERE id='$next_question_id'";
    $exe = $conn->query($sql5)->fetch_assoc();
    $exe['level'] = $count;
    $exe = json_encode($exe);
    echo $exe;
}