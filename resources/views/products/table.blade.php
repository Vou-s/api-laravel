<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="products-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category Id</th>
                <th>Subcategory Id</th>
                <th>Stock</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $products)
                <tr>
                    <td>{{ $products->name }}</td>
                    <td>{{ $products->description }}</td>
                    <td>{{ $products->price }}</td>
                    <td>{{ $products->category_id }}</td>
                    <td>{{ $products->subcategory_id }}</td>
                    <td>{{ $products->stock }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['products.destroy', $products->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('products.show', [$products->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', [$products->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $products])
        </div>
    </div>
</div>
