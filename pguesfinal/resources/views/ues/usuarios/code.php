

       <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover" id="usuarios">
          <thead><!--fila-->
            <th hidden=""></th><!--celda-->
            <th></th>
                        <th>Rol</th>      
                        <th>Carrera</th>
                        
                        <th>Opciones</th><!--celda-->           
          </thead>
          @foreach($rol_carrera as $rca)
           @if($rca->iddocente== $doc->iddocente)
          <tr>
            <td></td>
            <td hidden="">{{ $rca->iddocente }}</td>

                       

                   
                        <td>{{ $rca->idrol }}</td>
                      <td>{{ $rca->idcarrera }}</td>
           

                       
            <td>
 
@if($rca->idcarrera)
                        <a href="" data-target="#modal-edit-{{$doc->iddocente}}" data-toggle="modal">
                        <button class="btn btn-info"><i class="fa fa-plus"></i></button></a>
                       <a href="" data-target="#modal-ver-{{$doc->iddocente}}" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        
@else
                        <a href=""  data-target="" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        


    @endif        

             
                                                  

            </td><!--celda-->
          </tr>
            @endif     
          @endforeach
        </table>

 
   
  </div>