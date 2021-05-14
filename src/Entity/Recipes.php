<?php

namespace App\Entity;

use App\Repository\RecipesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipesRepository::class)
 */
class Recipes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $recipeCategory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $niceToKnow;

    /**
     * @ORM\Column(type="array")
     */
    private $recipeIngredient = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $recipeInstructions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRecipeCategory(): ?string
    {
        return $this->recipeCategory;
    }

    public function setRecipeCategory(string $recipeCategory): self
    {
        $this->recipeCategory = $recipeCategory;

        return $this;
    }

    public function getNiceToKnow(): ?string
    {
        return $this->niceToKnow;
    }

    public function setNiceToKnow(?string $niceToKnow): self
    {
        $this->niceToKnow = $niceToKnow;

        return $this;
    }

    public function getRecipeIngredient(): ?array
    {
        return $this->recipeIngredient;
    }

    public function setRecipeIngredient(array $recipeIngredient): self
    {
        $this->recipeIngredient = $recipeIngredient;

        return $this;
    }

    public function getRecipeInstructions(): ?string
    {
        return $this->recipeInstructions;
    }

    public function setRecipeInstructions(string $recipeInstructions): self
    {
        $this->recipeInstructions = $recipeInstructions;

        return $this;
    }
}
