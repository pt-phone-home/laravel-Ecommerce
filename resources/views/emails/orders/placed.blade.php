<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>
   <p>
       Order ID: {{ $order->id }}
       <br>
       Order Email: {{ $order->billing_email }}
       <br>
       Order Name: {{ $order->billing_name }}
       <br>
       Order Total: {{ round($order->billing_total, 2) }}
   </p>
</body>
</html>
