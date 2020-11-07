<?php

namespace App\Security\Guard;

use App\DataTransferObject\Credentials;
use App\Form\LoginType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;


class WebAuthenticator extends AbstractFormLoginAuthenticator
{

    /**
     * @var UrlGeneratorInterface
     */
    private UrlGeneratorInterface $urlGenerator;

    /**
     * @var FormFactory
     */
    private FormFactoryInterface $formFactory;

    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $userPasswordEncoder;

    /**
     * Undocumented function
     *
     * @param UrlGeneratorInterface $urlGenerator
     * @param FormFactoryInterface $formFactory
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UrlGeneratorInterface $urlGenerator, FormFactoryInterface $formFactory, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->urlGenerator = $urlGenerator;
        $this->formFactory = $formFactory;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate('security_login');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function supports(Request $request)
    {

        return $request->isMethod(Request::METHOD_POST) 
        && $request->attributes->get("_route") === "security_login";
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function getCredentials(Request $request)
    {
        $credentials = new Credentials();
        $form = $this->formFactory->create(LoginType::class, $credentials)->handleRequest($request);
        
        if ($form->isValid()) {
            
            return;
        }
        return $credentials;
    }

    /**
     * Undocumented function
     *
     * @param Credentials $credentials
     * @param UserProviderInterface $userProvider
     * @return void
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials->getUsername());
    }

    /**
     * Undocumented function
     *
     * @param [type] $credentials
     * @param UserInterface $user
     * @return void
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        if ($valid = $this->userPasswordEncoder->isPasswordValid($user, $credentials->getPassword())) {
            return true;
        }
        throw new AuthenticationException('Password not valid');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     * @return void
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        return new RedirectResponse($this->urlGenerator->generate('index'));
    }
}
