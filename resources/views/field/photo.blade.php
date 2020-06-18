@extends('layouts.app')
@section('content')
<section class="wrapper">
<!--main content start-->
{{-- <h3><i class="fa fa-angle-right"></i>Centro deportivo</h3> --}}

<div class="col-md-12">
        <h3><i class="fa fa-angle-right"></i>Galeria Cancha</h3>
        <hr>

        <form data-parsley-validate class="form-horizontal style-form" action="{{ route('fieldPhotos.store',Crypt::encrypt($field_id)) }}" method="POST" enctype="multipart/form-data">
{{-- {{ $field_photo }} --}}
          @csrf
          <div class="form-panel">
            <div class="form-group">
                
                <label class="col-sm-2"><strong><h4>Agregar imagen: </h4></strong></label>
                <div class="col-sm-3">
                    <input class="form-control"  type="file" name="photo_description">
                </div>
                <div class="col-sm-4">
                      <button  type="submit" class="btn btn-success">Guardar</button>
                      <button  class="btn btn-default"><a href="{{ route('field.get') }}">Cancelar</a></button>
                </div>
                
            </div>
          </div>
        </form>
        @foreach ($field_photo as $photo)
         
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc center">
              <div class="project-wrapper ">
                  <div class="project ">
                    <br>
                      <div class="photo-wrapper ">
                          <div class="photo ">
                            <a class="fancybox" href="../../../../field/{{ $photo->photo_description }}"><img class="img-responsive " style="height: 30%" src="../../../../field/{{ $photo->photo_description }}" alt=""></a>
                          </div>
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