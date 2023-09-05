<?php

namespace App\Controller;

use App\Webhook\TgEvent;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Conference Controller.
 */
class HomeController extends AbstractController {

  /**
   * Route.
   */
  #[Route('/', name: 'homepage')]
  public function index(LoggerInterface $logger): Response {
    $logger->warning("Hello world");
    return $this->render('layout/index.html.twig', [
      'hello' => 'world!',
    ]);
  }

  /**
   * Route Blank example with inline teplate.
   */
  #[Route('/blank', name: 'blank')]
  #[Route('/blank/{hello}', name: 'blank')]
  public function indexBlank(Request $request, string $hello = 'world'): Response {
    dump($request);
    $content = <<<EOF
          <html>
              <body>
                  Hello world! ☃️
              </body>
          </html>
          EOF;
    return new Response($content);
  }

}
