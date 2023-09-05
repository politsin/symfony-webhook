<?php

namespace App\Service;

use Elastic\Elasticsearch\Client;
// V7 elastic:
// use Elasticsearch\Client;
// use Elasticsearch\ClientBuilder;.
// v8 elastic:
use Elastic\Elasticsearch\ClientBuilder;

/**
 * Elastic Gate Way.
 */
class ElasticGw {

  // phpcs:disable
  protected Client $elastic;
  private string $index;
  // phpcs:enable

  /**
   * Constructs a Elastic.
   */
  public function __construct() {
    $this->index = $_ENV['ELASTIC_INDEX'];
    $this->elastic = ClientBuilder::create()
      ->setHosts([$_ENV['ELASTIC_URL']])
      ->setSSLVerification(FALSE)
      ->setBasicAuthentication($_ENV['ELASTIC_USER'], $_ENV['ELASTIC_PASS'])
      ->build();
  }

  /**
   * Run.
   */
  public function info() : string {
    $client = $this->elastic;
    $response = $client->info();
    dump($response);
    return "Ok";
  }

  /**
   * Run.
   */
  public function run() : string {
    $client = $this->elastic;
    $response = $client->info();
    // dump($response);
    // $this->createIndex();
    $data = [
      'hello' => 'world',
      'foo' => 'bar',
      'random' => rand(),
    ];
    $this->index($data, "-");
    // $this->get("oabLbYkBMGsIBy7Pl0Sz");s
    $this->search();
    return "Ok";
  }

  /**
   * Search.
   */
  public function search() : string {
    $client = $this->elastic;
    $params = [
      'index' => $this->index,
      'size'   => 100,
      // Период для сохранения контекста поиска.
      'scroll'      => '30s',
      'body' => [
        'query' => [
          'match' => [
            'hello' => 'world',
          ],
        ],
      ],
    ];
    $response = $client->search($params);
    dump($response);
    return "Ok";
  }

  /**
   * Get.
   */
  public function get(string $id) : string {
    $client = $this->elastic;
    $params = [
      'index' => $this->index,
      'id' => $id,
    ];
    $response = $client->get($params);
    return "Ok";
  }

  /**
   * Index (create). todo: update delete.
   */
  public function index(array $data, string $date) : string {
    $client = $this->elastic;
    $params = [
      // 'id' => $data['id'],
      // 'timestamp' => $data['timestamp'],
      'index' => $this->index . "-$date",
      'body' => $data,
    ];
    $response = $client->index($params);
    return "Ok";
  }

  /**
   * Create index. todo: delete index.
   */
  public function createIndex() : string {
    $client = $this->elastic;
    $params = [
      'index' => $this->index,
    ];
    $response = $client->indices()->create($params);
    return "Ok";
  }

}
