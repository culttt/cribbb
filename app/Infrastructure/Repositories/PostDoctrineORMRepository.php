<?php namespace Cribbb\Infrastructure\Repositories;

use Doctrine\ORM\EntityManager;
use Cribbb\Domain\Model\Discussion\Post;
use Cribbb\Domain\Model\Discussion\PostId;
use Cribbb\Domain\Model\Discussion\PostRepository;

class PostDoctrineORMRepository implements PostRepository
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
        $this->class = 'Cribbb\Domain\Model\Discussion\Post';
    }

    /**
     * Add a new Post
     *
     * @param Post $post
     * @return void
     */
    public function add(Post $post)
    {
        $this->em->persist($post);
        $this->em->flush();
    }

    /**
     * Find a Post by it's id
     *
     * @param PostId $id
     * @return Post
     */
    public function postOfId(PostId $id)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'id' => $id->toString()
        ]);
    }
}
