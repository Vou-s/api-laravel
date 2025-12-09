<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentsRequest;
use App\Http\Requests\UpdatePaymentsRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PaymentsRepository;
use Illuminate\Http\Request;
use Flash;

class PaymentsController extends AppBaseController
{
    /** @var PaymentsRepository $paymentsRepository*/
    private $paymentsRepository;

    public function __construct(PaymentsRepository $paymentsRepo)
    {
        $this->paymentsRepository = $paymentsRepo;
    }

    /**
     * Display a listing of the Payments.
     */
    public function index(Request $request)
    {
        $payments = $this->paymentsRepository->paginate(10);

        return view('payments.index')
            ->with('payments', $payments);
    }

    /**
     * Show the form for creating a new Payments.
     */
    public function create()
    {
        return view('payments.create');
    }

    /**
     * Store a newly created Payments in storage.
     */
    public function store(CreatePaymentsRequest $request)
    {
        $input = $request->all();

        $payments = $this->paymentsRepository->create($input);

        Flash::success('Payments saved successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Display the specified Payments.
     */
    public function show($id)
    {
        $payments = $this->paymentsRepository->find($id);

        if (empty($payments)) {
            Flash::error('Payments not found');

            return redirect(route('payments.index'));
        }

        return view('payments.show')->with('payments', $payments);
    }

    /**
     * Show the form for editing the specified Payments.
     */
    public function edit($id)
    {
        $payments = $this->paymentsRepository->find($id);

        if (empty($payments)) {
            Flash::error('Payments not found');

            return redirect(route('payments.index'));
        }

        return view('payments.edit')->with('payments', $payments);
    }

    /**
     * Update the specified Payments in storage.
     */
    public function update($id, UpdatePaymentsRequest $request)
    {
        $payments = $this->paymentsRepository->find($id);

        if (empty($payments)) {
            Flash::error('Payments not found');

            return redirect(route('payments.index'));
        }

        $payments = $this->paymentsRepository->update($request->all(), $id);

        Flash::success('Payments updated successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Remove the specified Payments from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $payments = $this->paymentsRepository->find($id);

        if (empty($payments)) {
            Flash::error('Payments not found');

            return redirect(route('payments.index'));
        }

        $this->paymentsRepository->delete($id);

        Flash::success('Payments deleted successfully.');

        return redirect(route('payments.index'));
    }
}
