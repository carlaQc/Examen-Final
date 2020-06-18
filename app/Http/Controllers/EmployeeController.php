<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeStore;
use App\Http\Requests\EmployeeUpdate;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Center;

class EmployeeController extends Controller
{
    /**
     * Listar datos de los empleado registrados de cada centro deportivo.
     * Tipo: GET
     * URL: Usuarios_Centro_Deportivo
     * @Autor: Ronald Mollericona Miranda
     */
    public function getEmployee()
    {
        $users = User::where('center_id',auth()->user()->center_id)
                ->where('rol_id',3)
                ->paginate(15);
        return view('employee.index',[
            'users' => $users
        ]);
    }

    /**
     * Redirecciona a la vista que se encuentra en emplot/create.
     * Tipo: GET
     * URL: Empleado/Nuevo
     * @Autor: Ronald Mollericona Miranda
     */
    public function createEmployee()
    {
        return view('employee.create');
    }

    /**
     * Se almacena todos los datos de que se envian desde el formulario.
     * Tipo: POST
     * URL: Empleado/Nuevo/Guardar
     * @Autor: Ronald Mollericona Miranda
     */
    public function storeEmployee(EmployeeStore $request)
    {
        $user = new User;
        $user->center_id = auth()->user()->center_id;
        $user->rol_id = 3;
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
        return redirect()->route('employee.get')->with('status','Empleado creado exitosamente.');
    }

    /**
     * Envia a la pantalla de editar para poder actualizar los datos.
     * Tipo: GET
     * URL: Empleado/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function editEmployee($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        return view('employee.edit',[
            'user'=>$user
        ]);
    }

    /**
     * Actualiza todos los datos del empleado del centro deportivo.
     * Tipo: PUT
     * URL: Empleado/Actualizar/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function updateEmployee(EmployeeUpdate $request, $id)
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
        return redirect()->route('employee.get')->with('status','Usuario actualizado exitosamente.');
    }

    /**
     * Se activa al usuario Empleado del centro deportivo que estuvo inactivo
     * Tipo: PUT
     * URL: Empleado/Desactivar/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function activateEmployee($id)
    {
        $user = User::findOrFail($id);
        $user->state = 1;
        $user->save();
        return redirect()->route('employee.get')->with('status','Usuario activado exitosamente.');
    }

    /**
     * Se desactiva al usuario Empleado del centro deportivo.
     * Tipo: PUT
     * URL: Empleado/Desactivar/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function deactivateEmployee($id)
    {
        $user = User::findOrFail($id);
        $user->state = 0;
        $user->save();
        return redirect()->route('employee.get')->with('status','Usuario desactivado exitosamente.');
    }

     /**
     * Eliminar los datos por completo del Empleado.
     * Tipo: PUT
     * URL: Empleado/Desactivar/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function deleteEmployee($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('employee.get')->with('status','Usuario eliminado del registro!');
    }
}
