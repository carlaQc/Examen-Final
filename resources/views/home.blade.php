@extends('layouts.app')
@section('content')
<div class="col-lg-12 main-chart">   
    <div class="row mt">
      @foreach ($promotion as $promotion)
        <div class="col-md-4 mb">
            <!-- WHITE PANEL - TOP USER -->
            <div class="white-panel pn">
                <div class="white-header">
                    <h5>{{ $promotion->activity }} <strong>{{ $promotion->name_center }}</strong></h5>
                </div>
                <p><img src="../../../../center/{{ $promotion->photo }}" class="img-circle" width="80"></p>
                <p><b>{{ $promotion->description_promotion }}</b></p>
                <div class="row">
                    <div class="col-md-6">
                        <p class="small mt">Tel / Cel</p>
                        <p>{{ $promotion->cellphone }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="small mt">Direccion</p>
                        <p>{{ $promotion->address }}</p>
                    </div>
                </div>
            </div>
        </div><!-- /col-md-4  -->
      @endforeach
      

</div><!-- /col-lg-9 END SECTION MIDDLE -->    
@endsection
