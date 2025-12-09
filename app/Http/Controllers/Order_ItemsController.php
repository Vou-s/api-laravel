<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrder_ItemsRequest;
use App\Http\Requests\UpdateOrder_ItemsRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Order_ItemsRepository;
use Illuminate\Http\Request;
use Flash;

class Order_ItemsController extends AppBaseController
{
    /** @var Order_ItemsRepository $orderItemsRepository*/
    private $orderItemsRepository;

    public function __construct(Order_ItemsRepository $orderItemsRepo)
    {
        $this->orderItemsRepository = $orderItemsRepo;
    }

    /**
     * Display a listing of the Order_Items.
     */
    public function index(Request $request)
    {
        $orderItems = $this->orderItemsRepository->paginate(10);

        return view('order__items.index')
            ->with('orderItems', $orderItems);
    }

    /**
     * Show the form for creating a new Order_Items.
     */
    public function create()
    {
        return view('order__items.create');
    }

    /**
     * Store a newly created Order_Items in storage.
     */
    public function store(CreateOrder_ItemsRequest $request)
    {
        $input = $request->all();

        $orderItems = $this->orderItemsRepository->create($input);

        Flash::success('Order  Items saved successfully.');

        return redirect(route('orderItems.index'));
    }

    /**
     * Display the specified Order_Items.
     */
    public function show($id)
    {
        $orderItems = $this->orderItemsRepository->find($id);

        if (empty($orderItems)) {
            Flash::error('Order  Items not found');

            return redirect(route('orderItems.index'));
        }

        return view('order__items.show')->with('orderItems', $orderItems);
    }

    /**
     * Show the form for editing the specified Order_Items.
     */
    public function edit($id)
    {
        $orderItems = $this->orderItemsRepository->find($id);

        if (empty($orderItems)) {
            Flash::error('Order  Items not found');

            return redirect(route('orderItems.index'));
        }

        return view('order__items.edit')->with('orderItems', $orderItems);
    }

    /**
     * Update the specified Order_Items in storage.
     */
    public function update($id, UpdateOrder_ItemsRequest $request)
    {
        $orderItems = $this->orderItemsRepository->find($id);

        if (empty($orderItems)) {
            Flash::error('Order  Items not found');

            return redirect(route('orderItems.index'));
        }

        $orderItems = $this->orderItemsRepository->update($request->all(), $id);

        Flash::success('Order  Items updated successfully.');

        return redirect(route('orderItems.index'));
    }

    /**
     * Remove the specified Order_Items from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $orderItems = $this->orderItemsRepository->find($id);

        if (empty($orderItems)) {
            Flash::error('Order  Items not found');

            return redirect(route('orderItems.index'));
        }

        $this->orderItemsRepository->delete($id);

        Flash::success('Order  Items deleted successfully.');

        return redirect(route('orderItems.index'));
    }
}
