<?php namespace Cribbb\Domain\Model\Identity;

use Cribbb\Domain\RecordsEvents;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="notifications")
 */
class Notification 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Cribbb\Domain\Model\Identity\User", inversedBy="notifications")
     */
    private $user;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * Create a new Notification
     * 
     * @param NotificationId $id
     * @param User $user
     * @param string $body
     * @return void
     */
    public function __construct(NotificationId $id, User $user, $body)
    {
        $this->setId($id);
        $this->setUser($user);
        $this->setBody($body);
    }

    /**
     * Get the Notification id
     *
     * @return NotificationId
     */
    public function id()
    {
        return NotificationId::fromString($this->id);
    }

    /**
     * Set the Notification id
     *
     * @param NotificationId $id
     * @return void
     */
    private function setId(NotificationId $id)
    {
        $this->id = $id->toString();
    }

    /**
     * Get the User
     *
     * @return User
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * Set the User
     *
     * @param User $user
     * @return void
     */
    private function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the body
     *
     * @return string
     */
    public function body()
    {
        return $this->body;
    }

    /**
     * Set the body
     *
     * @param string $body
     * @return void
     */
    private function setBody($body)
    {
        $this->body = $body;
    }
}
