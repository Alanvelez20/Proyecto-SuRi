<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
        // ->only()
    }

    public function index(Request $request)
    {

    // Obtener la lista de usuarios, ordenada según los parámetros recibidos
    $usuarios = User::all()->slice(1);

    // Retornar la vista con los datos de usuarios
    return view('users.userIndex', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.userCreate');
    }

    public function toggleSubscription(User $user)
    {
        // Cambiar el estado de suscripción del usuario
        $user->subscription_active = !$user->subscription_active;
        $user->save();

        // Redireccionar de vuelta a la lista de usuarios
        return redirect()->route('user.index')->with('status', 'Suscripción actualizada exitosamente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'subscription_active' => 'nullable|boolean',
            'plan' => 'nullable|string',
            'last_sub_date' => 'nullable|date',
        ]);
    
        $isSubscribed = $request->input('subscription_active') === '1';
        // Crear el usuario en la base de datos
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'subscription_active' => $validatedData['subscription_active'],
            'plan' => $isSubscribed ? $validatedData['plan'] : null,
            'last_sub_date' => $isSubscribed ? now() : null,
        ]);

        // Redirigir a una vista o página con un mensaje de éxito
        return redirect()->route('user.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function profile()
    {
        $user = Auth::user();

        // Convertir last_sub_date a un objeto Carbon
        $lastSubDate = $user->last_sub_date ? Carbon::parse($user->last_sub_date) : null;

        // Calcula los días restantes de suscripción
        $daysRemaining = null;
        if ($lastSubDate) {
            $now = Carbon::now();
            if ($lastSubDate->greaterThan($now)) {
                $daysRemaining = $now->diffInDays($lastSubDate);
            } else {
                $daysRemaining = 0; // O puedes ajustar este valor para indicar que la suscripción ya ha expirado
            }
        }

        return view('users.profile', compact('user', 'daysRemaining', 'lastSubDate'));
    }

    public function updateName(Request $request)
    {
        $userId = Auth::id();
    
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        DB::table('users')
        ->where('id', $userId)
        ->update(['name' => $request->input('name')]);
        
        return redirect()->route('user.profile')->with('success', 'Nombre actualizado exitosamente.');
    }

    public function updatePassword(Request $request)
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Validar los datos del formulario
        $request->validate([
            'current_password' => ['required', function($attribute, $value, $fail) use ($userId) {
                // Obtener la contraseña actual del usuario
                $currentPassword = DB::table('users')->where('id', $userId)->value('password');

                // Verificar la contraseña actual
                if (!Hash::check($value, $currentPassword)) {
                    $fail('La contraseña actual es incorrecta.');
                }
            }],
            'new_password' => [
            'required', 
            'confirmed', 
            Password::min(8)
                ->mixedCase()
                ->numbers()
        ],
    ], [
        'new_password.required' => 'La nueva contraseña es obligatoria.',
        'new_password.confirmed' => 'Las contraseñas no coinciden.',
        'new_password.min' => 'La nueva contraseña debe tener al menos :min caracteres.',
        'new_password.mixedCase' => 'La nueva contraseña debe contener mayúsculas y minúsculas.',
        'new_password.numbers' => 'La nueva contraseña debe contener números.',
    ]);

        // Actualizar la contraseña en la base de datos
        DB::table('users')
            ->where('id', $userId)
            ->update(['password' => Hash::make($request->input('new_password'))]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('user.profile')->with('success', 'Contraseña actualizada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = User::findOrFail($id);

        $usuario->last_sub_date = $usuario->last_sub_date ? \Carbon\Carbon::parse($usuario->last_sub_date) : null;

        return view('users.userEdit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Busca el usuario por su ID
        $usuario = User::findOrFail($id);

        // Valida los datos recibidos
        $request->validate([
            'name' => 'required|string|max:255',
            'plan' => 'nullable|string|max:255',
        ]);

        // Actualiza el nombre y el plan del usuario
        $usuario->name = $request->input('name');
        $usuario->plan = $request->input('plan');
        
        // Guarda los cambios en la base de datos
        $usuario->save();

        // Redirige a la vista de detalles del usuario con un mensaje de éxito
        return redirect()->back()->with('success', 'Información del usuario actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
