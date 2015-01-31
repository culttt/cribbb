<?php namespace Cribbb\Domain\Model\Identity;

use Assert\Assertion;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="settings")
 */
class Setting 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Cribbb\Domain\Model\Identity\User", inversedBy="settings")
     */
    private $user;

    /**
     * @ORM\Column(type="string")
     */
    private $key;

    /**
     * Create a new Setting
     * 
     * @param NotificationId $id
     * @param User $user
     * @param string $key
     * @return void
     */
    public function __construct(SettingId $id, User $user, $key)
    {
        Assertion::string($key);

        $this->setId($id);
        $this->setUser($user);
        $this->setKey($key);
    }

    /**
     * Get the id
     *
     * @return SettingId
     */
    public function id()
    {
        return SettingId::fromString($this->id);
    }

    /**
     * Set the id
     *
     * @param SettingId $id
     * @return void
     */
    private function setId(SettingId $id)
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
     * Get the key
     *
     * @return string
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Set the key
     *
     * @param string $key
     * @return void
     */
    private function setKey($key)
    {
        $this->key = $key;
    }
}
