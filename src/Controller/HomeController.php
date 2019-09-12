<?php

namespace App\Controller;

use App\Entity\Builder\CharacterBuilder;
use App\Service\CharactersService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    private const MY_FAVORITE_HEROES = [
        "Hulk",
        "Wolverine",
        "Spider-man"
    ];

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var CharactersService
     */
    private $characterService;

    /**
     * HomeController constructor.
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
        $error       = null;
        $characteres = [];

        try {
            $this->logger->info("Iniciando homepage");
            $this->logger->info("Buscando herois favoritos");

            $characteres = $this->getMyFavoriteHeroes();
            $this->logger->info("Busca por herois favoritos encerrada");
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
        } finally {
            return $this->render('frontend/homepage.html.twig', [
                "error"      => $error,
                "characters" => $characteres
            ]);
        }
    }

    private function getMyFavoriteHeroes()
    {
        $builder = new CharacterBuilder();
        foreach (self::MY_FAVORITE_HEROES as $heroToSearch) {
            $response = $this->characterService->findByNameStartWith($heroToSearch);
            $this->logger->info("Buscando [$heroToSearch]");

            $data = json_decode($response, 1);

            if ($data["data"]['count'] == 0) {
                $this->logger->error("[$heroToSearch] não foi encontrado");
                throw new NotFoundHttpException("[$heroToSearch] not found");
            }
            $character = $builder->build($data["data"]["results"][0]);
            $myFavoriteHeroes[] = $character;
            $this->logger->info("[$heroToSearch] encontrado");
        }
        return $myFavoriteHeroes;
    }
}