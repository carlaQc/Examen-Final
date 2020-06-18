<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FieldStore;
use App\Http\Requests\FieldUpdate;
use Illuminate\Support\Facades\Crypt;
use App\Field;
use App\FieldState;
use App\FieldDescription;

class FieldController extends Controller
{
    /**
     * Listar datos de las canchas registradas por centro.
     * Tipo: GET
     * URL: Cancha
     * @Autor: Ronald Mollericona Miranda
     */
    public function getField()
    {
        $field = Field::where('center_id',auth()->user()->center_id)->paginate(8);
        return view('field.index',[
            'fields'=>$field
        ]);
    }

    /**
     * Redirecciona a la vista que se encuentra en field/create.
     * Tipo: GET
     * URL: Cancha/Nuevo
     * @Autor: Ronald Mollericona Miranda
     */
    public function createField()
    {
        return view('field.create');
    }

    /**
     * Se almacena todos los datos de que se envian desde el formulario.
     * Tipo: POST
     * URL: Cancha/Nuevo
     * @Autor: Ronald Mollericona Miranda
     */
    public function storeField(Request $request)
    {
        $field = new Field;

        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $name = time()."_".$file->getClientOriginalName();
            //Guardar en la Base de datos
            $field->photo = $name;
            // Se alamacena en la carpeta field las imagenes de las canchas
            $file->move(public_path().'/field/',$name);
        }

        $field->center_id = auth()->user()->center_id;
        $field->field_state_id = 1;
        $field->name_field = $request->name;
        $field->price = $request->price;
        $field->description = $request->description;
        $field->save();
        return redirect()->route('schedule.store',Crypt::encrypt($field->field_id));
    }

    /**
     * Envia a la pantalla de editar para poder actualizar los datos.
     * Tipo: GET
     * URL: Cancha/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function editField($id)
    {
        $id = Crypt::decrypt($id);
        $field = Field::findOrFail($id);
        return view('field.edit',[
            'field'=>$field
        ]);
    }

    /**
     * Actualiza todos los datos de la tabla Field(Cancha).
     * Tipo: PUT
     * URL: Cancha/Actualizar/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function updateField(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        $field = Field::findOrFail($id);

        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $name = time()."_".$file->getClientOriginalName();
            //Guardar en la Base de datos
            $field->photo = $name;
            // Se alamacena en la carpeta field las imagenes de las canchas
            $file->move(public_path().'/field/',$name);
        }

        $field->name_field = $request->name;
        $field->price = $request->price;
        $field->description = $request->description;
        $field->save();
        return redirect()->route('field.get')->with('status','Registro actualizado exitosamente.');
    }

    /**
     * Se obtiene todas la fotografias de una cancha de la tabla FieldDescription.
     * Tipo: GET
     * URL: Cancha/Nuevo/Fotografia/{field_id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function getPhotosField($field_id){
        $field_id = Crypt::decrypt($field_id);

        $photo = FieldDescription::select('field_id','photo_description')
                        ->where('field_id',$field_id)
                        ->get();
        return view('field.photo',[
            'field_photo'=>$photo,
            'field_id' => $field_id
        ]);
    }

    /**
     * Se almacena todas las fotografias ingresadas.
     * Tipo: POST
     * URL: Cancha/Fotografia/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function addPhotosField(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        $photo = new FieldDescription;
        $photo->field_id = $id;

        $file = $request->file('photo_description');
        $name = time()."_".$file->getClientOriginalName();
        //Guardar en la Base de datos
        $photo->photo_description = $name;
        // Se alamacena en la carpeta field las imagenes de las canchas
        $file->move(public_path().'/field/',$name);
        $photo->save();
        return redirect()->route('fieldPhotos.get',Crypt::encrypt($id))->with('status','Nueva imagen registrada exitosamente.');
    }

    /**
     * Listar todos los datos de la cancha seleccionada.
     * Tipo: GET
     * URL: Centros_Deportivos/Canchas/{center_id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function getFieldCenter($center_id)
    {
        $center_id = Crypt::decrypt($center_id);

        $field = Field::where('center_id',$center_id)->get();
        return view('field_list.index',[
            'field'=>$field
        ]);
    }

    /**
     * Actualizar el estdo de los campos deportivos.
     * Tipo: GET
     * URL: campo/actualizar/{id}/{state}
     * @Autor: Ronald Mollericona Miranda
     */
    public function stateField($id, $field){
        $state = intval($field);
        $field = Field::findOrFail(intval($id));
        $field->field_state_id = $state;
        $field->save();
        return redirect()->route('field.get')->with('status','Estado actualizado exitosamente.');
    }

    public function getPayment($field_id){
        $data = Field::findOrFail($field_id);
        return response()->json([
            'data' => $data
        ]);
    }
}
