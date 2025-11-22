<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EquipmentInspectionReminder extends Notification
{
    use Queueable;

    public $equipment;
    public $nextInspection;
    public $isCritical;

    /**
     * Crear una nueva instancia de la notificación.
     */
    public function __construct($equipment, $nextInspection, $isCritical = false)
    {
        $this->equipment = $equipment;
        $this->nextInspection = $nextInspection;
        $this->isCritical = $isCritical;
    }

    /**
     * Canales por los cuales se enviará la notificación.
     */
    public function via($notifiable)
    {
        return ['mail']; // Puedes agregar 'database' o 'sms' si se requiere
    }

    /**
     * Construir el mensaje del correo.
     */
    public function toMail($notifiable)
    {
        // URLs iguales a las usadas en los códigos QR
        $labelUrl = url('/equipment/label?code=' . $this->equipment->code);
        $inspectionUrl = url('/inspections/history?code=' . $this->equipment->code);

        // Asunto y mensaje según criticidad
        if ($this->isCritical) {
            $subject = "⚠️ ¡Alerta Crítica de Equipo!";
            $message = "El equipo **{$this->equipment->code}** se encuentra **FUERA DE SERVICIO** y requiere atención inmediata.";
        } else {
            $subject = "🔔 Recordatorio de Inspección Próxima";
            $message = "El equipo **{$this->equipment->code}** tiene una inspección programada para el **{$this->nextInspection->format('d/m/Y')}**.";
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting('Hola,')
            ->line($message)
            ->line('Por favor, revise el estado y los registros de inspección a continuación:')
            ->action('Ver Etiqueta del Equipo', $labelUrl)
            ->action('Ver Historial de Inspecciones', $inspectionUrl)
            ->line('Gracias por confiar en nuestro sistema de gestión de seguridad.')
            ->salutation('— Equipo de Seguridad Industrial');
    }
}
