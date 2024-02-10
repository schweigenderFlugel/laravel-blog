<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user) # Debemos importarlo
    {
        # Aquí recibimos el retorno de la variable $user en el RegisterController en la carpeta Auth (línea 74)
        $this->user = $user; 
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
        return (new MailMessage)
                    # Debemos indicarle a Laravel que usuario se registro. Para eso debemos ir a  
                    # app/Http/Controller/Auth/RegisterController.php (línea 67, 74)
                    ->greeting('Hola, '. $this->user->full_name) 
                    ->line('Nos complace darle la bienvenida a nuestro blog. Ahora puede realizar
                            comentarios acerca de nuestros articulos.')
                    ->action('Ir al blog', url('/'))
                    ->line('Gracias por ser parte de nuestra comunidad.');
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
