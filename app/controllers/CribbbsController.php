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
   * Display a Cribbb
   *
   * @return View
   */
  public function show($slug)
  {
    dd($slug);
  }


}
