@extends('layouts.app')
@section('content')
<!--main content start-->
    
    <section class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="form-panel">
                <div  class="tab-content no-border padding-24">
                <div id="home" class="tab-pane in active">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 center">
                            <span class="profile-picture">
                                <img class="editable img-responsive" alt=" Avatar" id="avatar2" src="../../../profile/{{ $profile->photo }}" style="height: 25%; display: block; margin: auto;">
                            </span>

                            <div class="space space-4"></div>

                            <a href="{{ route('profile.edit',Crypt::encrypt($profile->id)) }}" class="btn btn-sm btn-block btn-success">
                                <i class="ace-icon fa fa-plus-circle bigger-120"></i>
                                <span class="bigger-110">Editar</span>
                            </a>

                            
                        </div><!-- /.col -->

                        <div class="col-xs-12 col-sm-9">
                            <h4 class="blue">
                                @if($profile->rol_id == 1)
                                <span class="middle">Super Administrador</span>
                                @endif
                                @if($profile->rol_id == 2)
                                <span class="middle">Administrador</span>
                                @endif
                                @if($profile->rol_id == 3)
                                <span class="middle">Empleado</span>
                                @endif
                                @if($profile->rol_id == 4)
                                <span class="middle">Usuario</span>
                                @endif
                            </h4>

                            <div class="profile-user-info">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Nombre </div>

                                    <div class="profile-info-value">
                                        <span>{{ $profile->name }}&nbsp;{{ $profile->paternal }}&nbsp;{{ $profile->maternal }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Ubicacion </div>

                                    <div class="profile-info-value">
                                        <i class="fa fa-map-marker light-orange bigger-110"></i>
                                        <span>{{ $profile->address }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Email </div>

                                    <div class="profile-info-value">
                                        <span>{{ $profile->email }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Tel / Cel </div>

                                    <div class="profile-info-value">
                                        <span>{{ $profile->phone }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="hr hr-8 dotted"></div>

                        </div><!-- /.col -->
                    </div><!-- /.row -->
            </div>
        </div>
    </div>
    </section>
@endsection

<style>
    /*.card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      max-width: 300px;
      margin: auto;
      text-align: center;
      font-family: arial;
    }

    .title {
      color: grey;
      font-size: 18px;
    }
    #edit{
        color : #FFFFFF;
    }

    button {
      border: none;
      outline: 0;
      display: inline-block;
      padding: 8px;
      color: white;
      background-color: #000;
      text-align: center;
      cursor: pointer;
      width: 100%;
      font-size: 18px;
    }

    #link {
      text-decoration: none;
      font-size: 22px;
      color: black;
      text-align:center;
    }

button:hover, a:hover {
  opacity: 0.7;
}*/

.align-center, .center {
    text-align: center!important;
}

.profile-user-info {
    display: table;
    width: 98%;
    width: calc(100% - 24px);
    margin: 0 auto
}

.profile-info-row {
    display: table-row
}

.profile-info-name,
.profile-info-value {
    display: table-cell;
    border-top: 1px dotted #D5E4F1
}

.profile-info-name {
    text-align: right;
    padding: 6px 10px 6px 4px;
    font-weight: 400;
    color: #667E99;
    background-color: transparent;
    width: 110px;
    vertical-align: middle
}

.profile-info-value {
    padding: 6px 4px 6px 6px
}

.profile-info-value>span+span:before {
    display: inline;
    content: ",";
    margin-left: 1px;
    margin-right: 3px;
    color: #666;
    border-bottom: 1px solid #FFF
}

.profile-picture {
    border: 1px solid #CCC;
    background-color: #FFF;
    padding: 4px;
    display: inline-block;
    max-width: 100%;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    box-shadow: 1px 1px 1px rgba(0, 0, 0, .15)
}


</style>