<?php

namespace sispg\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use sispg\AlumnoAsistencia;
use sispg\Utils\Traits\TraitNotificationRoute as NotificationRoute;
use sispg\Utils\UtilFunctions;

class NotificacionReprobacionDefinitiva extends Notification
{
    use Queueable,NotificationRoute;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    
    protected $al;
    protected $type;

    public function __construct(AlumnoAsistencia $al,$type)
    {
        $this->al = $al;
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
            'alumno_nombre'=> $this->al->estudiante->persona->full_name,
            'num_inasistencias'=> AlumnoAsistencia::where('idestudiante','=',$this->al->idestudiante)->count(),
            'grupo_codigo'=> $this->al->grupo_asistencia->grupo->codigoG,
            'url_location'=>$this->getUrlDestination($this->al->grupo_asistencia->idgrupo,$this->type)
        ];
    }
}
