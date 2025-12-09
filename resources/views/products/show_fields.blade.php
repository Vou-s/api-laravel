<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $products->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $products->description }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $products->price }}</p>
</div>

<!-- Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('category_id', 'Category Id:') !!}
    <p>{{ $products->category_id }}</p>
</div>

<!-- Subcategory Id Field -->
<div class="col-sm-12">
    {!! Form::label('subcategory_id', 'Subcategory Id:') !!}
    <p>{{ $products->subcategory_id }}</p>
</div>

<!-- Stock Field -->
<div class="col-sm-12">
    {!! Form::label('stock', 'Stock:') !!}
    <p>{{ $products->stock }}</p>
</div>

