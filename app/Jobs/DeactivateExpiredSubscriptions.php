<?php

namespace App\Jobs;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeactivateExpiredSubscriptions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Obtiene todos los usuarios con suscripción activa
        $users = User::where('subscription_active', true)->get();

        foreach ($users as $user) {
            // Verifica si la suscripción ha caducado
            if ($user->last_sub_date && Carbon::now()->greaterThanOrEqualTo($user->last_sub_date)) {
                // Desactiva la suscripción del usuario
                $user->subscription_active = false;
                $user->save();
            }
        }
    }
}
