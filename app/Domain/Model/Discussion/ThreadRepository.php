<?php namespace Cribbb\Domain\Model\Discussion;

interface ThreadRepository
{
    /**
     * Find a thread by its id
     *
     * @param ThreadId $id
     * @return Thread
     */
    public function threadOfId(ThreadId $id);

    /**
     * Add a new Thread
     *
     * @param Thread $thread
     * @return void
     */
    public function add(Thread $thread);
}