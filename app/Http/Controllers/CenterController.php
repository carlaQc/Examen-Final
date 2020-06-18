<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CenterUpdate;
use Illuminate\Support\Facades\Crypt;
use App\Center;

class CenterController extends Controller
{
    /**
     * Lista de todos los centros deportivos registrados en el sistema.
     * Tipo: GET
     * URL: Centro_Deportivo
     * @Autor: Ronald Mollericona Miranda
     */
    public function getCenters()
    {
        $centers = Center::orderBy('center_id','desc')->paginate(15);
        return view('user.indexCenter',[
            'centers' => $centers
        ]);
    }
	 /**
     * Listar el dato del centro deportivo que pertenece al usuario logeado.
     * Tipo: GET
     * URL: Centro_Deportivo
     * @Autor: Ronald Mollericona Miranda
     */
	public function getCenter()
	{
		$center = Center::findOrFail(auth()->user()->center_id);
		return view('center_profile.index',[
			'center' => $center
		]);
	}

    /**
     * Envia a la pantalla de editar para poder ver los cambios que se puede realizar en el centro deportivo.
     * Tipo: GET
     * URL: Centro_Deportivo/Editar
     * @Autor: Ronald Mollericona Miranda
     */
	public function editCenter()
    {
    	$profile = Center::findOrFail(auth()->user()->center_id);
    	return view('center_profile.edit',[
    		'center' => $profile
    	]);
    }

    /**
     * Actualiza los datos que se desea actualizar.
     * Tipo: PUT
     * URL: Centro_Deportivo/Actualizar/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function updateCenter(CenterUpdate $request)
    {
    	$center = Center::findOrFail(auth()->user()->center_id);
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $name = time()."_".$file->getClientOriginalName();
            //Guardar en la Base de datos
            $center->photo = $name;
            // Se alamacena en la carpeta field las imagenes de las canchas
            $file->move(public_path().'/center/',$name);
        }
        $center->name_center = $request->name_center;
        $center->cellphone = $request->cellphone;
        $center->save();
        return view('center_profile.index',[
            'center' => $center
        ])->with('status','Registro actualizado exitosamente.');
    }
     /**
     * Listar todos los datos de los centros deportivos.
     * Tipo: GET
     * URL: Centros_Deportivos/
     * @Autor: Ronald Mollericona Miranda
     */
    public function getCentersReservation()
    {
        $centers = Center::select('center_id','name_center','address','activity','cellphone','photo')
                            ->get();
        return view('center.profile',[
            'centers' => $centers
        ]);
    }
}
