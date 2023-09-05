<?php

namespace App\Webhook;

use App\Service\ElasticGw;
use Psr\Log\LoggerInterface;
use Symfony\Component\RemoteEvent\Attribute\AsRemoteEventConsumer;
use Symfony\Component\RemoteEvent\Consumer\ConsumerInterface;
use Symfony\Component\RemoteEvent\RemoteEvent;

/**
 * Tg Event.
 */
#[AsRemoteEventConsumer(name: 'tg')]
class TgEvent implements ConsumerInterface {

  //phpcs:disable
  private LoggerInterface $logger;
  private ElasticGw $el;
  //phpcs:enable

  /**
   * Construct.
   */
  public function __construct(LoggerInterface $logger, ElasticGw $el) {
    $this->logger = $logger;
    $this->el = $el;
  }

  /**
   * Consume - dispatch.
   */
  public function consume(RemoteEvent $event): void {
    $data = $event->getPayload();
    $payload = $data['payload'] ?? [];
    $info = [
      'event' => $payload['event'] ?? "",
      'inbox' => $payload['inbox']['name'] ?? "",
      'sender' => $payload['sender']['name'] ?? "",
      'type' => $payload['message_type'] ?? "",
      'private' => $payload['private'] ?? "",
      'message' => $payload['conversation']['messages'][0]['content'] ?? "",
    ];
    dump($info);
    $this->el->index($data, $data['event_date'] ?? date("Y-m-d"));
  }

}
