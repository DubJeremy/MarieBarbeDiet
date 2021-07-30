<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_registration_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            if(empty($_Post['recaptcha-response']))
            {
                return $this->redirectToRoute('app_registration_register');
            }else 
            {
                $url = " https://www.google.com/recaptcha/api/siteverify?secret=6LdQR80bAAAAAOrVDXn9syrA9Pt4d2px3PLxjuhj&response={$_POST['recaptcha-response']}";
                
                if(function_exists('curl_version'))
                {
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_HEADER, false);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_TIMEOUT, 1);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    $response = curl_exec($curl);
                }else
                {
                    $response = file_get_contents($url);
                }
                
                if (empty($response) || is_null($response))
                {
                    return $this->redirectToRoute('app_registration_register');
                }else
                {
                    $data = json_decode($response);
                    if($data->success)
                    {
                        $user->setPassword(
                            $passwordHasher->hashPassword(
                                $user,
                                $form->get('password')->getData()
                                )
                            );
                            $user->setRoles(['ROLE_USER']);
                            
                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->persist($user);
                            $entityManager->flush();
                            $this->addFlash('success', 'Votre compte à bien était créé. Veuillez vous connecter.');
                            return $this->redirectToRoute('app_security_login');
                    }else
                    {
                        return $this->redirectToRoute('app_registration_register');
                    }
                }
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/edit", name="app_edit")
     */
    public function edit(Request $request): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_user_profile');
        }

        return $this->render('security/edit.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);

        return $this->render('common/error.html.twig', [
            'error' => 401,
            'message' => 'Unauthorized access',
            'user' => $user,
        ]);
    }
}
