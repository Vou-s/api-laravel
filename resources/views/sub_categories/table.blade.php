<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="sub-categories-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Category Id</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subCategories as $subCategories)
                <tr>
                    <td>{{ $subCategories->name }}</td>
                    <td>{{ $subCategories->category_id }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['subCategories.destroy', $subCategories->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('subCategories.show', [$subCategories->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('subCategories.edit', [$subCategories->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $subCategories])
        </div>
    </div>
</div>
