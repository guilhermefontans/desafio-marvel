<?php

namespace App\Controller;

use App\Entity\Builder\CharacterBuilder;
use App\Entity\Builder\ComicBuilder;
use App\Entity\Builder\StorieBuilder;
use App\Entity\Character;
use App\Service\CharactersService;
use App\Service\ComicsService;
use App\Service\StoriesService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CharacterController
 * @package App\Controller
 */
class CharacterController extends AbstractController
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
     * @var ComicsService
     */
    private $comicsService;

    /**
     * @var StoriesService
     */
    private $storiesService;

    /**
     * CharacterController constructor.
     * @param LoggerInterface $logger
     * @param CharactersService $characterService
     * @param ComicsService $comicsService
     * @param StoriesService $storiesService
     */
    public function __construct(
        LoggerInterface $logger,
        CharactersService $characterService,
        ComicsService $comicsService,
        StoriesService $storiesService
    )
    {
        $this->logger           = $logger;
        $this->characterService = $characterService;
        $this->comicsService    = $comicsService;
        $this->storiesService   = $storiesService;
    }

    /**
     * @Route("/character/{id}")
     */
    public function character($id)
    {
        $error       = null;
        $character   = null;
        $comics      = [];
        $stories     = [];

        try {
            $response       = $this->characterService->findById($id);
            $characterData  = json_decode($response, 1);

            $builder    = new CharacterBuilder();
            $character  = $builder->build($characterData['data']['results'][0]);

            $comics = [];
            if ($character->getComics()["available"] > 0) {
                $comics = $this->getComicsFromCharacter($character);
            }

            $stories = [];
            if ($character->getStories()["available"] > 0) {
                $stories = $this->getStoriesFromCharacter($character);
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
        } finally {
            return $this->render('frontend/character.html.twig',[
                "character" => $character,
                "stories"   => $stories,
                "comics"    => $comics,
                "error"     => $error
            ]);
        }
    }

    private function getComicsFromCharacter(Character $character)
    {
        $comics   = [];
        $response = $this->comicsService->findByResourceURI($character->getComics()["collectionURI"]);
        $builder  = new ComicBuilder();

        $comicsData = json_decode($response, 1);
        if ($comicsData["data"]["count"] == 0) {
            $this->logger->error("[$character->getComics()[\"collectionURI\"]] não foi encontrado");
            throw new NotFoundHttpException("[$character->getComics()[\"collectionURI\"]] not found");
        }

        foreach ($comicsData["data"]["results"] as $item) {
            $comic      = $builder->build($item);
            $comics[]   = $comic;
        }
        return $comics;
    }

    private function getStoriesFromCharacter(Character $character)
    {
        $stories    = [];
        $response   = $this->storiesService->findByResourceURI($character->getStories()["collectionURI"]);

        $storiesData    = json_decode($response, 1);
        if ($storiesData["data"]["count"] == 0) {
            $this->logger->error("[$character->getComics()[\"collectionURI\"]] não foi encontrado");
            throw new NotFoundHttpException("[$character->getComics()[\"collectionURI\"]] not found");
        }

        $builder        = new StorieBuilder();
        foreach ($storiesData["data"]["results"] as $item) {
            $storie     = $builder->build($item);
            $stories[]  = $storie;
        }
        return $stories;
    }
}