<?php namespace Cribbb\Infrastructure\Repositories;

use Doctrine\ORM\EntityRepository;
use Cribbb\Domain\Users\UserRepository;

class UserDoctrineORMRepository extends EntityRepository implements UserRepository {}
