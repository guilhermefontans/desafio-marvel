<?php

namespace App\Controller\Api;

use App\Service\CharactersService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CharacterController
 * @Route("/api/character")
 * @package App\Controller\Api
 */
class CharacterController
{

    /**
     * @var CharactersService
     */
    private $characterService;


    /**
     * CharacterController constructor.
     * @param CharactersService $characterService
     */
    public function __construct(CharactersService $characterService)
    {
        $this->characterService = $characterService;
    }

    /**
     * @Route("/startname/", name="find_hero")
     */
    public function findByName(Request $request)
    {
        $justNames = [];
        $error     = null;

        try {
            $heroToSearch = $request->get("name");
            $response = $this->characterService->findByNameStartWith($heroToSearch);

            $heroes = json_decode($response,true);

            if ($heroes["data"]["total"] > 0) {
                $justNames = array_map(function($hero) {
                    $heroMapped["name"] = $hero["name"];
                    $heroMapped["id"]   = $hero["id"];
                    return $heroMapped;
                },$heroes["data"]["results"]);
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
        } finally {
            return new JsonResponse([
                "heroes" => $justNames,
                "error"  =>$error
            ]);
        }
    }
}