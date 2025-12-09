<!-- Order Id Field -->
<div class="col-sm-12">
    {!! Form::label('order_id', 'Order Id:') !!}
    <p>{{ $payments->order_id }}</p>
</div>

<!-- Amount Field -->
<div class="col-sm-12">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $payments->amount }}</p>
</div>

<!-- Method Field -->
<div class="col-sm-12">
    {!! Form::label('method', 'Method:') !!}
    <p>{{ $payments->method }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $payments->status }}</p>
</div>

