@extends('layouts.app')
@section('content')
<!--main content start-->
<section class="wrapper">
<div class="col-md-12">
    <div class="content-panel table-responsive ">
        <h3><i class="fa fa-angle-right"></i>Perfil</h3>
        <div class="row">
                <div class="col-lg-12">
                  <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i>Editar Perfil</h4>
                      <form data-parsley-validate class="form-horizontal style-form" action="{{ route('profile.update',Crypt::encrypt($profile->id)) }}" method="POST">

                        @csrf
                        @method('PUT')
                        
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
                              <div class="col-sm-3">
                                  <input type="text" class="form-control " name="name" value="{{ $profile->name }}">
                              </div>
                              <label class="col-sm-2 col-sm-2 control-label">Apellido Paterno</label>
                              <div class="col-sm-3">
                                  <input class="form-control "  type="text" name="paternal" value="{{ $profile->paternal }}">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Apellido Materno</label>
                              <div class="col-sm-3">
                                  <input class="form-control"  type="text" name="maternal" value="{{ $profile->maternal }}">
                              </div>
                              <label class="col-lg-2 col-sm-2 control-label">CI</label>
                              <div class="col-lg-3">
                                  <input type="text"  class="form-control" name="ci" value="{{ $profile->ci }}">
                              </div>
                              
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Direccion</label>
                              <div class="col-sm-3">
                                  <input type="text"  class="form-control" name="address" value="{{ $profile->address }}">
                              </div>
                              <label class="col-lg-2 col-sm-2 control-label">Email</label>
                              <div class="col-lg-3">
                                  <input type="text"  class="form-control" name="email" value="{{ $profile->email }}">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              
                              <label class="col-lg-2 col-sm-2 control-label">Telefono / Celular</label>
                              <div class="col-lg-3">
                                  <input type="text"  class="form-control" name="phone" value="{{ $profile->phone }}">
                              </div>
                              <label class="col-sm-2 col-sm-2 control-label">Foto de perfil</label>
                              <div class="col-sm-4">
                                  <input class="form-control"  type="file" name="photo" value="{{ $profile->photo }}">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <div class="col-lg-12">
                                  <div class="col-md-5 col-sm-5 col-xs-5 col-md-offset-10">
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                    <button class="btn btn-default"><a href="{{ route('profile.get') }}">Cancelar</a></button>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
                </div><!-- col-lg-12-->  

            </div><!-- /row -->
    </div><!-- /content-panel -->
</div><!-- /col-md-12 --> 
<!-- /MAIN CONTENT -->
</section>
@endsection