<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserGestionStore;
use App\Http\Requests\UserGestionUpdate;
use Illuminate\Support\Facades\Crypt;
use App\User;

class UserGestionController extends Controller
{
    /**
     * Listar datos de los usuarios registrados.
     * Tipo: GET
     * URL: /GestionUsuarios
     * @Autor: Ronald Mollericona Miranda
     */
    public function getUserAdmin()
    {
        $users = User::where('rol_id',1)->paginate(15);
        return view('userAdmin.index',[
            'users' => $users
        ]);
    }

    /**
     * Redirecciona a la vista que se encuentra en userAdmin/create.
     * Tipo: GET
     * URL: /GestionUsuario/Nuevo
     * @Autor: Ronald Mollericona Miranda
     */
    public function createUserAdmin()
    {  
        return view('userAdmin.create');
    }

    /**
     * Se almacena todos los datos de que se envian desde el formulario.
     * Tipo: POST
     * URL: /GestionUsuario/Store
     * @Autor: Ronald Mollericona Miranda
     */
    public function storeUserAdmin(UserGestionStore $request)
    {
        $user = new User;
        $user->rol_id = 1;
        $user->name = $request->name;
        $user->paternal = $request->paternal;
        $user->maternal = $request->maternal;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->ci = $request->ci;
        $user->password = bcrypt($request->ci);
        $user->phone = $request->phone;
        $user->photo = 'default.png';
        $user->save();
        return redirect()->route('userAdmin.get')->with('status','Registro creado exitosamente.');
    }

    /**
     * Envia a la pantalla de editar para poder actualizar los datos.
     * Tipo: GET
     * URL: GestionUsuario/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function editUserAdmin($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        return view('userAdmin.edit',[
            'user'=>$user
        ]);
    }

    /**
     * Actualiza todos los cambios que hizo el usuario.
     * Tipo: PUT
     * URL: GestionUsuario/{id}/Actualizar
     * @Autor: Ronald Mollericona Miranda
     */
    public function updateUserAdmin(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->paternal = $request->paternal;
        $user->maternal = $request->maternal;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->ci = $request->ci;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('userAdmin.get')->with('status','Registro actualizado exitosamente.');
    }

    /**
     * Se desactiva al usuario.
     * Tipo: PUT
     * URL: GestionUsuario/{id}/Desactivar
     * @Autor: Ronald Mollericona Miranda
     */
    public function deactiveUserAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->state = 0;
        $user->save();
        return redirect()->route('userAdmin.get')->with('status','Usuario desactivado exitosamente.');
    }
    /**
     * Se activa al usuario que estuvo inactivo
     * Tipo: PUT
     * URL: GestionUsuario/{id}/Desactivar
     * @Autor: Ronald Mollericona Miranda
     */
    public function activeUserAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->state = 1;
        $user->save();
        return redirect()->route('userAdmin.get')->with('status','Usuario activado exitosamente.');
    }
}
