<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="midtrans-table">
            <thead>
            <tr>
                
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($midtrans as $midtrans)
                <tr>
                    
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['midtrans.destroy', $midtrans->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('midtrans.show', [$midtrans->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('midtrans.edit', [$midtrans->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $midtrans])
        </div>
    </div>
</div>
