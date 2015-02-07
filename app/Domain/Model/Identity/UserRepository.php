<?php namespace Cribbb\Domain\Model\Identity;

interface UserRepository
{
    /**
     * Return the next identity
     *
     * @return UserId
     */
    public function nextIdentity();

    /**
     * Add a new User
     *
     * @param User $user
     * @return void
     */
    public function add(User $user);

    /**
     * Update an existing User
     *
     * @param User $user
     * @return void
     */
    public function update(User $user);

    /**
     * Find a user by their id
     *
     * @param UserId $id
     * @return User
     */
    public function userOfId(UserId $id);

    /**
     * Find a user by their email address
     *
     * @param Email $email
     * @return User
     */
    public function userOfEmail(Email $email);

    /**
     * Find a user by their username
     *
     * @param Username $username
     * @return User
     */
    public function userOfUsername(Username $username);
}
