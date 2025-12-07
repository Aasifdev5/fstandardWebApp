<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DhanService
{
    protected string $baseUrl = 'https://api.dhan.co/v2/';
    protected string $clientId;
    protected string $accessToken;

    public function __construct()
    {
        $this->clientId    = env('DHAN_CLIENT_ID');         // e.g., 1100123456
        $this->accessToken = env('DHAN_ACCESS_TOKEN');      // JWT token from Dhan

        if (!$this->clientId || !$this->accessToken) {
            throw new \Exception('DHAN_CLIENT_ID and DHAN_ACCESS_TOKEN must be set in .env');
        }
    }

    private function headers(): array
    {
        return [
            'access-token'      => $this->accessToken,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ];
    }

    // ====================================================================
    // ORDERS
    // ====================================================================
    public function placeOrder(array $payload)
    {
        $payload['dhanClientId'] = $this->clientId; // REQUIRED in body
        return Http::withHeaders($this->headers())
                   ->post($this->baseUrl . 'orders', $payload);
    }

    public function getOrderStatus(string $orderId)
    {
        return Http::withHeaders($this->headers())
                   ->get($this->baseUrl . 'orders/' . $orderId);
    }

    public function getOrderBook()
    {
        return Http::withHeaders($this->headers())
                   ->get($this->baseUrl . 'orders');
    }

    public function modifyOrder(string $orderId, array $payload)
    {
        $payload['dhanClientId'] = $this->clientId;
        return Http::withHeaders($this->headers())
                   ->put($this->baseUrl . 'orders/' . $orderId, $payload);
    }

    public function cancelOrder(string $orderId)
    {
        return Http::withHeaders($this->headers())
                   ->delete($this->baseUrl . 'orders/' . $orderId);
    }

    // ====================================================================
    // TRADES & POSITIONS
    // ====================================================================
    public function getTradeBook()
    {
        return Http::withHeaders($this->headers())
                   ->get($this->baseUrl . 'trades');
    }

    public function getPositions()
    {
        return Http::withHeaders($this->headers())
                   ->get($this->baseUrl . 'positions');
    }

    public function getHoldings()
    {
        return Http::withHeaders($this->headers())
                   ->get($this->baseUrl . 'holdings');
    }

    // ====================================================================
    // FUND LIMITS
    // ====================================================================
    public function getFundLimits()
    {
        return Http::withHeaders($this->headers())
                   ->get($this->baseUrl . 'fundlimit');
    }

    // ====================================================================
    // Helper
    // ====================================================================
    public function success($response): bool
    {
        return $response->successful() && ($response->json('status') ?? $response->json('orderStatus')) !== 'REJECTED';
    }

    public function handle($response)
    {
        if (!$this->success($response)) {
            Log::error('Dhan API Error', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            return ['success' => false, 'data' => $response->json()];
        }
        return ['success' => true, 'data' => $response->json()];
    }
}
