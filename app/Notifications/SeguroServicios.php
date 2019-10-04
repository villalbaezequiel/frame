<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SeguroServicios extends Notification
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
              ->subject('Nueva Lista de Teams!')
              ->greeting('Hola '.$data['user']->last_name.' '.$data['user']->name.'!')
              ->line('Estás recibiendo este correo para notificarte que se ha Generado un Listado de Teams para el Proyecto '.$data['project']->name.', con Tipo de Contrato Servicios.')
              ->action('Ver Listado', url('/export/seguros_servicios/'.$data['project']->id))
              ->line('En el Link anterior podrás ver el Listado de los Teams.')
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
