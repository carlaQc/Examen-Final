@extends('layouts.app')
@section('content')
<!--main content start-->
<section class="wrapper">
    <div class="col-md-12">
        <h3><i class="fa fa-angle-right"></i>&nbsp;Centros Deportivos</h3>
          <hr>
          @foreach ($centers as $center)
              <div class="col-md-4">
                  <div class="form-panel">
                      <h2 style="text-align:center">{{ $center->activity }}</h2>

                      <div class="form-group">
                        <img class="center" src="../../center/{{ $center->photo }}" style="width:40%; margin-left: 150px;">
                        <h1 style="text-align:center">{{ $center->name_center }}</h1>
                        <p class="title" style="text-align:center">{{ $center->address }}&nbsp;&nbsp;<i class="fa fa-map-marker" ></i></p>
                        <p style="text-align:center"><i class="fa fa-phone" ></i>&nbsp;&nbsp;{{ $center->cellphone }}</p>
                        {{-- <div id="link" style="margin: 20px 0;">
                          <a id="link" href="#"><i class="fa fa-dribbble" ></i></a> 
                          <a id="link" href="#"><i class="fa fa-twitter"></i></a>  
                          <a id="link" href="#"><i class="fa fa-linkedin"></i></a>  
                          <a id="link" href="#"><i class="fa fa-facebook"></i></a> 
                        </div> --}}
                        <p><button><a id="edit" href="{{ route('fieldCenter.get',Crypt::encrypt($center->center_id)) }}">Canchas</a></button></p>
                        <p><button><a id="edit" href="{{ route('scheduleReserveAdmin.get',Crypt::encrypt($center->center_id)) }}">Reservas</a></button></p>
                      </div>
                  </div>
              </div>
          @endforeach
    </div>
   </section> 
    
@endsection

<style>
    .card {
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
      background-color: #50D4E3;
      text-align: center;
      cursor: pointer;
      width: 100%;
      font-size: 18px;
    }

    #link {
      text-decoration: none;
      font-size: 22px;
      color: #50D4E3;
      text-align:center;
    }

button:hover, a:hover {
  opacity: 0.7;
}


</style>