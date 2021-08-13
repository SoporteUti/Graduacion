<?php

namespace sispg\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use sispg\Utils\Traits\TraitNotificationRoute as NotificationRoute;
use sispg\Grupo;
use sispg\Fecha;
use Carbon\Carbon;

class NotificacionDefensa extends Notification
{
    use Queueable,NotificationRoute;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    
    protected $fecha = null;
    protected $type = null;

    public function __construct(Fecha $fecha, $type)
    {
        $this->fecha = $fecha;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', 'https://laravel.com')
                    ->line('Thank you for using our application!');
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

    public function toDatabase($notifiable)
    {
        return [
            'grupo_codigo' => $this->fecha->periodo->grupo->codigoG,
            'url_location' => $this->getUrlDestination($this->fecha->periodo->grupo->idgrupo,$this->type), 
            'etapa' => $this->fecha->etapa->idnombreetapa,
            'type' => $this->type,
            'fecha' => Carbon::parse($this->fecha->fechasetapas)->format('d/m/Y')
        ];
    }
}
