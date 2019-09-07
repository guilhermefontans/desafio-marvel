<?php

namespace App\Controller;

use App\Service\CharactersService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FrontendController
 * @package App\Controller
 */
class FrontendController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage(LoggerInterface $logger)
    {
        $logger->info("Iniciando homepage");

        $characterService = new CharactersService();
        $characteres = $characterService->request();
        $characteres = json_decode($characteres->getContent());
        return $this->render('frontend/homepage.html.twig', [
            "characters" => $characteres->data->results
        ]);
    }
}