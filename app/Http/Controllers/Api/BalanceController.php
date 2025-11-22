<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChambeadorProfile;

class BalanceController extends Controller
{
    /**
     * Get worker balance
     */
   public function getBalance(Request $request)
{
    try {
        // Get the authenticated user
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'No estás autenticado. Por favor, inicia sesión.',
                'data' => [
                    'balance' => 0.00,
                    'worker_status' => 'unauthenticated',
                    'currency' => 'BOB',
                ],
            ], 401);
        }

        // Get worker profile
        $profile = ChambeadorProfile::where('uid', $user->uid)->first();

        if (!$profile) {
            return response()->json([
                'status' => 'error',
                'message' => 'Perfil de trabajador no encontrado.',
                'data' => [
                    'balance' => 0.00,
                    'worker_status' => 'not_found',
                    'currency' => 'BOB',
                ],
            ], 404);
        }

        // Defaults if NULL
        $balance = $profile->balance ?? 0.00;
        $status  = $profile->status ?? 'pending'; // default to pending

        // Determine message based on status
        if ($status === 'approved') {
            $message = 'Saldo verificado exitosamente.';
        } elseif ($status === 'rejected') {
            $message = 'Tus documentos han sido rechazados. Revisa tu perfil.';
        } else {
            $message = 'Tus documentos están en revisión. Una vez aprobados podrás acceder a tu cuenta de trabajador.';
        }

        // Prepare response
        $response = [
            'status' => $status === 'approved' ? 'success' : 'error',
            'message' => $message,
            'data' => [
                'balance' => number_format($balance, 2, '.', ''),
                'worker_status' => $status,
                'currency' => 'BOB',
            ],
        ];

        // Return JSON with proper HTTP code
        return response()->json($response, $status === 'approved' ? 200 : 403);

    } catch (\Exception $e) {
        // Catch all errors
        return response()->json([
            'status' => 'error',
            'message' => 'Error al verificar el saldo. Por favor, intenta de nuevo.',
            'data' => [
                'balance' => 0.00,
                'worker_status' => 'unknown',
                'currency' => 'BOB',
            ],
            'error' => $e->getMessage(),
        ], 500);
    }
}

    /**
     * Get balance recharge instructions
     */
    public function getRechargeInfo()
{
    try {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        $profile = ChambeadorProfile::where('uid', $user->uid)->first();

        return response()->json([
            'success' => true,
            'data' => [
                'whatsapp_number' => '+59178528046',
                'whatsapp_message' => 'Hola, quiero recargar mi saldo en la app Chambeador. Mi nombre es ' . ($profile->name ?? '') . ' ' . ($profile->last_name ?? '') . ' y mi número es ' . ($profile->phone ?? ''),
                'bank_details' => [
                    'bank_name' => 'Banco Unión',
                    'account_number' => '1234567890',
                    'account_holder' => 'Chambeador App',
                    'instructions' => 'Por favor envía tu comprobante de depósito a este chat y el administrador procesará tu recarga en 24 horas.'
                ]
            ]
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error fetching recharge info'
        ], 500);
    }
}
}
