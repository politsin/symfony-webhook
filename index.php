<?php

/**
 * @file
 * Exec !/usr/bin/env php.
 *
 * Git: https://github.com/the-fast-track/book-6.2-1
 */

require __DIR__ . '/vendor/autoload_runtime.php';
// Require __DIR__ . '/vendor/autoload.php';.
use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

if (TRUE) {
  return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
  };
}
else {
  $dotenv = new Dotenv();
  // print_r($_SERVER);
  $dotenv->load("{$_SERVER['DOCUMENT_ROOT']}/.env");

  if ($_ENV['APP_DEBUG']) {
    umask(0000);
    Debug::enable();
  }

  $kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
  $request = Request::createFromGlobals();
  $response = $kernel->handle($request);
  $response->send();
  $kernel->terminate($request, $response);
}
