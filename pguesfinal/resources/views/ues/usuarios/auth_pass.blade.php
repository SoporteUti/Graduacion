
<div class="modal fade" id="modal-auth-pass">
  <div class="modal-dialog">
    <div class="modal-content">
      {!! Form::open(['rol'=>'form','route' => ['ues.usuarios.update',Auth::user()->id], 'method' => 'PUT','files'=>true, 'class' => 'form-horizontal']) !!}
      <div class="modal-header" style="background:#00a65a; color:white">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modificar Credenciales</h4>
      </div>
      <div class="modal-body">
       <div class="box-body">
        <div class="form-group">
         <label>Nombre de usuario</label> 
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" required="" class="form-control" name="usuario" id="usuario" value="{{ Auth::user()->name}}">
                </div> 
        </div>
   <div class="form-group">
         <label>Contraseña Actual</label> 
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" required="" class="form-control" name="passa" id="passa" value="">
                </div> 
        </div>

        <div class="form-group">
         <label>Nueva Contraseña</label> 
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" required="" class="form-control" name="pass" id="pass" value="">
                </div> 
        </div>
           <div class="form-group">
         <label>Confirme Contraseña</label> 
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" required="" onkeyup="comprobarClave()" class="form-control" name="pass1" id="pass1" value="">
                </div> 
        </div>

      <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" disabled="" id="act" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar </button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<script type="text/javascript">
  
  
function comprobarClave(){
    clave1 = document.getElementById('pass').value;
    clave2 = document.getElementById('pass1').value;

    if (clave1 == clave2)
      document.getElementById('act').disabled=false;
  else
    document.getElementById('act').disabled=true;
}
</script>