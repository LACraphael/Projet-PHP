<?php
session_start();
session_destroy();
header("Location: membres.php");
