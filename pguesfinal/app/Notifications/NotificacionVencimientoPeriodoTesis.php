<?php

namespace sispg\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use sispg\Utils\Traits\TraitNotificationRoute as NotificationRoute;
use sispg\Periodo;
use Carbon\Carbon;

class NotificacionVencimientoPeriodoTesis extends Notification
{
    use Queueable, NotificationRoute;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $periodo = null;
    protected $type;

    public function __construct(Periodo $periodo, $type)
    {
        $this->periodo = $periodo;
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
            'grupo_codigo' => $this->periodo->grupo->codigoG,
            'url_location' =>  $this->getUrlDestination($this->periodo->grupo->idgrupo,$this->type),
        'periodo'=> Carbon::parse($this->periodo->fInicio)->format("d/m/Y")." - ".Carbon::parse($this->periodo->fFin)->format("d/m/Y"),
            'type' => $this->type
        ];
    }
}
