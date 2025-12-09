<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuthsRequest;
use App\Http\Requests\UpdateAuthsRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AuthsRepository;
use Illuminate\Http\Request;
use Flash;

class AuthsController extends AppBaseController
{
    /** @var AuthsRepository $authsRepository*/
    private $authsRepository;

    public function __construct(AuthsRepository $authsRepo)
    {
        $this->authsRepository = $authsRepo;
    }

    /**
     * Display a listing of the Auths.
     */
    public function index(Request $request)
    {
        $auths = $this->authsRepository->paginate(10);

        return view('auths.index')
            ->with('auths', $auths);
    }

    /**
     * Show the form for creating a new Auths.
     */
    public function create()
    {
        return view('auths.create');
    }

    /**
     * Store a newly created Auths in storage.
     */
    public function store(CreateAuthsRequest $request)
    {
        $input = $request->all();

        $auths = $this->authsRepository->create($input);

        Flash::success('Auths saved successfully.');

        return redirect(route('auths.index'));
    }

    /**
     * Display the specified Auths.
     */
    public function show($id)
    {
        $auths = $this->authsRepository->find($id);

        if (empty($auths)) {
            Flash::error('Auths not found');

            return redirect(route('auths.index'));
        }

        return view('auths.show')->with('auths', $auths);
    }

    /**
     * Show the form for editing the specified Auths.
     */
    public function edit($id)
    {
        $auths = $this->authsRepository->find($id);

        if (empty($auths)) {
            Flash::error('Auths not found');

            return redirect(route('auths.index'));
        }

        return view('auths.edit')->with('auths', $auths);
    }

    /**
     * Update the specified Auths in storage.
     */
    public function update($id, UpdateAuthsRequest $request)
    {
        $auths = $this->authsRepository->find($id);

        if (empty($auths)) {
            Flash::error('Auths not found');

            return redirect(route('auths.index'));
        }

        $auths = $this->authsRepository->update($request->all(), $id);

        Flash::success('Auths updated successfully.');

        return redirect(route('auths.index'));
    }

    /**
     * Remove the specified Auths from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $auths = $this->authsRepository->find($id);

        if (empty($auths)) {
            Flash::error('Auths not found');

            return redirect(route('auths.index'));
        }

        $this->authsRepository->delete($id);

        Flash::success('Auths deleted successfully.');

        return redirect(route('auths.index'));
    }
}
