<?php
/**
 * Created by PhpStorm.
 * User: Hemand
 * Date: 10/17/2017
 * Time: 11:51 PM
 */
session_start();
unset($_SESSION['uid']);
header("location: index.php");