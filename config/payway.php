<?php
// config/payway.php
return [
    'api_url' => env('ABA_PAYWAY_API_URL', 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase'),
    'api_key' => env('ABA_PAYWAY_API_KEY', 'c38e7d8351ef3808c400c7c6695ef974229d2716'),
    'merchant_id' => env('ABA_PAYWAY_MERCHANT_ID', 'ec437991'),
];
