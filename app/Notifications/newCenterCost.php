<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newCenterCost extends Notification
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
                ->subject('Nuevo Centro de Costo!')
                ->greeting('Hola '.$data['user']->last_name.' '.$data['user']->name.'!')
                ->line('Estás recibiendo este correo para notificarte que se ha Creado un nuevo Centro de Costo al Sistema de Frame.')
                ->action('Ver Centro de Costo', route('center_costs.edit', $data['center_cost']->id))
                ->line('En el Link anterior podrás ver Informacion del Centro de Costo.')
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
