<?php

namespace App\Http\Controllers;

use App\Mail\SuscriptionFormMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use MercadoPago;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showPlans()
    {
        return view('suscription.menuSusc');
    }

    public function send(Request $request)
    {
          // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'correo' => 'required|email',
        'mensaje' => 'required|string',
        'archivo' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:2048', // máximo 2MB
    ]);


    $message=[
        'nombre' => $request->nombre,
        'correo' => $request->correo,
        'mensaje' => $request->mensaje,
        'archivo' => $request->file('archivo')
    ];


    // Enviar el correo usando el Mailable
    Mail::to('surimx2024@gmail.com')->send(new SuscriptionFormMail($message));

    return back()->with('success', 'Formulario enviado exitosamente.');
    }

    public function processSubscription(Request $request)
    {
        // Configurar el SDK de Mercado Pago con tu access token
        MercadoPago\SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

        // Crear una preferencia de pago
        $preference = new MercadoPago\Preference();

        // Configura los detalles del item basado en el plan seleccionado
        $item = new MercadoPago\Item();
        $plan = $request->input('plan');
        $item->title = ($plan === 'mensual') ? 'Suscripción Mensual' : 'Suscripción Anual';
        $item->quantity = 1;
        $item->unit_price = ($plan === 'mensual') ? 200 : 1200; // Ajusta los precios según tus necesidades

        $preference->items = array($item);

        // Agregar el ID del usuario en la referencia externa
        $preference->external_reference = json_encode([
        'user_id' => auth()->user()->id,
        'plan' => $plan
        ]);

        // Configura las URLs de retorno para manejar la respuesta del pago
        $preference->back_urls = array(
            "success" => route('payment.success'),
            "failure" => route('payment.failure'),
            "pending" => route('payment.pending')
        );
        $preference->auto_return = "approved";

        // Guarda la preferencia
        $preference->save();

        // Redirige al usuario a la página de pago de Mercado Pago
        return redirect()->away($preference->init_point);
    }

    

    public function paymentSuccess(Request $request)
    {
        $externalReference = $request->input('external_reference'); // Recupera el ID del usuario

        // Decodificar la referencia externa
        $referenceData = json_decode($externalReference, true);

        if (isset($referenceData['user_id']) && isset($referenceData['plan'])) {
            $user = User::find($referenceData['user_id']);

            if ($user) {
                // Determina el valor a guardar en la base de datos
                $planToSave = ($referenceData['plan'] === 'mensual') ? 'Mensual' : 'Anual';

                // Activar la suscripción del usuario o actualizar su información
                $user->subscription_active = true;
                $user->plan = $planToSave; // Solo guarda 'Mensual' o 'Anual'
                
                // Lógica para manejar la fecha de suscripción
                if ($user->last_sub_date) {
                    // Calcula la fecha de finalización de la suscripción actual
                    $endOfCurrentSubscription = Carbon::parse($user->last_sub_date)->addMonth();
                    
                    // Determina el tiempo adicional en función del plan
                    if ($planToSave === 'Mensual') {
                        $additionalTime = $endOfCurrentSubscription->addMonth();
                    } else {
                        $additionalTime = $endOfCurrentSubscription->addYear();
                    }

                    // Verifica si la suscripción ha caducado o si aún está activa
                    if (now()->greaterThanOrEqualTo($endOfCurrentSubscription)) {
                        // Si ha caducado, actualiza la fecha de suscripción a la fecha actual
                        $user->last_sub_date = now()->add($additionalTime->diff($endOfCurrentSubscription));
                    } else {
                        // Si aún está activa, agrega el tiempo correspondiente
                        $user->last_sub_date = $additionalTime;
                    }
                } else {
                    // Si no había una fecha anterior, registra la fecha actual como el inicio de la suscripción
                    if ($planToSave === 'Mensual') {
                        $user->last_sub_date = now()->addMonth();
                    } else {
                        $user->last_sub_date = now()->addYear();
                    }
                }
            
                $user->save();
            }
        }
        return view('suscription.success');
    }

    public function paymentFailure()
    {
        // Lógica para manejar el fallo del pago
        return view('suscription.failure');
    }

    public function paymentPending()
    {
        // Lógica para manejar los pagos pendientes
        return view('suscription.pending');
    }


}
