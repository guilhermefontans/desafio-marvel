<?php


namespace App\Entity\Builder;


use App\Entity\Character;

class CharacterBuilder
{
    private $data;
    /**
     * CharacterBuilder constructor.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return new Character(
            $this->data["id"],
            $this->data["description"],
            $this->data["modified"],
            $this->data["thumbnail"]["path"] . $this->data["thumbnail"]["extension"],
            $this->data["resourceURI"]
        );
    }
}