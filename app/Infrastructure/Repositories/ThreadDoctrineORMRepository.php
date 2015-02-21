<?php namespace Cribbb\Infrastructure\Repositories;

use Doctrine\ORM\EntityManager;
use Cribbb\Domain\Model\Discussion\Thread;
use Cribbb\Domain\Model\Discussion\ThreadId;
use Cribbb\Domain\Model\Discussion\ThreadRepository;

class ThreadDoctrineORMRepository implements ThreadRepository
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
     * @param EntityManager $em
     * @return void
     */
    public function __construct(EntityManager $em)
    {
        $this->em    = $em;
        $this->class = 'Cribbb\Domain\Model\Discussion\Thread';
    }

    /**
     * Add a new Thread
     *
     * @param Thread $thread
     * @return void
     */
    public function add(Thread $thread)
    {
        $this->em->persist($thread);
        $this->em->flush();
    }

    /**
     * Find a Thread by it's id
     *
     * @param ThreadId $id
     * @return Thread
     */
    public function threadOfId(ThreadId $id)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'id' => $id->toString()
        ]);
    }
}
