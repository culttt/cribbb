<?php namespace Cribbb\Domain\Model\Discussion;

use Assert\Assertion;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * Create a new Post
     *
     * @param PostId $postId
     * @param string $body
     * @return void
     */
    public function __construct(PostId $postId, $body)
    {
        Assertion::string($body);

        $this->setId($postId);

        $this->body = $body;
    }

    /**
     * Get the Post's id
     *
     * @return PostId
     */
    public function id()
    {
        return PostId::fromString($this->id);
    }

    /**
     * Set the Post's id
     *
     * @param PostId $id
     * @return void
     */
    private function setId(PostId $id)
    {
        $this->id = $id->toString();
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
