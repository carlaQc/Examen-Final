<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="modal-content" style="border: 0px;">
                <div class="modal-header" style="background-color: #1c2c42;">
                    <h5 class="modal-title" id="exampleModalLabel-2" style="color: white;">Restablecer la contraseña</h5>
                    <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="margin-left: 15px;">
                    <div class="form-group">
                        <p>Ingrese su dirección de correo electrónico a continuación para restablecer su contraseña.</p>
                        <label for="recipient-name" >Correo electronico:</label>
                        <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="@ correo electrónico" autocomplete="off" value="{{ old('email') }}" style="border-color: black;">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="background-color: #403969; border: 0px;">Enviar</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal" style="background-color: #693766;color: white; border: 0px;">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>



