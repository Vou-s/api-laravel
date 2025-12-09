<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $orders->user_id }}</p>
</div>

<!-- Total Amount Field -->
<div class="col-sm-12">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    <p>{{ $orders->total_amount }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $orders->status }}</p>
</div>

<!-- Payment Method Field -->
<div class="col-sm-12">
    {!! Form::label('payment_method', 'Payment Method:') !!}
    <p>{{ $orders->payment_method }}</p>
</div>

