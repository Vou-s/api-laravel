<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="orders-table">
            <thead>
            <tr>
                <th>User Id</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Payment Method</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $orders)
                <tr>
                    <td>{{ $orders->user_id }}</td>
                    <td>{{ $orders->total_amount }}</td>
                    <td>{{ $orders->status }}</td>
                    <td>{{ $orders->payment_method }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['orders.destroy', $orders->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('orders.show', [$orders->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('orders.edit', [$orders->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $orders])
        </div>
    </div>
</div>
