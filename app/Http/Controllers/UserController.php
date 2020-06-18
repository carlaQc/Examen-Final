<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Center;

class UserController extends Controller
{
    /**
     * Listar datos de los administradores registrados de cada centro deportivo.
     * Tipo: GET
     * URL: Usuarios
     * @Autor: Ronald Mollericona Miranda
     */
    public function getUser()
    {
        $users = User::join('info_centers','info_centers.center_id','=','users.center_id')
                        ->select('users.id as id',
                            'users.name as name',
                            'users.paternal as paternal',
                            'users.maternal as maternal',
                            'users.email as email',
                            'info_centers.name_center as name_center',
                            'users.phone as phone',
                            'users.ci as ci',
                            'users.state as state')
                        ->where('rol_id',2)
                        ->paginate(15);
        return view('user.index',[
            'users'=>$users
            ]);
    }

    /**
     * Se Muestra la pantalla para crear un Centro deportivo
     * Tipo: Get   
     * URL: Usuario/nuevo-centro
     * @Autor: Ronald Mollericona Miranda
     */
    public function getUserCenter(){
        return view('user.createCenter');
    }

    /**
     * Redirecciona a la vista que se encuentra en user/create.
     * Tipo: GET
     * URL: Usuario/Nuevo
     * @Autor: Ronald Mollericona Miranda
     */
    public function createUser($center_id)
    {
        return view('user.create',[ 'center' => $center_id ]);
    }

    /**
     * Se almacena todos los datos de que se envian desde el formulario para nuestro Nuevo Administrador.
     * Tipo: POST
     * URL: Usuario/Nuevo
     * @Autor: Ronald Mollericona Miranda
     */
    public function storeUser(Request $request, $center_id)
    {
        $user = new User;
        $user->center_id = $center_id;
        $user->rol_id = 2;
        $user->name = $request->name;
        $user->paternal = $request->paternal;
        $user->maternal = $request->maternal;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->ci = $request->ci;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->ci);
        $user->photo = 'default.png';
        $user->save();
        return redirect()->route('user.get')->with('status','Registro de Administrador y Centro Deportivo creado exitosamente.');
        // return redirect()->route('schedule.store',$center->center_id);
    }

    /**
     * Se almacena todos los datos de que se envian desde el formulario para crear un nuevo centro deportivo.
     * Tipo: POST
     * URL: Usuario/Nuevo/Guardar-centro
     * @Autor: Ronald Mollericona Miranda
     */
    public function storeCenter(Request $request)
    {
        $center = new Center;
        $center->name_center = $request->name_center;
        $center->nit = $request->nit;
        $center->address = $request->address_center;
        $center->activity = $request->activity;
        $center->cellphone = $request->cellphone;
        $center->photo = 'default_center.jpg';
        $center->save();
        return redirect()->route('user.create',$center->center_id);
    }

    /**
     * Envia a la pantalla de editar para poder actualizar los datos del administrador del centro deportivo
     * Tipo: GET
     * URL: Usuario/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function editUser($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        return view('user.edit',[
            'user' => $user,
        ]);
    }

        /**
     * Envia a la pantalla de editar para poder actualizar los datos del centro deportivo.
     * Tipo: GET
     * URL: actualizar-centro/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function editUserCenter($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        $center = Center::findOrFail($user->center_id);
        return view('user.editCenter',[
            'user' => $user,
            'center' => $center
        ]);
    }

    /**
     * Actualiza todos los datos del Administrador del centro deportivo.
     * Tipo: PUT
     * URL: Usuario/Actualizar/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function updateUser(Request $request, $id)
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
        return redirect()->route('user.get')->with('status','Administrador actualizado exitosamente.');
    }
    /**
     * Actualiza todos los datos del Administrador del centro deportivo.
     * Tipo: PUT
     * URL: Usuario/Actualizar/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function updateUserCenter(Request $request, $id)
    {   
        $id = Crypt::decrypt($id);
        $center = Center::findOrFail($id);
        $center->name_center = $request->name_center;
        $center->nit = $request->nit;
        $center->address = $request->address_center;
        $center->activity = $request->activity;
        $center->cellphone = $request->cellphone;
        $center->save();
        return redirect()->route('user.get')->with('status','Centro Deportivo actualizado exitosamente.');
    }

    /**
     * Se activa al usuario Administrador del centro deportivo que estuvo inactivo
     * Tipo: PUT
     * URL: Usuario/Desactivar/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function activateUser($id)
    {
        $user = User::findOrFail($id);
        $user->state = 1;
        $user->save();
        return redirect()->route('user.get')->with('status','Usuario activado exitosamente.');
    }

    /**
     * Se desactiva al usuario Administrador del centro deportivo.
     * Tipo: PUT
     * URL: Usuario/Desactivar/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function deactivateUser($id)
    {
        $user = User::findOrFail($id);
        $user->state = 0;
        $user->save();
        return redirect()->route('user.get')->with('status','Usuario desactivado exitosamente.');
    }

    public function stateCenter($id){
        $center = Center::findOrFail($id);
        $center->state = ($center->state) == "1"? 0 : 1;
        $center->save();
        return redirect()->route('centers.get')->with('status','Estado actualizado exitosamente.');
    }
}
