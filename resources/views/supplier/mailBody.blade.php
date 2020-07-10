<p>Hi <strong>{{$data['first_name'].' ' .$data['last_name']}} </strong> </p>
<p>It is applogizing email from carty adminstration that your <strong>  order number {{$data['order_id']}} in {{$data['date']}} </strong> </p><br>
<p>Has a problem in product  <strong> {{$data['product_name']}} with {{$data['product_quantity']}} qunatiy</strong></p>
<p> So your order will has been arrived in the exactly time with out this product and we will subtract <strong>{{$data['product_quantity'] * $data['product_price']}} EGP </strong> From Total</p>
<p><strong>Thank You</strong></p>