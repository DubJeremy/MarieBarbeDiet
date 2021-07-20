<?php

namespace App\Controller;

use App\Entity\RecipePost;
use App\Entity\UserCategory;
use App\Repository\UserRepository;
use App\Repository\RecipePostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{

    /**
     * @Route("/profile", name="app_user_profile")
     */
    public function profile(RecipePostRepository $repositoryRecipePost): Response
    {
        $user = $this->getUser();
        $recipesPosts = $repositoryRecipePost->findByCategory($user->getUserCategory());

        return $this->render('user/profile.html.twig', [
            'user' => $user,
            'recipesPosts' =>$recipesPosts
        ]);
    }
}




