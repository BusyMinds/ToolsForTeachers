<?php
  // include_once("analyticstracking.php");
  date_default_timezone_set("Asia/Manila");
  $filename = $_GET['file']; // You should sanitize this first.
  // echo $filename;
  $filepath = 'files/' . $filename;

  $logfile = "logs/downloads.txt";
  $entry = strftime("%D %r", time()) . "\t" . $filename . "\n";
  file_put_contents($logfile, $entry, FILE_APPEND | LOCK_EX);

  // @apache_setenv('no-gzip', 1);
  header("Content-length: " . filesize($filepath));
  header('Content-Type: application/vnd.ms-excel.sheet.macroEnabled.12');
  header('Content-Disposition: attachment; filename=' . $filename); // or whatever the file name is
  header('Content-Transfer-Encoding: binary');

  ob_clean();   // discard any data in the output buffer (if possible)
  flush();      // flush headers (if possible)

  readfile($filepath);
  exit();
  // header('Location: ' . $filepath, true, 200);
  // die();
  // echo $filepath . "\n";
  // echo $_SERVER['SERVER_NAME'];

  // echo "Hi there";