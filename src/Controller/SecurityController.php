<?php
namespace App\Controller;

use App\DataTransferObject\Credentials;
use App\Form\LoginType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login") 
     *@param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         
        $form = $this->createForm(LoginType::class, new Credentials($authenticationUtils->getLastUsername()));
        $errors = $authenticationUtils->getLastAuthenticationError();
        if (null !== $errors) {
            $form->addError(
                new FormError($errors->getMessage())
            );
        }
        
        return $this->render('security/login.html.twig',[
            'form' => $form->createView(),
        ]);
    }
    /**
    * @Route("/logout",name="security_logout")
    *
    */
    public function logout()
    {
    }
}

