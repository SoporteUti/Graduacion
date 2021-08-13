<?php

namespace sispg\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use sispg\Utils\Traits\TraitNotificationRoute as NotificationRoute;

use sispg\{
    Estudiante,
    Utils\UtilFunctions
};


class NotificacionCalidadEgresadoPorCaducar extends Notification
{
    use Queueable, NotificationRoute;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $est=null;

    public function __construct(Estudiante $est,$type)
    {
        $this->est= $est;
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
            'alumno_nombre' => $this->est->persona->full_name,
            'url_location' => $this->getUrlDestination($this->est->estudiante_grupo->idgrupo,$this->type),
            'grupo_codigo' => $this->est->estudiante_grupo->grupo->codigoG,
            'type' => $this->type
        ];
    }
}
