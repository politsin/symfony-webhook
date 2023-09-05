<?php

namespace App\Message;

/**
 * Tg Message.
 */
final class TgMessage {

  /**
   * Construct.
   */
  public function __construct(
        public string $messageId,
    ) {
  }

}
