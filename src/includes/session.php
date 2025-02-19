<?php
  session_start();
  function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }
  if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generate_random_token();
  }

  function dust_off($input){
    $input = trim($input);
    $input = strip_tags($input);
    $input = htmlspecialchars($input);
    return $input;
  }
?>