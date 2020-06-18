@extends('layouts.app')
@section('content')
<section class="wrapper">
    <!--main content start-->
    <h3><i class="fa fa-angle-right"></i> <strong>Reserva</strong> </h3>
    <div style="margin-bottom: 10px;">
        <a href="{{ route('scheduleReserve.get', Crypt::encrypt($data->field_id)) }}" style="color:gray; text-decoration: none;">
           Horario
        </a> /
        <strong>Detalle reserva 
            <strong style="color:blue;">{{ $data->reservation_state_id == 1 ? '(Habilitar)':''}}</strong>
            <strong style="color:red;">{{ $data->pending_debt > 0 && $data->reservation_state_id == 2 ? '(Pago anticipado)':'' }}</strong>
        </strong>
    </div><br>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-panel">
                <form data-parsley-validate class="form-horizontal style-form formi" action="{{ route('scheduleStateReservation.update',[Crypt::encrypt($data->reservation_id),Crypt::encrypt($data->field_id)]) }}"  method="post">
                @csrf
                @method('PUT')
                    @if(!empty($data->name))
                        <h4 class="mb"><i class="fa fa-angle-right"></i>  Cliente</h4>
                        <div class="form-group">
                            <label class="col-lg-1 control-label">
                                <strong>Nombre:</strong>
                            </label>
                            <div class="col-lg-3">
                                <input readonly="readonly" type="text" class="form-control " name="name" value="{{ $data->name }} {{ $data->paternal }} {{ $data->maternal }}">
                            </div>
                            <label class="col-lg-1 control-label">
                                <strong>Email:</strong>
                            </label>
                            <div class="col-lg-3">
                                <input readonly="readonly" class="form-control" type="text" name="email" value="{{ $data->email }}">
                            </div>
                            <label class="col-lg-1 control-label">
                                <strong>CI:</strong>
                            </label>
                            <div class="col-lg-3">
                                <input readonly="readonly" class="form-control"  type="text" name="ci" value="{{ $data->ci }}">
                            </div>
                        </div>
                    @endif
                    @if(!empty($data->name_admin))
                        <h4 class="mb"><i class="fa fa-angle-right"></i>  Administrador</h4>
                        <div class="form-group">
                            <label class="col-lg-1 control-label">
                                <strong>Nombre:</strong>
                            </label>
                            <div class="col-lg-3">
                                <input readonly="readonly" type="text" class="form-control " name="name" value="{{ $data->name_admin }} {{ $data->paternal_admin }} {{ $data->maternal_admin }}">
                            </div>
                            <label class="col-lg-1 control-label">
                                <strong>Email:</strong>
                            </label>
                            <div class="col-lg-3">
                                <input readonly="readonly" class="form-control" type="text" name="name_field" value="{{ $data->email_admin }}">
                            </div>
                        </div>
                    @endif
                    <h4 class="mb"><i class="fa fa-angle-right"></i>  Reserva</h4>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">
                            <strong>Nombre de reserva:</strong>
                        </label>
                        <div class="col-lg-3">
                            <input readonly="readonly" type="text" class="form-control" id="name_reservation" name="name_reservation" placeholder="Ingrese nombre" value="{{ $data->name_reservation }}">
                        </div>
                        <label class="col-lg-1 control-label">
                            <strong>Campo:</strong>
                        </label>
                        <div class="col-lg-3">
                            <input readonly="readonly" class="form-control" type="text" name="field_name" value="{{ $data->name_field }}">
                        </div>
                        <label class="col-lg-1 control-label">
                            <strong>Centro deportivo:</strong>
                        </label>
                        <div class="col-lg-3">
                            <input readonly="readonly" class="form-control"  type="text" name="name_center" value="{{ $data->name_center }}">
                        </div>
                    </div>
                      
                    <div class="form-group">
                        <label class="col-lg-1 control-label">
                            <strong>Fecha de reserva:</strong>
                        </label>
                        <div class="col-lg-3">
                            <input readonly="readonly" class="form-control"  type="text" name="current_date" value="{{ $data->current_date }}">
                        </div>
                        <label class="col-lg-1 control-label">
                            <strong>Hora inicio:</strong></h6>   
                        </label>
                        <div class="col-lg-3 ">
                            <input readonly="readonly" type="text"  class="form-control" name="start_date" value="{{ $data->start_date }}">
                        </div>
                        <label class="col-lg-1 control-label">
                            <strong>Hora fin:</strong>
                        </label>
                        <div class="col-lg-3">
                            <input readonly="readonly" class="form-control"  type="text" name="end_date" value="{{ $data->end_date }}">
                        </div>
                    </div>
                    <div class="form-group">
                        @if($data->reservation_state_id == 1 && Auth::user()->rol_id == 2 || Auth::user()->rol_id == 3)
                            <label class="col-lg-1 control-label">
                                <span class="req">*</span>
                                <strong>Tipo de pago:</strong>
                            </label>
                            <div class="col-lg-3">
                                <select id="payment" name="state_payment_id" data-id="{{ $data->field_id }}"  class="form-control">
                                    <option value=""> Seleccione tipo de pago </option>
                                    <option value="2"> Pago anticipado </option>
                                    <option value="3"> Pago Total</option>
                                </select>
                                <div id="test" class="text-danger"></div>
                            </div>
                        @endif
                        @if($data->reservation_state_id == 1)
                            <label class="col-lg-1 control-label">
                                <span class="req">*</span>
                                <strong>Pago:</strong>
                            </label>
                            <div class="col-lg-3">
                                <input type="number" id="type_payment"  class="form-control" name="payment" required placeholder="Ingrese el monto">
                            </div>
                        @endif
                        @if($data->pending_debt == 0 && $data->reservation_state_id == 2)
                            <label class="col-lg-1 control-label">
                                <strong>Pago total:</strong>
                            </label>
                            <div class="col-lg-3">
                                <input readonly="readonly" type="text" class="form-control " name="payment" value="{{ $data->payment }}">
                            </div>
                        @endif
                        @if($data->pending_debt > 0 && $data->reservation_state_id == 2)
                            <label class="col-lg-1 control-label">
                                <strong style="color: red;">Deuda total:</strong>
                            </label>
                            <div class="col-lg-3">
                                <input readonly="readonly" type="text" class="form-control" name="debt" value="{{ $data->pending_debt }}">
                            </div>
                        @endif

                    </div>
                    <div class="form">
                        <div class="col-lg-offset-{{ $data->reservation_state_id == 2 && $data->pending_debt == 0 ? '11':'10' }}">
                            @if($data->reservation_state_id == 1)
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            @endif
                            @if($data->pending_debt > 0 && $data->reservation_state_id == 2)
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            @endif

                            <a style="color:black;" href="{{ route('scheduleReserve.get', Crypt::encrypt($data->field_id)) }}">
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
                        url: "/payment-campos/"+field,
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
