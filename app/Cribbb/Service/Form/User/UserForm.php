<?php namespace Cribbb\Service\Form\User;

use Cribbb\Service\Validation\ValidableInterface;
use Cribbb\Reposiroty\User\UserRepository;

class UserForm {

  /**
   * Form Data
   *
   * @var array
   */
  protected $data;

  /**
   * Validator
   *
   * @var Cribbb\Form\Service\ValidableInterface
   */
  protected $validator;

  /**
   * User repository
   *
   * @var Cribbb\Repository\User\UserRepository
   */
  protected $article;

  /**
   * Construct
   *
   * @param Cribbb\Form\Service\ValidableInterface $validator
   * @param Cribbb\Repository\User\UserRepository $user
   */
  public function __construct(ValidableInterface $validator, UserRepository $user)
  {
    $this->validator = $validator;
    $this->user = $user;
  }

  /**
   * Create an new user
   *
   * @return boolean
   */
  public function save(array $input)
  {
    if( ! $this->valid($input) )
    {
      return false;
    }

    return $this->user->create($input);
  }

  /**
   * Update an existing user
   *
   * @return boolean
   */
  public function update(array $input)
  {
    if( ! $this->valid($input) )
    {
      return false;
    }

    return $this->user->update($input);
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

  /**
   * Test if form validator passes
   *
   * @return boolean
   */
  protected function valid(array $input)
  {
    return $this->validator->with($input)->passes();
  }

}
