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
        $response = $this->characterService->findAll();
        $data = json_decode($response->getContent(), 1);

        $characteres = [];
        foreach ($data['data']['results'] as $character) {
            $builder = new CharacterBuilder($character);
            $characteres[] = $builder->build();
        }

        return $this->render('frontend/homepage.html.twig', [
            "characters" => $characteres
        ]);
    }

    /**
     * @Route("/character/{id}")
     */
    public function character($id)
    {
        $response = $this->characterService->findById($id);
        $characterData = json_decode($response->getContent(), 1);

        $builder = new CharacterBuilder($characterData['data']['results'][0]);
        $character = $builder->build();

        return $this->render('frontend/character.html.twig',[
            "character" => $character
        ]);
    }
}