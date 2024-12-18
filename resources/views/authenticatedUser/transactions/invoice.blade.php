<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .invoice-header {
            text-align: center;
        }
        .invoice-details {
            margin-top: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="invoice-header">
        <h2>Transaction Invoice</h2>
        <p>Date: {{ $transactions[0]->created_at->format('d M Y') }}</p>
    </div>

    <div class="invoice-details">
        <h3>Order Details</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->product->nama_bunga }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>Rp {{ number_format($transaction->product->harga, 2) }}</td>
                        <td>Rp {{ number_format($transaction->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Grand Total</th>
                    <td>Rp {{ number_format($transactions->sum('total_price'), 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

</body>
</html>
