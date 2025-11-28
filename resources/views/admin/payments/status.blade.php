<!-- resources/views/payment/status.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Payment Status</title>
</head>
<body>
    <h1>Payment Status</h1>
    <p>Payment ID: {{ $payment->id }}</p>
    <p>Status: {{ $payment->status }}</p>
    <p>Amount: {{ $payment->amount }}</p>
</body>
</html>
