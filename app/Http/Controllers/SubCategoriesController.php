<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubCategoriesRequest;
use App\Http\Requests\UpdateSubCategoriesRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SubCategoriesRepository;
use Illuminate\Http\Request;
use Flash;

class SubCategoriesController extends AppBaseController
{
    /** @var SubCategoriesRepository $subCategoriesRepository*/
    private $subCategoriesRepository;

    public function __construct(SubCategoriesRepository $subCategoriesRepo)
    {
        $this->subCategoriesRepository = $subCategoriesRepo;
    }

    /**
     * Display a listing of the SubCategories.
     */
    public function index(Request $request)
    {
        $subCategories = $this->subCategoriesRepository->paginate(10);

        return view('sub_categories.index')
            ->with('subCategories', $subCategories);
    }

    /**
     * Show the form for creating a new SubCategories.
     */
    public function create()
    {
        return view('sub_categories.create');
    }

    /**
     * Store a newly created SubCategories in storage.
     */
    public function store(CreateSubCategoriesRequest $request)
    {
        $input = $request->all();

        $subCategories = $this->subCategoriesRepository->create($input);

        Flash::success('Sub Categories saved successfully.');

        return redirect(route('subCategories.index'));
    }

    /**
     * Display the specified SubCategories.
     */
    public function show($id)
    {
        $subCategories = $this->subCategoriesRepository->find($id);

        if (empty($subCategories)) {
            Flash::error('Sub Categories not found');

            return redirect(route('subCategories.index'));
        }

        return view('sub_categories.show')->with('subCategories', $subCategories);
    }

    /**
     * Show the form for editing the specified SubCategories.
     */
    public function edit($id)
    {
        $subCategories = $this->subCategoriesRepository->find($id);

        if (empty($subCategories)) {
            Flash::error('Sub Categories not found');

            return redirect(route('subCategories.index'));
        }

        return view('sub_categories.edit')->with('subCategories', $subCategories);
    }

    /**
     * Update the specified SubCategories in storage.
     */
    public function update($id, UpdateSubCategoriesRequest $request)
    {
        $subCategories = $this->subCategoriesRepository->find($id);

        if (empty($subCategories)) {
            Flash::error('Sub Categories not found');

            return redirect(route('subCategories.index'));
        }

        $subCategories = $this->subCategoriesRepository->update($request->all(), $id);

        Flash::success('Sub Categories updated successfully.');

        return redirect(route('subCategories.index'));
    }

    /**
     * Remove the specified SubCategories from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $subCategories = $this->subCategoriesRepository->find($id);

        if (empty($subCategories)) {
            Flash::error('Sub Categories not found');

            return redirect(route('subCategories.index'));
        }

        $this->subCategoriesRepository->delete($id);

        Flash::success('Sub Categories deleted successfully.');

        return redirect(route('subCategories.index'));
    }
}
