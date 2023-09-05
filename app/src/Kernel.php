<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * Kernel wtf in accets.
 */
class Kernel extends BaseKernel {
  use MicroKernelTrait;

  /**
   * Get ProjectDir.
   */
  public function getProjectDir(): string {
    // function_exists('apcu_clear_cache') ? apcu_clear_cache() : FALSE;.
    return \dirname(__DIR__) . "";
  }

}
