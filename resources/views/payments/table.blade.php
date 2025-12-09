<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="payments-table">
            <thead>
            <tr>
                <th>Order Id</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($payments as $payments)
                <tr>
                    <td>{{ $payments->order_id }}</td>
                    <td>{{ $payments->amount }}</td>
                    <td>{{ $payments->method }}</td>
                    <td>{{ $payments->status }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['payments.destroy', $payments->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('payments.show', [$payments->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('payments.edit', [$payments->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $payments])
        </div>
    </div>
</div>
