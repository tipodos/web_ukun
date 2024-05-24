<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use OpenAdmin\Admin\Auth\Database\Administrator; // Importa el modelo de administrador
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        // Verificar si el usuario es administrador
        if ($request->has('is_admin') && $request->is_admin) {
            $this->createAdmin($user);
        }

        // Aquí puedes añadir lógica adicional, como iniciar sesión automáticamente al usuario registrado
        Auth::login($user);

        return redirect()->route('inicio');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function createAdmin(User $user)
    {
        return Administrator::create([
            'username' => $user->name,
            'password' => $user->password,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
