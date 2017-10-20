<?php
/**
 * Created by PhpStorm.
 * User: Hemand
 * Date: 10/18/2017
 * Time: 12:35 AM
 */

session_start();

include "DB_CONNECT.php";

$conn = get_connection();

//var_dump(json_encode($_POST));

$username = $_SESSION['uid'];

$sql = "SELECT  id FROM question ORDER BY RAND() LIMIT 10;";

$uid_query = "SELECT  id FROM user WHERE email='$username';";
$uid = $conn->query($uid_query)->fetch_assoc();
$uid = (int)$uid['id'];
$result = $conn->query($sql);

$arr = array();

if ($result->num_rows > 0) {


    while ($row = $result->fetch_assoc()) {

        $arr[] = $row;


    }


    $jso = json_encode($arr);
    $id = (int) $arr[0]['id'];

    $sql2 = "INSERT INTO user_test_attempts (user_id, test_id, questions, current_question, score, attempt_status) 
              VALUES ('$uid', 1, '$jso', '$id', 0, 'IN PROGRESS' )";

    $exec = $conn->query($sql2);




    $sql3 = "SELECT id,question,op1,op2,op3,op4 FROM question WHERE id='$id'";
    $exe = $conn->query($sql3)->fetch_assoc();
    $exe['level'] = "1";
    $exe = json_encode($exe);
    echo $exe;


}