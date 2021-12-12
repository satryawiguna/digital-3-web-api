<h2><strong>Order Information</strong></h2>
<strong>Name :</strong> {{ $request->name }}<br />
<strong>Place of Stay :</strong> {{ $request->place_of_stay }}<br />
<strong>Phone :</strong> {{ $request->phone }}<br />
<strong>Payment Method :</strong> {{ $request->payment_method }}<br />
<strong>Delivery / Pickup :</strong> {{ $request->delivery_or_pickup }}<br />
<strong>Type of Device :</strong> {{ $request->type_of_device }}<br />
<strong>Additional Note :</strong> {{ $request->additional_note }}<br />

<h2><strong>Order Items</strong></h2>
<ul>
@foreach($request->order as $order)
<li>{{ $order->title }}</li>
@endforeach
</ul>