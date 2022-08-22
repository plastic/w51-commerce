<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);

        return view('admin.administradores.index', ['users' => $users,]);
    }

    public function search(Request $request)
    {
        $users = User::where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('email', 'LIKE', '%' . $request->search . '%')
            ->paginate(15);

        return view('admin.administradores.index', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([

            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/admin/administradores')->with('msg-sucess', 'Cadastro com feito sucesso');
    }

    public function show(User $user)
    {
        $breadcrumbs = [['name' => "Detalhes"]];
        return view('admin.administradores.show', ['user' => $user, 'breadcrumbs' => $breadcrumbs]);
    }


    public function edit(User $user)
    {
        return view('admin.administradores.edit', ['user' => $user]);
    }


    public function update(Request $request, User $user)
    {
        if ($request->password != null) {
            $request->validate([
                'password' => ['string', 'min:6', 'confirmed'],
            ]);
            $user->password = Hash::make($request->password);
        }

        if ($request->email != $user->email) {
            $request->validate([
                'email' => ['unique:users']
            ]);
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect('/admin/administradores')->with('msg-sucess', 'Usuário atualizado com sucesso');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/admin/administradores');
    }
}
