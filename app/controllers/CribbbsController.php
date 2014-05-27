<?php

use Cribbb\Repositories\Cribbb\CribbbRepository;

class CribbbsController extends BaseController {

  /**
   * Controller layout
   *
   * @var string
   */
  protected $layout = 'layouts.application';

  /**
   * The Cribbb Repository
   *
   * @var Cribbb\Repositories\Cribbb\CribbbRepository
   */
  protected $cribbbRepository;

  /**
   * Create a new instance of the CribbbController
   *
   * @param Cribbb\Repositories\Cribbb\CribbbRepository $cribbbRepository
   * @return void
   */
  public function __construct(CribbbRepository $cribbbRepository)
  {
    $this->cribbbRepository = $cribbbRepository;
  }

  /**
   * Display the form to create a new Cribbb
   *
   * @return View
   */
  public function create()
  {
    return $this->layout->nest('content', 'cribbbs.create');
  }

  /**
   * Create a new Cribbb
   *
   * @return Redirect
   */
  public function store()
  {
    $cribbb = $this->cribbbRepository->create(Input::all());

    if($cribbb)
    {
      return Redirect::route('cribbbs.show', $cribbb->slug);
    }

    return Redirect::route('cribbbs.create')->withInput()
                                            ->withErrors($this->cribbbRepository->errors());
  }

  /**
   * Display a Cribbb by it's slug
   *
   * @param string $slug
   * @return View
   */
  public function show($slug)
  {
    $cribbb = $this->cribbbRepository->getFirstBy('slug', $slug);

    if($cribbb)
    {
      return $this->layout->nest('content', 'cribbbs.show', compact('cribbb'));
    }

    App::abort(404);
  }

  /**
   * Display the form to edit a Cribbb
   *
   * @param int $id
   * @return View
   */
  public function edit($id)
  {
    $cribbb = $this->cribbbRepository->find($id);

    if($cribbb)
    {
      return $this->layout->nest('content', 'cribbbs.edit', compact('cribbb'));
    }

    App::abort(404);
  }

  /**
   * Update an existing Cribbb
   *
   * @param int $id
   * @return Redirect
   */
  public function update($id)
  {
    $cribbb = $this->cribbbRepository->update(array_merge(['id' => $id], Input::all()));

    if($cribbb)
    {
      return Redirect::route('cribbbs.edit', $id)->with('message', 'The cribbb has been updated!');
    }

    return Redirect::route('cribbbs.edit', $id)->withInput()->withErrors($this->cribbbRepository->errors());
  }

  /**
   * Show the form to delete a Cribbb
   *
   * @param int $id
   * @return View
   */
  public function delete($id)
  {
    $cribbb = $this->cribbbRepository->find($id);

    if($cribbb)
    {
      return $this->layout->nest('content', 'cribbbs.delete', compact('cribbb'));
    }

    App::abort(404);
  }

  /**
   * Destroy a Cribbb from the database
   *
   * @param string $id
   * @return Redirect
   */
  public function destroy($id)
  {
    $this->cribbbRepository->delete($id);

    return Redirect::route('home.index');
  }

}
