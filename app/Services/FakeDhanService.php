<?php
// app/Services/FakeDhanService.php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Http\Client\Response;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

class FakeDhanService
{
    protected string $clientId = '1100998877'; // fake client ID
    protected array $orders = [];
    protected array $trades = [];
    protected array $positions = [];
    protected array $holdings = [];

    public function __construct()
    {
        $this->seedFakeData();
    }

    private function seedFakeData(): void
    {
        // Fake Order Book
        $this->orders = [
            [
                'orderId'         => '412312300001',
                'tradingSymbol'   => 'RELIANCE',
                'securityId'      => '1333',
                'transactionType' => 'BUY',
                'orderType'       => 'LIMIT',
                'productType'     => 'INTRADAY',
                'price'           => 2450.50,
                'triggerPrice'    => 0,
                'quantity'        => 10,
                'tradedQuantity'  => 10,
                'tradedPrice'     => 2450.50,
                'orderStatus'     => 'TRADED',
                'exchangeTime'    => now()->subMinutes(30)->format('Y-m-d H:i:s'),
            ],
            [
                'orderId'         => '412312300002',
                'tradingSymbol'   => 'TCS',
                'securityId'      => '11536',
                'transactionType'  => 'SELL',
                'orderType'       => 'MARKET',
                'productType'     => 'INTRADAY',
                'price'           => 0,
                'triggerPrice'    => 0,
                'quantity'        => 5,
                'tradedQuantity'  => 5,
                'tradedPrice'     => 3780.00,
                'orderStatus'     => 'COMPLETE',
                'exchangeTime'    => now()->subHours(2)->format('Y-m-d H:i:s'),
            ],
            [
                'orderId'         => '412312300003',
                'tradingSymbol'   => 'INFY',
                'securityId'      => '1594',
                'transactionType' => 'BUY',
                'orderType'       => 'LIMIT',
                'productType'     => 'INTRADAY',
                'price'           => 1420.00,
                'quantity'        => 20,
                'tradedQuantity'  => 0,
                'orderStatus'     => 'PENDING',
            ],
        ];

        // Fake Positions
        $this->positions = [
            [
                'tradingSymbol' => 'RELIANCE',
                'netQty'        => 10,
                'avgPrice'      => 2450.50,
                'ltp'           => 2575.75,
                'pnl'           => 1252.50,
                'productType'   => 'INTRADAY',
            ],
        ];

        // Fake Holdings (Delivery)
        $this->holdings = [
            [
                'tradingSymbol' => 'HDFCBANK',
                'holdingQty'    => 15,
                'avgCost'       => 1620.00,
                'ltp'           => 1685.00,
                'pnl'           => 975.00,
            ],
        ];

        // Fake Trades
        $this->trades = [
            [
                'tradeId'        => 'T123456789',
                'orderId'        => '412312300001',
                'tradingSymbol'  => 'RELIANCE',
                'transactionType'=> 'BUY',
                'tradePrice'     => 2450.50,
                'tradeQuantity'  => 10,
                'tradeTime'      => now()->subMinutes(30)->format('Y-m-d H:i:s'),
            ],
        ];
    }

    // ====================================================================
    // ORDER METHODS
    // ====================================================================

    public function placeOrder(array $payload)
    {
        $fakeOrderId = '4123' . date('dmy') . rand(10000, 99999);

        $fakeOrder = [
            'orderId'        => $fakeOrderId,
            'orderStatus'    => 'PENDING',
            'message'        => 'Order accepted',
        ];

        // Add to fake order book
        $this->orders[] = [
            'orderId'         => $fakeOrderId,
            => strtoupper($payload['securityId'] === '1333' ? 'RELIANCE' : 'TCS'),
            'securityId'      => $payload['securityId'],
            'transactionType' => $payload['transactionType'],
            'orderType'       => $payload['orderType'],
            'productType'     => $payload['productType'],
            'price'           => $payload['price'],
            'triggerPrice'    => $payload['triggerPrice'] ?? 0,
            'quantity'        => $payload['quantity'],
            'tradedQuantity'  => 0,
            'orderStatus'     => 'PENDING',
            'exchangeTime'    => now()->format('Y-m-d H:i:s'),
        ];

        // Simulate instant fill for MARKET orders after 3 seconds
        if ($payload['orderType'] === 'MARKET') {
            foreach ($this->orders as &$order) {
                if ($order['orderId'] === $fakeOrderId) {
                    $order['tradedQuantity'] = $order['quantity'];
                    $order['tradedPrice']    = $order['price'] == 0 ? 2500.00 : $order['price'];
                    $order['orderStatus']    = 'TRADED';
                    break;
                }
            }
        }

        return new Response(new GuzzleResponse(200, [], json_encode($fakeOrder)));
    }

    public function getOrderBook()
    {
        return new Response(new GuzzleResponse(200, [], json_encode($this->orders)));
    }

    public function getOrderStatus(string $orderId)
    {
        $order = collect($this->orders)->firstWhere('orderId', $orderId);

        if (!$order) {
            return new Response(new GuzzleResponse(404, [], json_encode(['message' => 'Order not found'])));
        }

        return new Response(new GuzzleResponse(200, [], json_encode($order)));
    }

    public function cancelOrder(string $orderId)
    {
        foreach ($this->orders as &$order) {
            if ($order['orderId'] === $orderId && in_array($order['orderStatus'], ['PENDING', 'OPEN'])) {
                $order['orderStatus'] = 'CANCELLED';
                return new Response(new GuzzleResponse(200, [], json_encode(['message' => 'Order cancelled'])));
            }
        }

        return new Response(new GuzzleResponse(400, [], json_encode(['message' => 'Cannot cancel filled/rejected order'])));
    }

    // ====================================================================
    // TRADE & POSITION METHODS
    // ====================================================================

    public function getTradeBook()
    {
        return new Response(new GuzzleResponse(200, [], json_encode($this->trades)));
    }

    public function getPositions()
    {
        return new Response(new GuzzleResponse(200, [], json_encode($this->positions)));
    }

    public function getHoldings()
    {
        return new Response(new GuzzleResponse(200, [], json_encode($this->holdings)));
    }

    public function getFundLimits()
    {
        return new Response(new GuzzleResponse(200, [], json_encode([
            'availableBalance' => 98500.00,
            'utilisedAmount'   => 1500.00,
            'payinAmount'      => 100000.00,
        ])));
    }

    // ====================================================================
    // HELPER METHODS (same signature as real service)
    // ====================================================================

    public function ok($response): bool
    {
        return $response->getStatusCode() === 200;
    }

    public function result($response): array
    {
        $body = json_decode($response->body(), true) ?? [];

        return [
            'success' => $response->getStatusCode() === 200,
            'data'    => $body,
        ];
    }
}
