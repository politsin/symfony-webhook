<?php

namespace App\Webhook;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\ChainRequestMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcher\MethodRequestMatcher;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;
use Symfony\Component\RemoteEvent\RemoteEvent;
use Symfony\Component\Webhook\Client\AbstractRequestParser;

/**
 * Tg Webhook Parser.
 */
final class TgWebhookParser extends AbstractRequestParser {

  //phpcs:ignore
  private LoggerInterface $logger;

  /**
   * Construct.
   */
  public function __construct(LoggerInterface $logger) {
    $this->logger = $logger;
  }

  /**
   * Get Request Matcher.
   */
  protected function getRequestMatcher(): RequestMatcherInterface {
    // These define the conditions that the incoming webhook request
    // must match in order to be handled by this parser.
    return new ChainRequestMatcher([
      // New IsJsonRequestMatcher(),
      new MethodRequestMatcher(['POST', 'GET']),
    ]);
  }

  /**
   * Do Parse.
   */
  protected function doParse(Request $request, string $secret): ?RemoteEvent {
    // dump("-- $secret");.
    // $this->logger->warning("webhook doParse - $secret");.
    $date = new \DateTimeImmutable();
    $data = [
      'event_date' => date("Y-m-d"),
      'event_time' => $date->format(\DateTimeInterface::RFC3339),
      'payload' => $request->toArray(),
    ];
    return new RemoteEvent('My event name', 'My event-id', $data);
  }

}
