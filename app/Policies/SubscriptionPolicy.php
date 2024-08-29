<?php

namespace App\Policies;

use App\Models\User;

class SubscriptionPolicy
{
    /**
     * Determina si el usuario puede acceder a una determinada función basada en su suscripción.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function accessFeature(User $user)
    {
        return $user->role === 'usuario' && $user->isSubscribed() === true;
    }
}
