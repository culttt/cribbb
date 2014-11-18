<?php namespace Cribbb\Domain\Model\Discussion;

use Cribbb\Domain\AggregateRoot;
use Cribbb\Domain\RecordsEvents;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="threads")
 */
class Thread implements AggregateRoot
{
    use RecordsEvents;

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * Create a new Thread
     *
     * @param ThreadId $threadId
     * @return void
     */
    public function __construct(ThreadId $threadId)
    {
        $this->setId($threadId);
    }

    /**
     * Get the Thread's id
     *
     * @return ThreadId
     */
    public function id()
    {
        return ThreadId::fromString($this->id);
    }

    /**
     * Set the Thread's id
     *
     * @param ThreadId $id
     * @return void
     */
    private function setId(ThreadId $id)
    {
        $this->id = $id->toString();
    }
}
