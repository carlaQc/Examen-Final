<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdate;
use Illuminate\Support\Facades\Crypt;
use App\User;

class ProfileController extends Controller
{
	 /**
     * Se lista la informacion del Usuario para verificar los datos de su propio Perfil.
     * Tipo: GET
     * URL: Perfil
     * @Autor: Ronald Mollericona Miranda
     */
    public function getProfile()
    {
    	$profile = User::findOrFail(auth()->user()->id);
    	return view('profile.index',[
    		'profile' => $profile
    	]); 
    }

    /**
     * Envia a la pantalla de editar para poder actualizar los datos.
     * Tipo: GET
     * URL: Perfil/Editar
     * @Autor: Ronald Mollericona Miranda
     */
    public function editProfile()
    {
    	$profile = User::findOrFail(auth()->user()->id);
    	return view('profile.edit',[
    		'profile' => $profile
    	]);
    }

    /**
     * Actualiza todos los datos del Usuario.
     * Tipo: PUT
     * URL: Perfil/Actualizar/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function updateProfile(ProfileUpdate $request)
    {
    	$user = User::findOrFail(auth()->user()->id);
    	// Se agrega la fotografica que se ingrese desde el formulario
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $name = time()."_".$file->getClientOriginalName();
            //Guardar en la Base de datos
            $user->photo = $name;
            // Se alamacena en la carpeta field las imagenes de las canchas
            $file->move(public_path().'/profile/',$name);
        }
        $user->name = $request->name;
        $user->paternal = $request->paternal;
        $user->maternal = $request->maternal;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->ci = $request->ci;
        $user->phone = $request->phone;
        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->save();
    	return redirect()->route('profile.get')->with('status','Datos actualizados exitosamente.');
    }
}
