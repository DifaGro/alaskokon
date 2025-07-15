<?php
session_start();
session_destroy();
header("Location: ../guest/index.php");
exit();
