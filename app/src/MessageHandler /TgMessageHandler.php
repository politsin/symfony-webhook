<?php

namespace App\MessageHandler;

use App\Message\TgMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Tg Message Handler.
 */
#[AsMessageHandler(name: 'tg')]
final class TgMessageHandler implements MessageHandlerInterface {

  /**
   * Invoke.
   */
  public function __invoke(TgMessage $message) {
    dump('__invoke');
  }

}
