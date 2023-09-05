<?php

/**
 * @file
 * Bundles.
 */

use Symfony\Bundle\DebugBundle\DebugBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;

return [
  FrameworkBundle::class => ['all' => TRUE],
  TwigBundle::class => ['all' => TRUE],
  WebProfilerBundle::class => ['all' => TRUE],
  MonologBundle::class => ['all' => TRUE],
  DebugBundle::class => ['dev' => TRUE, 'test' => TRUE],
];
