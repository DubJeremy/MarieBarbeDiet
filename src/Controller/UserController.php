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
     * @Route("/profil/{id}", name="app_user_profil", requirements={"id"="\d+"})
     */
    public function profil(UserRepository $repository ): Response
    {
        $user = $repository->findAll();

        return $this->render('user/profil.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/profil/{id}", name="app_user_profil", requirements={"id"="\d+"})
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
