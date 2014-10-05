<?php namespace Cribbb\Infrastructure\Repositories;

use Doctrine\ORM\EntityManager;
use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Identity\UserRepository;

class UserDoctrineORMRepository implements UserRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var string
     */
    private $class;

    /**
     * Create a new UserDoctrineORMRepository
     *
     * @param EntityManager $em
     * @return void
     */
    public function __construct(EntityManager $em)
    {
        $this->em    = $em;
        $this->class = 'Cribbb\Domain\Model\Identity\User';
    }

    /**
     * Return the next identity
     *
     * @return UserId
     */
    public function nextIdentity()
    {
        return UserId::generate();
    }

    /**
     * Add a new User
     *
     * @param User $user
     * @return void
     */
    public function add(User $user)
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    /**
     * Update an existing User
     *
     * @param User $user
     * @return void
     */
    public function update(User $user)
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    /**
     * Find a user by their email address
     *
     * @param Email $email
     * @return User
     */
    public function userOfEmail(Email $email)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'email' => $email->toString()
        ]);
    }

    /**
     * Find a user by their username
     *
     * @param Username $username
     * @return User
     */
    public function userOfUsername(Username $username)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'username' => $username->toString()
        ]);
    }
}
