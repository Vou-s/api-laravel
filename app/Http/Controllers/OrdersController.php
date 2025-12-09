<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\OrdersRepository;
use Illuminate\Http\Request;
use Flash;

class OrdersController extends AppBaseController
{
    /** @var OrdersRepository $ordersRepository*/
    private $ordersRepository;

    public function __construct(OrdersRepository $ordersRepo)
    {
        $this->ordersRepository = $ordersRepo;
    }

    /**
     * Display a listing of the Orders.
     */
    public function index(Request $request)
    {
        $orders = $this->ordersRepository->paginate(10);

        return view('orders.index')
            ->with('orders', $orders);
    }

    /**
     * Show the form for creating a new Orders.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created Orders in storage.
     */
    public function store(CreateOrdersRequest $request)
    {
        $input = $request->all();

        $orders = $this->ordersRepository->create($input);

        Flash::success('Orders saved successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified Orders.
     */
    public function show($id)
    {
        $orders = $this->ordersRepository->find($id);

        if (empty($orders)) {
            Flash::error('Orders not found');

            return redirect(route('orders.index'));
        }

        return view('orders.show')->with('orders', $orders);
    }

    /**
     * Show the form for editing the specified Orders.
     */
    public function edit($id)
    {
        $orders = $this->ordersRepository->find($id);

        if (empty($orders)) {
            Flash::error('Orders not found');

            return redirect(route('orders.index'));
        }

        return view('orders.edit')->with('orders', $orders);
    }

    /**
     * Update the specified Orders in storage.
     */
    public function update($id, UpdateOrdersRequest $request)
    {
        $orders = $this->ordersRepository->find($id);

        if (empty($orders)) {
            Flash::error('Orders not found');

            return redirect(route('orders.index'));
        }

        $orders = $this->ordersRepository->update($request->all(), $id);

        Flash::success('Orders updated successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified Orders from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $orders = $this->ordersRepository->find($id);

        if (empty($orders)) {
            Flash::error('Orders not found');

            return redirect(route('orders.index'));
        }

        $this->ordersRepository->delete($id);

        Flash::success('Orders deleted successfully.');

        return redirect(route('orders.index'));
    }
}
