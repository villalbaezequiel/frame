<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Helpers;
use App\Contract;

class EntryTeamProject extends Notification
{
    use Queueable;

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
                ->subject('Alta de Team')
                ->greeting('Hola Estimado!')
                ->line('Estás recibiendo este correo para notificarte que se ha dado de Alta un Team en el Proyecto '.$data['project']->name.'.')
                ->line('Tipo de Contrato: '. Contract::getName($data['project_crew']->id_contract) .'.')
                ->line('Fecha de Alta: '. Helpers::getDateParseFormat($data['project_crew']->start_date_contract, '/') .'.')
                ->line('Fecha de Baja: '. Helpers::getDateParseFormat($data['project_crew']->finish_date_contract, '/') .'.')
                ->action('Descargar Contrato', route('export.crew_contract', $data['project_crew']->id))
                ->line('En el Link anterior podrás Descargar el Contrato del Team.')
                ->line('Nota: tienes que estar logueado en https://frame.com.ar/sistema para Descargar el Contrato.')
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
