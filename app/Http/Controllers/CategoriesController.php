<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CategoriesRepository;
use Illuminate\Http\Request;
use Flash;

class CategoriesController extends AppBaseController
{
    /** @var CategoriesRepository $categoriesRepository*/
    private $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepo)
    {
        $this->categoriesRepository = $categoriesRepo;
    }

    /**
     * Display a listing of the Categories.
     */
    public function index(Request $request)
    {
        $categories = $this->categoriesRepository->paginate(10);

        return view('categories.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new Categories.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created Categories in storage.
     */
    public function store(CreateCategoriesRequest $request)
    {
        $input = $request->all();

        $categories = $this->categoriesRepository->create($input);

        Flash::success('Categories saved successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified Categories.
     */
    public function show($id)
    {
        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified Categories.
     */
    public function edit($id)
    {
        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('categories.index'));
        }

        return view('categories.edit')->with('categories', $categories);
    }

    /**
     * Update the specified Categories in storage.
     */
    public function update($id, UpdateCategoriesRequest $request)
    {
        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('categories.index'));
        }

        $categories = $this->categoriesRepository->update($request->all(), $id);

        Flash::success('Categories updated successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified Categories from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $categories = $this->categoriesRepository->find($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('categories.index'));
        }

        $this->categoriesRepository->delete($id);

        Flash::success('Categories deleted successfully.');

        return redirect(route('categories.index'));
    }
}
