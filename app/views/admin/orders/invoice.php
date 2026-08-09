<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #<?= htmlspecialchars($order['order_number']) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body { font-family: sans-serif; background: #fff; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; }
    </style>
</head>
<body onload="window.print()">
    <div class="invoice-box mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-danger fw-bold">Adil's Signature Kitchen</h2>
                <p class="mb-0">Homemade With Love</p>
                <small>Phone: 01303721109 | Dhaka, Bangladesh</small>
            </div>
            <div class="text-end">
                <h4>INVOICE</h4>
                <p class="mb-0"><strong>Invoice #:</strong> <?= htmlspecialchars($order['order_number']) ?></p>
                <small>Date: <?= date('Y-m-d H:i', strtotime($order['created_at'])) ?></small>
            </div>
        </div>

        <hr>

        <div class="row mb-4">
            <div class="col-6">
                <h6>Billed To:</h6>
                <p class="mb-1"><strong><?= htmlspecialchars($order['customer_name']) ?></strong></p>
                <p class="mb-1"><?= htmlspecialchars($order['customer_phone']) ?></p>
                <p class="mb-0"><?= htmlspecialchars($order['shipping_address']) ?></p>
            </div>
            <div class="col-6 text-end">
                <h6>Payment Info:</h6>
                <p class="mb-1"><strong>Method:</strong> <?= strtoupper($order['payment_method']) ?></p>
                <p class="mb-0"><strong>Status:</strong> <?= strtoupper($order['payment_status']) ?></p>
            </div>
        </div>

        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th class="text-end">Price</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                        <td class="text-end">৳<?= number_format($item['price'], 2) ?></td>
                        <td class="text-center"><?= $item['quantity'] ?></td>
                        <td class="text-end">৳<?= number_format($item['total'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="row">
            <div class="col-6">
                <p class="small text-muted">Thank you for your order! Freshly baked with love.</p>
            </div>
            <div class="col-6 text-end">
                <p class="mb-1">Subtotal: ৳<?= number_format($order['subtotal'], 2) ?></p>
                <p class="mb-1">Delivery Charge: ৳<?= number_format($order['delivery_charge'], 2) ?></p>
                <h5 class="text-danger fw-bold mt-2">Total: ৳<?= number_format($order['total_amount'], 2) ?></h5>
            </div>
        </div>
    </div>
</body>
</html>
