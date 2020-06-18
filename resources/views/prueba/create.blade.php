@extends('layouts.app')
@section('content')
<section class="wrapper">
<h3><i class="fa fa-angle-right"></i> <strong>Reserva</strong> </h3>
<div style="margin-bottom: 10px;">
    <a href="{{ route('scheduleReserve.get', Crypt::encrypt($field->field_id)) }}" style="color:gray; text-decoration: none;">
       Horario
    </a> /
    <strong>Nueva reserva</strong>
</div><br>

<div class="row">
    <div class="col-lg-12">
        <div class="form-panel">
            <form data-parsley-validate class="form-horizontal style-form formi" action="{{ route('scheduleReserve.store',[Crypt::encrypt($field->field_id),Crypt::encrypt( Auth::user()->rol_id), Crypt::encrypt($day), Crypt::encrypt($hour)]) }}" method="POST">
            @csrf

                <div class="form-group">
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Nombre de reserva:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" id="name_reservation" name="name_reservation" placeholder="Ingrese nombre" value="{{ old('name') }}">
                        @if($errors->has('name_reservation'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('name_reservation') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Campo:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input readonly="readonly" class="form-control" type="text" name="name_field" value="{{ $field->name_field }}">
                    </div>
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Centro deportivo:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input readonly="readonly" class="form-control"  type="text" name="name_center" value="{{ $data->name_center }}">
                    </div>
                </div>
                  
                <div class="form-group">
                    @if(Auth::user()->rol_id == 2 || Auth::user()->rol_id == 3)
                        <label class="col-lg-1 control-label">
                            <span class="req">*</span>
                            <strong>Tipo de pago:</strong>
                        </label>
                        <div class="col-lg-3">
                            <select id="payment" name="state_payment_id" data-id="{{ $field->field_id }}"  class="form-control">
                                <option value=""> Seleccione tipo de pago </option>
                                <option value="2"> Pago anticipado </option>
                                <option value="3"> Pago Total</option>
                            </select>
                            <div id="test" class="text-danger"></div>
                        </div>
                    @endif
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Pago:</strong>
                    </label>
                    <div class="col-lg-3">
                        @if(Auth::user()->rol_id == 4)
                            <input type="number" id="type_payment" readonly="readonly"  class="form-control" name="payment" value="0">
                        @else
                            <input type="number" id="type_payment"  class="form-control" name="payment" required placeholder="Ingrese el monto">
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Fecha actual:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input readonly="readonly" class="form-control"  type="text" name="current_date" value="{{ $current_date }}">
                    </div>
                </div>
                  
                <div class="form-group">
                    <label class="col-lg-1 control-label">
                        <h6><span class="req">*</span>
                        <strong>Hora inicio:</strong></h6>   
                    </label>
                    <div class="col-lg-3 ">
                        <input readonly="readonly" type="text"  class="form-control" name="start_date" value="{{ $start_date }}">
                    </div>
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Hora fin:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input readonly="readonly" class="form-control"  type="text" name="end_date" value="{{ $end_date }}">
                    </div>
                </div>
                <div class="form">
                  <div class="col-lg-offset-10">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a style="color:black;" href="{{ route('scheduleReserve.get', Crypt::encrypt($field->field_id)) }}">
                        <button type="button" class="btn btn-default">
                            Cancelar
                        </button>
                    </a>
                  </div>
                </div>

            </form>
        </div>
    </div>
</div>
</section>
@endsection

@section('script')
    <script>
        var cl = 0;
        var p = 0;
        $('#payment').on('click', function(){
            if(cl == 0){
                cl += 1;
            }else{
                let field = $(this).data('id');
                p = $('#payment').val();

                if(p == ''){
                
                    $('#test').text("Seleccionar un tipo de pago.");
                    $('#type_payment').removeAttr('readonly'); 
                    $('#type_payment').val(''); 
                
                }else if(p == 2){

                    $('#type_payment').removeAttr('readonly');
                    $('#type_payment').val('');
                    $('#test').text("");                    
                
                }else if(p == 3){
                
                    $.ajax({
                        url: "{{ route('payment.get', $field) }}",
                        headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                        method:  "GET",
                        success: function(data){
                            $('#type_payment').val(data.data.price);
                            $('#type_payment').attr('readonly','readonly');
                            $('#test').text("");
                        }
                    });
                
                }
                cl = 0;
            }
        });
    </script>
@endsection