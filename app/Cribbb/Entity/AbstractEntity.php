<?php Cribbb\Entity;

abstract class AbstractEntity {

  /**
   * Data
   *
   * @var array
   */
  protected $data;

  /**
   * Validator
   *
   * @var Cribbb\Service\Validation\ValidableInterface
   */
  protected $validator;

  /**
   * Repository
   *
   * @var Cribbb\Repository\RepositoryInterface
   */
  protected $repository;

  /**
   * Construct
   *
   * @param Cribbb\Service\Validation\ValidableInterface $validator
   * @param Cribbb\Repository\RepositoryInterface $repository
   */
  public function __construct(ValidableInterface $validator, RepositoryInterface $repository)
  {
    $this->validator = $validator;
    $this->repository = $repository;
  }

  /**
   * Verify if the data passes the on create rules
   *
   * @return boolean
   */
  public function canCreate(array $input)
  {
    return $this->validator->with($input)->canCreate();
  }

  /**
   * Verify if the data passes the on update rules
   *
   * @return boolean
   */
  public function canUpdate(array $input)
  {
    return $this->validator->with($input)->canUpdate();
  }

  /**
   * Create an new entity
   *
   * @return boolean
   */
  public function create(array $input)
  {
    if( ! $this->canCreate($input) )
    {
      return false;
    }

    return $this->repository->create($input);
  }

  /**
   * Update an existing entity
   *
   * @return boolean
   */
  public function update(array $input)
  {
    if( ! $this->canUpdate($input) )
    {
      return false;
    }

    return $this->repository->update($input);
  }

  /**
   * Return any validation errors
   *
   * @return array
   */
  public function errors()
  {
    return $this->validator->errors();
  }

}
