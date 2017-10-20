<?php
/**
 * Created by PhpStorm.
 * User: Hemand
 * Date: 10/17/2017
 * Time: 10:58 PM
 */

define("db_name", "quizdb");
define("db_user", "admin");
define("db_pass", "admin");
define("db_host", "localhost");


function get_connection()
{

    $conn = new mysqli(db_host, db_user, db_pass, db_name);
    if ($conn)


        return $conn;


    else
        return null;
}

