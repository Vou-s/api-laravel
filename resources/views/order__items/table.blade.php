<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="order_-items-table">
            <thead>
            <tr>
                <th>Order Id</th>
                <th>Product Id</th>
                <th>Quantity</th>
                <th>Price</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderItems as $orderItems)
                <tr>
                    <td>{{ $orderItems->order_id }}</td>
                    <td>{{ $orderItems->product_id }}</td>
                    <td>{{ $orderItems->quantity }}</td>
                    <td>{{ $orderItems->price }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['orderItems.destroy', $orderItems->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('orderItems.show', [$orderItems->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('orderItems.edit', [$orderItems->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $orderItems])
        </div>
    </div>
</div>
