<?php

namespace App\Services;

use App\Services\DTO\UserDTO;

class UserRegisterService
{
    private array $registrationError = [];
    private string $registrationSuccess = '';


    /**
     * @return bool
     */
    public function register(): bool
    {
        $userDTO = new UserDTO(
            $_POST['name'],
            $_POST['surname'],
            $_POST['email'],
            $_POST['password'],
            $_POST['confirm_password']
        );

        $userValidation = new UserValidationService();

        $errors = $userValidation->validateUser($userDTO);

        if (!empty($errors)) {
            $this->registrationError = $errors;
            return false;
        }

        (new UserDataService())->addingUserToArray($userDTO);
        (new LoggerService())->logSuccess($userDTO->getEmail());
        $this->registrationSuccess = 'Registration successful!';

        return true;

    }

    /**
     * @return array
     */
    public function getRegistrationError(): array
    {
        return $this->registrationError;
    }

    /**
     * @return string
     */
    public
    function getRegistrationSuccess(): string
    {
        return $this->registrationSuccess;
    }
}
