<?php

namespace sispg\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use sispg\grupo_solicitud;

class SolicitudCambioTema extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $gs;
    protected $type;
    
    public function __construct(grupo_solicitud $gs,$type)
    {
        $this->gs= $gs;
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

    /**
     * [getUrlDestination description]
     * 0: ASESOR
     * 1: COORDINADOR GENERAL
     * 2: DIRECTOR GENERAL
     * @return [type] [description]
     */
    private function getUrlDestination()
    {
        switch ($this->type) {
            case 0:
                return '/ues/grupos/vista_asesor/'.$this->gs->grupo->idgrupo;
                break;
            case 1:
                return '/ues/grupos/steps/'.$this->gs->grupo->idgrupo;
                break;
            case 2:
                return '/ues/grupos/vista_director/'.$this->gs->grupo->idgrupo;
                break;
            
            default:
                return '/';
                break;
        }
    }

    public function toDatabase($notifiable)
    {
        return [
            'carrera'=>$this->gs->grupo->carrera->nombre,
            'grupo_codigo'=>$this->gs->grupo->codigoG,
            'url_location'=>$this->getUrlDestination()
        ];
    }
}
