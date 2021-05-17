<?php

namespace App\Controller;


use App\Entity\Recipes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;

class RecipesController extends AbstractController

{
    /**
     * @Route("/recipes/add", name="add_new_recipe", methods={"GET","POST"})
     */
    public  function addRecipe (Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data=json_decode($request->getContent(), true);
        $newRecipe = new Recipes();
        $newRecipe->setName($data["name"]);
        //$newRecipe->setName(name:'omelett');
        $newRecipe->setRecipeCategory($data["recipeCategory"]);
        //$newRecipe->setRecipeCategory("leivonnanine");
        $newRecipe->setNiceToKnow($data["niceToKnow"]);
        //$newRecipe->setNiceToKnow("Taata");
        $newRecipe->setRecipeIngredient($data["recipeIngredient"]);
        //$newRecipe->setRecipeIngredient(["egg"]);
        $newRecipe->setRecipeInstructions($data["recipeInstructions"]);
        //$newRecipe->setRecipeInstructions("sotke");
        $entityManager->persist($newRecipe);
        $entityManager->flush();
        return new Response('Trying to add new recipe...' . $newRecipe->getId());

    }

    /**
     * @Route("/recipes/all", name="get_all_recipe", methods={"GET"})
     */
    public function getAllRecipe()
    {
        $recipes = $this->getDoctrine()->getRepository(Recipes::class)->findAll();
        $response = [];
        foreach ($recipes as $recipe) {
            $response[] = array(
                'id' => $recipe->getId(),
                'name' => $recipe->getName(),
                'recipeCategory' => $recipe->getRecipeCategory(),
                'niceToKnow' => $recipe->getNiceToKnow(),
                'recipeIngredient' => $recipe->getRecipeIngredient(),
                'recipeInstructions' => $recipe->getRecipeInstructions()
            );
        }
        return $this->json($response);
    }

    /**
     * @Route("/recipes/find/{id}", name="find_a_recipe")
     */

    public function findRecipe($id) {
        $recipes = $this->getDoctrine()->getRepository(Recipes::class)->find($id);

        $response = [];

        if (!$recipes) {
            throw $this->createNotFoundException(
                'No recipe was found with the id: ' . $id
            );
        } else {
            return $this->json(
                $response[] = array(
                'id' => $recipes->getId(),
                'name' => $recipes->getName(),
                'recipeCategory' => $recipes->getRecipeCategory(),
                'niceToKnow' => $recipes->getNiceToKnow(),
                'recipeIngredient' => $recipes->getRecipeIngredient(),
                'recipeInstructions' => $recipes->getRecipeInstructions()
                )
            );
        }
    }

    /**
     * @Route("/recipes/remove/{id}", name="remove_a_recipe" methods={"GET","POST"})
     */
    public function removeRecipe($id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);
        if (!$recipe) {
            throw $this->createNotFoundException(
                'No recipe found with this id' . $id
            );
        } else {
            $entityManager->remove($recipe);
            $entityManager->flush();
            return $this->json([
                'message' => 'Removed recipe with id ' . $id
            ]);
        }
    }


}
