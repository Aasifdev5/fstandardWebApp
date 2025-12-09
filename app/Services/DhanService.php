<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DhanService
{
    protected string $baseUrl;
    protected string $clientId;
    protected string $accessToken;

    public function __construct()
    {
        $this->clientId     = env('DHAN_CLIENT_ID');
        $this->accessToken  = env('DHAN_ACCESS_TOKEN');
        $this->baseUrl      = rtrim(env('DHAN_BASE_URL', 'https://api.dhan.co/v2'), '/') . '/';

        if (!$this->clientId || !$this->accessToken) {
            throw new \Exception('Missing DHAN_CLIENT_ID or DHAN_ACCESS_TOKEN in .env');
        }
    }

    private function headers(): array
    {
        return [
            'client-id'    => $this->clientId,
            'access-token' => $this->accessToken,
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ];
    }

    // -------------------------------
    // ORDER API
    // -------------------------------
    public function placeOrder(array $payload)
    {
        $payload['dhanClientId'] = $this->clientId;

        $response = Http::withHeaders($this->headers())
            ->post($this->baseUrl . 'orders', $payload);

        return $this->handle($response);
    }

    public function getOrderStatus($orderId)
    {
        $response = Http::withHeaders($this->headers())
            ->get($this->baseUrl . "orders/{$orderId}");

        return $this->handle($response);
    }

    // -------------------------------
    // BOOKS
    // -------------------------------
    public function getOrderBook()
    {
        return $this->handle(
            Http::withHeaders($this->headers())
                ->get($this->baseUrl . 'orders')
        );
    }

    public function getTradeBook()
    {
        return $this->handle(
            Http::withHeaders($this->headers())
                ->get($this->baseUrl . 'trades')
        );
    }

    public function getPositions()
    {
        return $this->handle(
            Http::withHeaders($this->headers())
                ->get($this->baseUrl . 'positions')
        );
    }

    public function getHoldings()
    {
        return $this->handle(
            Http::withHeaders($this->headers())
                ->get($this->baseUrl . 'holdings')
        );
    }

    // -------------------------------
    // FUND LIMIT
    // -------------------------------
    public function getFundLimits()
    {
        return $this->handle(
            Http::withHeaders($this->headers())
                ->get($this->baseUrl . 'fundlimit')
        );
    }

    // -------------------------------
    // RESPONSE HANDLER
    // -------------------------------
    private function handle($response)
    {
        if (!$response->successful()) {
            Log::error('Dhan API ERROR', [
                'status' => $response->status(),
                'body'   => $response->body()
            ]);

            return [
                'success' => false,
                'error'   => $response->json()
            ];
        }

        return [
            'success' => true,
            'data'    => $response->json()
        ];
    }
}
