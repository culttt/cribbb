<?php namespace Cribbb\Entity\User;

use Cribbb\Entity\AbstractEntity;
use Cribbb\Entity\EntityInterface;
use Cribbb\Repository\User\UserRepository;
use Cribbb\Service\Validation\Laravel\User\UserCreateValidator;
use Cribbb\Service\Validation\Laravel\User\UserUpdateValidator;

class UserEntity extends AbstractEntity implements EntityInterface {

  /**
   * @var Cribbb\Repository\User\UserRepository
   */
  protected $repository;

  /**
   * @var Cribbb\Service\Validation\Laravel\UserCreateValidator
   */
  protected $createValidator;

  /**
   * @var Cribbb\Service\Validation\Laravel\UserUpdateValidator
   */
  protected $updateValidator;

  /**
   * @var Illuminate\Support\MessageBag
   */
  protected $errors;

  /**
   * Construct
   *
   * @param Cribbb\Repository\User\UserRepository $repository
   * @param Cribbb\Service\Validation\Laravel\UserCreateValidator $createValidator
   * @param Cribbb\Service\Validation\Laravel\UserUpdateValidator $updateValidator
   */
  public function __construct(UserRepository $repository, UserCreateValidator $createValidator, UserUpdateValidator $updateValidator)
  {
    $this->repository = $repository;
    $this->createValidator = $createValidator;
    $this->updateValidator = $updateValidator;
  }

  /**
   * Cribbbs
   *
   * @param int $id
   * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function cribbbs($id)
  {
    return $this->repository->cribbbs($id);
  }

  /**
   * Feed
   *
   * @param int $id
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function feed($id)
  {
    return $this->repository($id);
  }

}
