<?php
  if (isset($_GET['toggleTheme'])) {
    $toggleTheme = filter_var($_GET['toggleTheme'], FILTER_VALIDATE_BOOLEAN);
    setcookie("toggleTheme", $toggleTheme, time() + (86400 * 30 * 7), "/");
  }
