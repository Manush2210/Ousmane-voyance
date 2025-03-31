<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmation de commande</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; }
        .header { background-color: #c41c1c; color: white; padding: 15px; text-align: center; }
        .content { padding: 20px; }
        .footer { text-align: center; padding: 15px; font-size: 12px; color: #777; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .total-row { font-weight: bold; background-color: #f9f9f9; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Confirmation de commande</h1>
        </div>
        <div class="content">
            <p>Bonjour {{ $order->billing_first_name }},</p>

            <p>Nous avons bien reçu votre commande #{{ $order->order_number }}.</p>

            <table>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ number_format($item->price * $item->quantity, 2, ',', ' ') }}€</td>
                    </tr>
                    @endforeach
                    <tr class="total-row">
                        <td>Total</td>
                        <td>{{ number_format($order->total, 2, ',', ' ') }}€</td>
                    </tr>
                </tbody>
            </table>

            <p>Méthode de paiement: Virement bancaire</p>

            <p>Pour toute question: <a href="mailto:support@voyanceetbienveillance.com">support@voyanceetbienveillance.com</a></p>

            <p>Merci de votre confiance!</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Voyance Seb</p>
        </div>
    </div>
</body>
</html>
