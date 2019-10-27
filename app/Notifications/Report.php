<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Report extends Notification
{
    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
      $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      $data = $this->data;

      return (new MailMessage)
            ->subject('Nuevo Reporte!')
            ->greeting('Hola Estimado!')
            ->line('Estás recibiendo este correo para Descargar un nuevo Reporte. Con las siguientes especificaciones:')
            ->line('Centro de Costo: '.$data['center_cost'])
            ->line('Tipo de Reporte: '.$data['type_report'])
            ->line('Desde: '.$data['from'])
            ->line('Hasta: '.$data['to'])
            ->action('Descargar', route('export_report.show', $data['report_id']))
            ->line('En el Link anterior podrás Descargar el Reporte.')
            ->salutation('Saludos, '. config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
