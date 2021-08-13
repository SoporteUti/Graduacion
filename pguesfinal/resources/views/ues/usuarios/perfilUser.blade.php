<link rel="stylesheet" href="css/bootstrap.min.css">
<style type="text/css">
body center h5 {
	font-weight: bold;
	font-size: 18px;
}
body center h4 {
	font-weight: bold;
	font-size: 20px;
}
body table tr {
	text-align: justify;
}


</style>
<br>
<table width="90%" align="center" border="0" >
  
  <td rowspan="3"><center><img src="{{URL::asset('img/minerva2.png')}}"  width="100px" height="100px" align="center" ></img></center>
  </td>
  <td><center><h4><br>Universidad de El Salvador<br>Facultad Multidisciplinaria Paracentral </h4> </center></td>
  <td rowspan="3"><center><img src="{{URL::asset('img/logo1.png')}}"  width="150px" height="100px"  align="center"></img>  </center></td>
  <tr>
  	<th><center><h5>Roles de Usuario</h5></center></th>
  </tr>
</table>
<br><br><br>
<table width="90%" align="center" border="0" cellpadding="10" style="border: blue 2px solid;">
   

  <tr >
    <th  bgcolor="#FFFFFF" scope="col"><label class="control-label">Nombres Completo: </label></th>
    <td ></td>
   
  </tr>
  <table name="tblRoledit" id="tblRoledit" class="table table-hover"  width="90%" align="center" border="0" cellpadding="10" style="border: blue 2px solid;">
            <thead>
                <th>Roles</th>
                <th></th>
            </thead>
            <tbody id="rol-list-show">
            </tbody>
          </table>
 
  
</table>
 @foreach($carreras as $car)
  @if($car->idcarrera==Auth::user()->idcarrera)
<p style=" border-bottom-color:#FF0000; border-bottom-style:dashed; border-bottom-width:2px; border-top-color:#000099; border-top-style:solid; border-top-width:1px;" align="center">  </p>
@endif
@endforeach
            
    