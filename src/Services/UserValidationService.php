<?php

namespace App\Services;

use App\Services\DTO\UserDTO;

class UserValidationService
{
    /**
     * @param UserDTO $userDTO
     * @return array
     */
    public function validateUser(UserDTO $userDTO): array
    {
        $errors = [];

        $email = $userDTO->getEmail();

        if ($this->checkEmail($email)) {
            $errors[] = 'A user with this email address is already registered';
        }

        if (!ctype_alpha($userDTO->getName()) || !ctype_alpha($userDTO->getSurname())) {
            $errors[] = 'Name and surname should only contain letters';
        }

        if (!filter_var($userDTO->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }

        if ($userDTO->getPassword() !== $userDTO->getConfirmPassword()) {
            $errors[] = 'Passwords do not match';
        }

        return $errors;
    }

    /**
     * Checking if the email address was registered.
     * @param string $email
     * @return bool
     */
    private function checkEmail(string $email): bool
    {
        $users = (new UserDataService())->loadUsersFromJsonToArray();

        foreach ($users as $user) {
            if ($user['email'] === $email) {
                return true;
            }
        }

        return false;
    }

}
