<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{

    /**
     * @Route("/profile/{id}", name="app_user_profile", requirements={"id"="\d+"})
     */
    public function profile(UserRepository $repository ): Response
    {
        $user = $repository->findAll();

        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/profile/{id}", name="app_user_profil", requirements={"id"="\d+"})
     */
    public function postRecipe(PostRepository $repositoryPost, RecipeRepository $repositoryRecipe ): Response
    {
        $posts = $repositoryPost->findAll();
        $recipes = $repositoryRecipe->findAll();

        return $this->render('user/profil.html.twig', [
            'posts' => $posts , 'recipes' => $recipes,
        ]);
    }
}
