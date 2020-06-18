@extends('layouts.app')
@section('content')
<!--main content start-->
{{-- <h3><i class="fa fa-angle-right"></i>Centro deportivo</h3> --}}
<section class="wrapper">
<div class="col-md-12" >
        <h3><i class="fa fa-angle-right"></i>&nbsp;Canchas</h3>
        <hr>

        @foreach ($field as $fi)
         
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
              <div class="project-wrapper">
                  <div class="project">
                    <br>
                      <div class="photo-wrapper">
                          <div class="photo">
                            <h4 class="text center" style="text-align: center; color: black;">{{ $fi->name_field }}</h4>
                            <a class="fancybox" href=""><img class="img-responsive" style="height: 25%; display: block; margin: auto;" src="../../../field/{{ $fi->photo }}" alt=""></a>
                          </div>
                          <p><button><a id="edit" href=" {{ route('scheduleReserve.get',Crypt::encrypt($fi->field_id)) }}">Reservar Cancha</a></button></p>
                          <div class="overlay"></div>
                      </div>
                  </div>
              </div>
            </div><!-- col-lg-4 -->

        @endforeach
        
        {{-- <button href="{{ route('fieldPhotos.store',$field_photo->first()->field_id) }}" class="" type="fyle">agregar</button> --}}
        


</div><!-- /col-md-12 --> 
<!-- /MAIN CONTENT -->
</section>

@endsection
<script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
  
  <script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>
  
  <script>
      //custom select box

      $(function(){
          $("select.styled").customSelect();
      });

  </script>
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

      margin-top: 100px;
    }

    button {
      border: none;
      outline: 0;
      display: inline-block;
      padding: 8px;
      color: white;
      background-color: black;
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