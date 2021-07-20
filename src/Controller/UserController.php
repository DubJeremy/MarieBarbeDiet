<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\UserCategory;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{

    /**
     * @Route("/profile", name="app_user_profile")
     */
    public function profile(RecipeRepository $repositoryRecipe): Response
    {
        $user = $this->getUser();
        $recipes = $repositoryRecipe->findByCategory($user->getUserCategory());

        return $this->render('user/profile.html.twig', [
            'user' => $user,
            'recipes' =>$recipes
        ]);
    }
}



    // /**
    //  * @Route("/profile/{id}", name="app_user_profile", requirements={"id"="\d+"})
    //  *
    //  * @param mixed $id
    //  */
    // public function findCategorieId(UserCategoryRepository $categoryRepository, $id, UserRepository $userRepository, RecipeRepository $recipeRepository): Response
    // {
    //     $user = $userRepository->find($id);
    //     $category = $user->getUserCategory();
    //     // $recipes = $category->getRecipe();
    //     $recipes = $recipeRepository->find($category);
    //     dd($recipes);

    //     return $this->render('user/profile.html.twig', [
    //         'recipes' => $recipes,
                
    //     ]);
    // }

    

    // /**
    //  * @Route("/profile/{id}", name="app_user_profile", requirements={"id"="\d+"})
    //  *
    //  * @param mixed $id
    //  */
    // public function recipe(UserCategoryRepository $categoryRepository, RecipeRepository $recipeRepository, $id, UserRepository $userRepository): Response
    // {
    //     $user = $userRepository->findAll();
    //     $userCategory = $user->find('User.userCategory');
    //     $recipes = $recipeRepository->findByAll($userCategory);

    //     // $category = $categoryRepository->find($id);

    //     return $this->render('user/profil.html.twig', [
    //         'recipes' =>$userCategory->getRecipe(),
    //     ]);
    // }


