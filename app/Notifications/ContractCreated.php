<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging\CloudMessage as FcmMessage;
use App\Helpers\FirebaseHelper;

class ContractCreated extends Notification implements ShouldQueue
{
    use Queueable;

    private $serviceRequest;
    private $contract;

    public function __construct($serviceRequest, $contract)
    {
        $this->serviceRequest = $serviceRequest;
        $this->contract = $contract;
        $this->afterCommit();
    }

    public function via($notifiable)
    {
        return [];  // No 'fcm' returned to avoid Laravel channel error
    }

    public function toFcm($notifiable)
    {
        $messaging = FirebaseHelper::messaging();
        $message = (new FcmMessage())
            ->withNotification([
                'title' => '¡Nuevo Contrato!',
                'body' => "Has sido contratado para: {$this->serviceRequest->category} - {$this->serviceRequest->subcategory} por BOB {$this->contract->agreed_budget}.",
            ])
            ->withData([
                'service_request_id' => (string) $this->serviceRequest->id,
                'contract_id' => (string) $this->contract->id,
                'type' => 'contract_created',
            ]);

        if ($notifiable->fcm_token) {
            $message = $message->withTarget('token', $notifiable->fcm_token);
            try {
                $messaging->send($message);
                \Log::info('FCM notification sent to worker: ' . $notifiable->id);
            } catch (\Exception $e) {
                \Log::error('FCM notification failed: ' . $e->getMessage());
            }
        } else {
            \Log::warning('No FCM token for worker: ' . $notifiable->id);
        }
    }
}
