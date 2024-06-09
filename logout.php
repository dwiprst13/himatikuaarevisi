<?php
session_start();
session_destroy(); //Menghapus semua data yanga da dalam session
header("Location: index.php");
exit;
