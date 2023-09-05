<?php

/**
 * @file
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container) {
  $container->extension('framework', [
    'remote-event' => [
      'enabled' => TRUE,
    ],
  ]);
};
