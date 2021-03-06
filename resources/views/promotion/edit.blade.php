@extends('layouts.app')
@section('content')
<section class="wrapper">
<!--main content start-->
<h3 style="margin-left: 15px;"><i class="fa fa-angle-right"></i> Nuevo Centro Deportivo</h3>
<div class="col-lg-12">
  <div class="form-panel">
        <h4 class="mb"><i class="fa fa-angle-right"></i> Propietario del Centro</h4>
          

          <form data-parsley-validate class="form-horizontal style-form" action="{{ route('user.update',Crypt::encrypt($user->id)) }}" method="POST">
          @csrf 
          @method('PUT')
          <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Nombre: </label>
              <div class="col-sm-3">
                  <input type="text" class="form-control " name="name" value="{{ $user->name }}" minlength="3" maxlength="15" required >
                  @if($errors->has('name'))
                    <div id="tesdanger" class="text-danger">{{ $errors->first('name') }}</div>
                  @endif
              </div>
              <label class="col-sm-2 col-sm-2 control-label">Apellido Paterno:</label>
              <div class="col-sm-3">
                  <input class="form-control "  type="text" name="paternal" value="{{ $user->paternal }}" minlength="3" maxlength="15" required >
                  @if($errors->has('paternal'))
                      <div id="tesdanger" class="text-danger">{{ $errors->first('paternal') }}</div>
                  @endif
              </div>
          </div>
          
          <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Apellido Materno:</label>
              <div class="col-sm-3">
                  <input class="form-control"  type="text" name="maternal" value="{{ $user->maternal }}" minlength="3" maxlength="15" required >
                  @if($errors->has('maternal'))
                      <div id="tesdanger" class="text-danger">{{ $errors->first('maternal') }}</div>
                  @endif
              </div>
              <label class="col-sm-2 col-sm-2 control-label">Genero:</label>
              <div class="col-sm-3">
                  <select name="gender" class="form-control" disabled>
                    @if($user->gender == 1)
                    <option value="1"> Hombre </option>
                    @else
                    <option value="2"> Mujer </option>
                    @endif
                  </select>
              </div>
          </div>
          
          <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Direccion:</label>
              <div class="col-sm-3">
                  <input type="text"  class="form-control" name="address" value="{{ $user->address }}" minlength="3" required>
                  @if($errors->has('address'))
                      <div id="tesdanger" class="text-danger">{{ $errors->first('address') }}</div>
                  @endif
              </div>
              <label class="col-lg-2 col-sm-2 control-label">Email:</label>
              
              <div class="col-lg-3">
                  <input type="text"  class="form-control" name="email" value="{{ $user->email }}" minlength="3" required>
                  @if($errors->has('email'))
                      <div id="tesdanger" class="text-danger">{{ $errors->first('email') }}</div>
                  @endif
              </div>
          </div>
          
          <div class="form-group">
              <label class="col-lg-2 col-sm-2 control-label">CI:</label>
              <div class="col-lg-3">
                  <input type="text"  class="form-control" name="ci" value="{{ $user->ci }}" minlength="3" required pattern="[0-9]*">
                  @if($errors->has('ci'))
                      <div id="tesdanger" class="text-danger">{{ $errors->first('ci') }}</div>
                  @endif
              </div>
              <label class="col-lg-2 col-sm-2 control-label">Telefono / Celular:</label>
              <div class="col-lg-3">
                  <input type="text"  class="form-control" name="phone" value="{{ $user->phone }}" minlength="3" required pattern="[0-9]*">
                  @if($errors->has('phone'))
                      <div id="tesdanger" class="text-danger">{{ $errors->first('phone') }}</div>
                  @endif
              </div>
          </div>
          <h4 class="mb"><i class="fa fa-angle-right"></i> Detalle Centro Deportivo</h4>
          <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Nombre Centro Deportivo:</label>
              <div class="col-sm-3">
                  <input type="text" class="form-control " name="name_center" value="{{ $center->name_center }}" minlength="3" required >
                  @if($errors->has('name_center'))
                      <div id="tesdanger" class="text-danger">{{ $errors->first('name_center') }}</div>
                  @endif
              </div>
              <label class="col-sm-2 col-sm-2 control-label">Nit:</label>
              <div class="col-sm-3">
                  <input class="form-control "  type="text" name="nit" value="{{ $center->nit }}" minlength="3" required pattern="[0-9]*">
                  @if($errors->has('nit'))
                      <div id="tesdanger" class="text-danger">{{ $errors->first('nit') }}</div>
                  @endif
              </div>
          </div>
          
          <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Direccion de Centro Deportivo:</label>
              <div class="col-sm-3">
                  <input class="form-control"  type="text" name="address_center" value="{{ $center->address }}" minlength="3" required>
                  @if($errors->has('address_center'))
                      <div id="tesdanger" class="text-danger">{{ $errors->first('address_center') }}</div>
                  @endif
              </div>
              <label class="col-sm-2 col-sm-2 control-label">Actividad:</label>
              <div class="col-sm-3">
                  <input class="form-control"  type="text" name="activity" value="{{ $center->activity }}" minlength="3" maxlength="20" >
                  @if($errors->has('activity'))
                      <div id="tesdanger" class="text-danger">{{ $errors->first('activity') }}</div>
                  @endif
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Telefono / Celular Ref:</label>
              <div class="col-sm-3">
                  <input class="form-control"  type="text" name="cellphone" value="{{ $center->cellphone }}" minlength="3" required pattern="[0-9]*">
                  @if($errors->has('cellphone'))
                      <div id="tesdanger" class="text-danger">{{ $errors->first('cellphone') }}</div>
                  @endif
              </div>
              <div class="col-sm-3">
                <button type="submit" class="btn btn-success">Guardar</button>
                <button class="btn btn-default"><a href="{{ route('user.get') }}">Cancelar</a></button>
              </div>
          </div>
      </form>
  </div>
</div><!-- col-lg-12-->  
<!-- /MAIN CONTENT -->
</section>
@endsection
<style>
  #tesdanger {
    color : #EB1313;
  }
</style>