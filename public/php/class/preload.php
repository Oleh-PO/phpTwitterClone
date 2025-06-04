<?php


class preload {
  function __construct() {
    spl_autoload_register(function ($trait) {
      $fileName = stream_resolve_include_path($_SERVER['DOCUMENT_ROOT'] . '/php/traits/' . $trait . '.php');
      if ($fileName !== false) {
        require_once $fileName;
      }
    });

    spl_autoload_register(function ($class) {
      $fileName = stream_resolve_include_path($_SERVER['DOCUMENT_ROOT'] . '/php/class/' . $class . '.php');
      if ($fileName !== false) {
        require_once $fileName;
      }
    });
  }
}
