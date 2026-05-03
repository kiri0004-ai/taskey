<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Retrieve all users.
     *
     * @return User[]
     */
    public function all(): array;

    /**
     * Insert a new user into the database.
     */
    public function insert(User $user): User;

    /**
     * Update an existing user in the database.
     */
    public function update(User $user): User;

    /**
     * Find a user by their ID.
     */
    public function findById(int $id): ?User;

    /**
     * Find a user by their username.
     */
    public function findByUsername(string $username): ?User;

    /**
     * Delete a user from the database.
     */
    public function delete(User $user): bool;
}