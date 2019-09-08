<?php

namespace App\Controller;

use App\Entity\Builder\CharacterBuilder;
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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var CharactersService
     */
    private $characterService;

    /**
     * FrontendController constructor.
     * @param LoggerInterface $logger
     * @param CharactersService $characterService
     */
    public function __construct(LoggerInterface $logger, CharactersService $characterService)
    {
        $this->logger           = $logger;
        $this->characterService = $characterService;
    }

    /**
     * @Route("/")
     */
    public function homepage()
    {
        $this->logger->info("Iniciando homepage");
        $this->logger->info("Buscando herois favoritos");
        //$characteres = null ; //$this->getMyFavoriteHeroes();
        $characteres = $this->getMyFavoriteHeroes();
        $this->logger->info("Busca por herois favoritos encerrada");

        return $this->render('frontend/homepage.html.twig', [
            "characters" => $characteres
        ]);
    }

    private function getMyFavoriteHeroes()
    {
        $myStartNamesFromMyFavoriteHeroes = ["Iron man", "Wolverine", "Thor"];
        $myFavoriteHeroes = [];
        $builder = new CharacterBuilder();
        foreach ($myStartNamesFromMyFavoriteHeroes as $heroToSearch) {
            $response = $this->characterService->findByNameStartWith($heroToSearch);
            $this->logger->info("Buscando [$heroToSearch]");
            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getContent(), 1);
                $character = $builder->build($data["data"]["results"][0]);
                $myFavoriteHeroes[] = $character;
                $this->logger->info("[$heroToSearch] encontrado");
            }
        }
        return $myFavoriteHeroes;
    }
}