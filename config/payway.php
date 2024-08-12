<?php
// config/payway.php
return [
    'api_url' => env('ABA_PAYWAY_API_URL', 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase'),
    'api_key' => env('ABA_PAYWAY_API_KEY', 'dfdb80b7c2adf6ad2f51e03e0ac29cee440d55e8'),
    'merchant_id' => env('ABA_PAYWAY_MERCHANT_ID', 'ec437721'),
];
