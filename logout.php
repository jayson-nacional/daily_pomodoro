<?php

setcookie("TestJwt", "", time() - 3600);
header("Location: /dailypomodoro/login.php");
exit();
