<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMidtransRequest;
use App\Http\Requests\UpdateMidtransRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\MidtransRepository;
use Illuminate\Http\Request;
use Flash;

class MidtransController extends AppBaseController
{
    /** @var MidtransRepository $midtransRepository*/
    private $midtransRepository;

    public function __construct(MidtransRepository $midtransRepo)
    {
        $this->midtransRepository = $midtransRepo;
    }

    /**
     * Display a listing of the Midtrans.
     */
    public function index(Request $request)
    {
        $midtrans = $this->midtransRepository->paginate(10);

        return view('midtrans.index')
            ->with('midtrans', $midtrans);
    }

    /**
     * Show the form for creating a new Midtrans.
     */
    public function create()
    {
        return view('midtrans.create');
    }

    /**
     * Store a newly created Midtrans in storage.
     */
    public function store(CreateMidtransRequest $request)
    {
        $input = $request->all();

        $midtrans = $this->midtransRepository->create($input);

        Flash::success('Midtrans saved successfully.');

        return redirect(route('midtrans.index'));
    }

    /**
     * Display the specified Midtrans.
     */
    public function show($id)
    {
        $midtrans = $this->midtransRepository->find($id);

        if (empty($midtrans)) {
            Flash::error('Midtrans not found');

            return redirect(route('midtrans.index'));
        }

        return view('midtrans.show')->with('midtrans', $midtrans);
    }

    /**
     * Show the form for editing the specified Midtrans.
     */
    public function edit($id)
    {
        $midtrans = $this->midtransRepository->find($id);

        if (empty($midtrans)) {
            Flash::error('Midtrans not found');

            return redirect(route('midtrans.index'));
        }

        return view('midtrans.edit')->with('midtrans', $midtrans);
    }

    /**
     * Update the specified Midtrans in storage.
     */
    public function update($id, UpdateMidtransRequest $request)
    {
        $midtrans = $this->midtransRepository->find($id);

        if (empty($midtrans)) {
            Flash::error('Midtrans not found');

            return redirect(route('midtrans.index'));
        }

        $midtrans = $this->midtransRepository->update($request->all(), $id);

        Flash::success('Midtrans updated successfully.');

        return redirect(route('midtrans.index'));
    }

    /**
     * Remove the specified Midtrans from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $midtrans = $this->midtransRepository->find($id);

        if (empty($midtrans)) {
            Flash::error('Midtrans not found');

            return redirect(route('midtrans.index'));
        }

        $this->midtransRepository->delete($id);

        Flash::success('Midtrans deleted successfully.');

        return redirect(route('midtrans.index'));
    }
}
