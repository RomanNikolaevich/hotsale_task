<?php

namespace App\Controllers;

use App\Config\PathConfig;
use App\Services\UserDataService;
use App\Services\UserRegisterService;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class UserController
{
    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(): void
    {
        $templatePath = PathConfig::getTemplatePath();
        $tokenPath = PathConfig::getTokenPath();

        $userRegister = new UserRegisterService();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!$userRegister->register()) {
                $registrationErrors = $userRegister->getRegistrationError();
            }

            $userRegister->register();
            $registrationSuccess = $userRegister->getRegistrationSuccess();
        }

        $loader = new FilesystemLoader($templatePath);
        $twig = new Environment($loader);

        $users = new UserDataService();

        $csrfTokenManager = new CsrfTokenManager();
        $token = $csrfTokenManager->getToken($tokenPath);

        echo $twig->render('user.twig', [
            'errors' => $registrationErrors ?? '',
            'success' => $registrationSuccess ?? '',
            'users' => $users->getUsers(),
            'csrf_token' => $token->getValue()
        ]);

    }
}