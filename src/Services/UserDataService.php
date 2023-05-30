<?php

namespace App\Services;

use App\Config\PathConfig;
use App\Services\DTO\UserDTO;

class UserDataService
{
    public function __construct()
    {
        $this->createDataBaseFile();
    }

    /**
     * Checking if the email address is registered. If a user with such an email address is not found, add a new user
     * to a json file
     * @param UserDTO $userDTO
     * @return void
     */
    public function addingUserToArray(UserDTO $userDTO): void
    {
        $user = [
            'id' => uniqid(),
            'name' => $userDTO->getName(),
            'surname' => $userDTO->getSurname(),
            'email' => $userDTO->getEmail(),
            'password' => password_hash($userDTO->getPassword(), PASSWORD_DEFAULT),
        ];

        $this->saveUserToJson($user);
    }

    /**
     * Getting data about registered users as an array for public use
     * @return array
     */
    public function getUsers(): array
    {
        return $this->loadUsersFromJsonToArray();
    }

    /**
     * Getting current data about registered users from JSON file
     * @return array
     */
    public function loadUsersFromJsonToArray(): array
    {
        $dataBaseFilePath = PathConfig::getDatabaseFilePath();

        if (file_exists($dataBaseFilePath)) {
            $json = file_get_contents($dataBaseFilePath);
            return json_decode($json, true) ?: [];
        }

        return [];
    }

    /**
     * Adding a newline after each user, converting the combined data and save to JSON
     * @param array $users
     * @return void
     */
    private function saveUserToJson(array $user): void
    {
        $existingUsers = $this->loadUsersFromJsonToArray();
        $existingUsers[] = $user;
        $json = json_encode($existingUsers, JSON_PRETTY_PRINT);
        $dataBaseFilePath = PathConfig::getDatabaseFilePath();
        file_put_contents($dataBaseFilePath, $json);

    }

    /**
     * @return void
     */
    private function createDataBaseFile(): void
    {
        $dataBaseFilePath = PathConfig::getDatabaseFilePath();

        if (!file_exists($dataBaseFilePath)) {
            file_put_contents($dataBaseFilePath, '');
        }
    }

}
