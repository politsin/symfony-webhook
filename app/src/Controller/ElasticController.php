<?php

namespace App\Controller;

use App\Service\ElasticGw;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Elastic Controller.
 */
class ElasticController extends AbstractController {

  /**
   * Construct.
   */
  public function __construct(
        private ElasticGw $elastic,
    ) {
  }

  /**
   * Route.
   */
  #[Route('/elastic-test', name: 'elastic')]
  public function index(): Response {
    $data = ["hello" => "world"];
    $msg = $this->elastic->index($data, date("Y-m-d"));
    dump($msg);
    $content = <<<EOF
        <html>
            <body>
                Elastic works
            </body>
        </html>
        EOF;
    return new Response($content);
  }

}
