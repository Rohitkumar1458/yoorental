<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 12px; color: #333;">

    <div style="width: 100%; border: 1px solid #ddd; padding: 20px;">

        <!-- Header -->
        <h2 style="margin: 0; text-align: center; color: #444;">INVOICE</h2>
        <hr>

        <!-- Company & Customer -->
        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <td>
                    <strong>Company:</strong><br>
                    <?= $cust_info['company'] ?><br>
                    <?= $cust_info['add'] ?><br>
                    Phone: <?= $cust_info['phone'] ?>
                </td>
                <td style="text-align: right;">
                    <strong>Invoice #:</strong> <?= $cust_info['invoice_no'] ?><br>
                    <strong>Date:</strong> <?= date('d-m-Y') ?>
                </td>
            </tr>
        </table>

        <br>

        <!-- Customer -->
        <div>
            <strong>Bill To:</strong><br>
            <?= $bill_info['billing_name'] ?><br>
            <?= $bill_info['billing_add'] ?><br>
            Phone: <?= $bill_info['billing_phone'] ?>
        </div>

        <br>

        <!-- Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background: #f5f5f5;">Item</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background: #f5f5f5;">Qty</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background: #f5f5f5;">Price</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background: #f5f5f5;">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">Bike Rent</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">2</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">500</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">1000</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">Helmet</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">2</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">100</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">200</td>
                </tr>
            </tbody>
        </table>

        <br>

        <!-- Total -->
        <table style="width: 100%;">
            <tr>
                <td style="text-align: right;">
                    <strong>Subtotal:</strong> 1200<br>
                    <strong>Tax (10%):</strong> 120<br>
                    <strong>Grand Total:</strong> 1320
                </td>
            </tr>
        </table>

        <br>

        <!-- Footer -->
        <div style="text-align: center; font-size: 11px; color: #777;">
            Thank you for your business!
        </div>

    </div>

</body>
</html>