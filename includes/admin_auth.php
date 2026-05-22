<?php

if (!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");
    exit;

}

if ($_SESSION['user_tipo'] !== 'admin') {

    header("Location: ../cliente/dashboard.php");
    exit;

}