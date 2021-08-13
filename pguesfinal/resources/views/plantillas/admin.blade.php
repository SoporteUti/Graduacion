<!DOCTYPE html>
<html lang="es">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>APGUES</title>
 <!-- Tell the browser to be responsive to screen width -->
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <meta name="csrf-token" content="{{ csrf_token() }}">


 <!-- Bootstrap 3.3.5 -->
 <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
 <!-- Font Awesome -->
 <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
 <!-- Theme style -->
 <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
     <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">

     
     <link rel="shortcut icon" href="{{asset('img/ic_launcher48.png')}}">

     <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.min.css')}}"/>

     <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrapValidator.css')}}"/>

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet"  href="{{asset('/plugins/chosen/chosen.css')}}"> 



     <link rel="stylesheet"  href="{{asset('/plugins/toast/toastr.css')}}"> 

     <link rel="stylesheet" href="{{asset('plugins/bsdatepicker/css/bootstrap-datetimepicker.min.css')}}">
     <link rel="stylesheet" type="text/css" href="{{asset('css/darkgantt.css')}}"/> 

     <script src="https://unpkg.com/tippy.js@3/dist/tippy.all.min.js"></script>

     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

<style type="text/css">
  .user-image {
    float: left;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    margin-right: 10px;
    margin-top: -2px;
}


.image-circle {
    border-radius: 50%;
    width: 50px;
    height: 50px;
}

.datos {
        display: block;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;

}

.perfil{
z-index: 5;
border-radius: 50%;
    vertical-align: middle;
    height: 90px;
    width: 90px;
    border: 3px solid;
    border-color: transparent;
    border-color: rgba(255,255,255,0.2);
}



</style>


    <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">

        <header class="main-header">
          <!-- Logo -->
          <a href="{{url('')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <!-- <span class="logo-mini"><b>A</b>LT</span> -->
            <!-- logo for regular state and mobile devices -->

            <span class="logo-mini">
              <img src="{{asset('img/logo2.png')}}" class="img-responsive" style="width: 98%">
            </span>

            <span class="logo-lg" 2018>
              <img src="{{asset('img/pgues.png')}}" class="img-responsive">
            </span>
          </a>


          <!-- Header Navbar: style can be found in header.less -->
          <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
              <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                <li >
                  <div id="app">
                    <notification :userid="{{auth()->id()}}" class="notifications-menu"></notification>
                  </div>
                </li>
                <!-- Messages: style can be found in dropdown.less-->
               

               
                <li class="dropdown user user-menu" id="user_menu">
                  <!-- Menu Toggle Button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                     
                      <img src="{{ asset(Auth::user()->persona->foto_asset) }}" class="user-image" /> 

                     
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <!--   <span class="hidden-xs">{{ Auth::user()->name }}</span> -->
                   <span class="hidden-xs">{{ Auth::user()->name }} 

                    @if(Auth::user()->idrol==1)

                      (Administrador)
                      @else
                        @if(Auth::user()->idrol==2)
                          (Jefe Departamento)
                              @else
                                @if(Auth::user()->idrol==3)
                                    (Coordinador General)
                                      @else
                                          @if(Auth::user()->idrol==4)
                                            (Director General)
                                              @else
                                                 @if(Auth::user()->idrol==5)
                                                    (Asesor)
                                                        @if(Auth::user()->idrol==6)
                                                            (Estudiante)
                     @endif
                     @endif
                     @endif
                     @endif
                     @endif
                     @endif
                     </span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- The user image in the menu -->
                    <li class="user-header">
                      {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" /> --}}
                      <p>
                       
                      <img src="{{ asset(Auth::user()->persona->foto_asset) }}"  class="perfil"  /> 

                      
                      <p class="datos">
                         @if(Auth::user()->idrol==1)

                      {{ Auth::user()->name }} - Administrador
                      @else
                        @if(Auth::user()->idrol==2)
                          {{ Auth::user()->name }} - Jefe Departamento
                              @else
                                @if(Auth::user()->idrol==3)
                                    {{ Auth::user()->name }} - Coordinador General
                                      @else
                                          @if(Auth::user()->idrol==4)
                                            {{ Auth::user()->name }} - Director General
                                              @else
                                                 @if(Auth::user()->idrol==5)
                                                    {{ Auth::user()->name }} - Asesor
                                                        @if(Auth::user()->idrol==6)
                                                            {{ Auth::user()->name }} - Estudiante
                     @endif
                     @endif
                     @endif
                     @endif
                     @endif
                     @endif 
                     </p>

                                     {{--  @foreach($roles as $rol)
                                          @if(Auth::user()->idrol==$rol->idrol)
                                          {{$rol->name}}
                                          @endif
                                          @endforeach --}}

                                        </p>

                                      </li>
                                      <!-- Menu Body -->
                            {{-- <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">friends</a>
                                </div>
                              </li> --}}
                              <!-- Menu Footer-->
                              <li class="user-footer">
                                <div class="pull-left">
                                  <a class="btn btn-default btn-flat"  data-toggle="modal" href='#modal-auth-pass'>Perfil</a>
                                    <a href="#modelId"  class="btn btn-default btn-flat" data-toggle="modal" onclick="fill()" id="change_role" 
                                  >
                                  Roles</a>
                                </div>
                                <div class="pull-right">
                                  <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" id="logout"
                                  >
                                  Cerrar Sesi&oacute;n
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                                  <input type="submit" value="logout" style="display: none;">
                                </form>

                              </div>
                            </li>
                          </ul>
                        </li>

                        <!-- Control Sidebar Toggle Button -->
                        <li>
                          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                      </ul>
                    </div>
                  </nav>
                </header>
                <!-- Left side column. contains the logo and sidebar -->
                <aside class="main-sidebar">
                  <!-- sidebar: style can be found in sidebar.less -->
                  <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                      <li class="header"></li>


                      @if(Auth::check() && Auth::user()->idrol==1)
                      <li class="treeview">
                        <a href="#">
                          <i class="fa fa-institution"></i>
                          <span>Facultades</span>
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('ues/facultades') }}"><i class="fa fa-circle-o"></i> CRUD Facultades</a></li>
                        </ul>
                      </li>
                      @endif

                      @if(Auth::check() && Auth::user()->idrol==1)            
                      <li class="treeview">
                        <a href="#">
                          <i class="fa fa-sitemap"></i>
                          <span>Departamentos</span>
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('ues/departamentos')}}"><i class="fa fa-circle-o"></i> CRUD Departamentos</a></li>
                        </ul>
                      </li>
                      @endif

                      @if(Auth::check() && Auth::user()->idrol==1)
                      <li class="treeview">
                        <a href="#">
                          <i class="fa fa-graduation-cap"></i>
                          <span>Carreras</span>
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('ues/carreras') }}"><i class="fa fa-circle-o"></i> CRUD de Carreras</a></li>

                        </ul>
                      </li>
                      @endif

                      @if(Auth::check() && Auth::user()->idrol==1)
                      <li class="treeview">
                        <a href="#">
                          <i class="fa fa-group"></i> <span>Docentes</span>
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('ues/docentes') }}"><i class="fa fa-circle-o"></i> CRUD de Docentes</a></li>

                        </ul>
                      </li>
                      @endif

                      @if(Auth::check() && Auth::user()->idrol==1 || Auth::user()->idrol==2 || Auth::user()->idrol==3)
                      <li class="treeview">
                        <a href="#">
                          <i class="fa fa-group"></i>
                          <span>Estudiantes</span>
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('ues/estudiantes') }}"><i class="fa fa-circle-o"></i> CRUD de Estudiantes</a></li>
                          <li><a href="{{ url('ues/estudiantesPera') }}"><i class="fa fa-circle-o"></i> Estudiantes en P.E.R.A</a></li>
                          <li><a href="{{ url('ues/estudiantesHS') }}"><i class="fa fa-circle-o"></i> Estudiantes en 
                                    <br>Servicio Social</a></li>
                        </ul>
                      </li>
                      @endif

                      @if(Auth::check() && Auth::user()->idrol==1)
                      <li class="treeview">
                        <a href="#">
                          <i class="fa fa-group"></i>
                          <span>Usuarios</span>
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('ues/usuarios') }}"><i class="fa fa-circle-o"></i>CRUD Usuarios</a></li>

                        </ul>
                      </li>
                      @endif


                      @if(Auth::check() && Auth::user()->idrol==1 || Auth::user()->idrol==2 || Auth::user()->idrol==3 || Auth::user()->idrol==5 || Auth::user()->idrol==4)
                      <li class="treeview">
                        <a href="#">
                          <i class="fa fa-group"></i>
                          <span>Grupos</span>
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('ues/grupos') }}"><i class="fa fa-circle-o"></i> CRUD de Grupos</a></li>
                          <li><a href="{{ url('ues/gruposoff') }}"><i class="fa fa-circle-o"></i> Grupos Finalizados</a></li>
                        </ul>
                      </li>
                      @endif

                      @if(Auth::check() && Auth::user()->idrol==1)
                      <li class="treeview">
                        <a href="#">
                          <i class="fa fa-cogs"></i>
                          <span>Configuraciones</span>
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                        
                        <li><a href="{{ url('ues/tipoTemas') }}"><i class="fa fa-circle-o"></i> Tipos de Procesos de Grado</a></li>
                        <li><a href="{{ url('ues/tipoAsesores') }}"><i class="fa fa-circle-o"></i> Tipos de Asesores</a></li>
                        <li><a href="{{ url('ues/categorias') }}"><i class="fa fa-circle-o"></i> Categor&iacute;as<!--</a></li><li><a href="{{ url('ues/etapas') }}"><i class="fa fa-circle-o"></i> Etapas</a></li>-->
                      </li><li><a href="{{ url('ues/nuevaetapa') }}"><i class="fa fa-circle-o"></i> Etapas</a></li>
                      </li><li><a href="{{ url('ues/solis') }}"><i class="fa fa-circle-o"></i> Solicitudes</a></li>
                    </ul>
                  </li>
                  @endif

                  @if(Auth::check() && Auth::user()->idrol==1)
                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-group"></i> <span>Seguridad</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="{{ url('ues/seguridad/bitacora') }}"><i class="fa fa-lock"></i> Bit&aacute;cora</a></li>

                    </ul>
                       <ul class="treeview-menu">
                <li><a href="{{ url('ues/backups') }}"><i class="fa fa-circle-o"></i>Respaldo</a></li>
                    
              </ul>
                  </li>
                  @endif

           {{--  @if(Auth::check() && Auth::user()->idrol==1 || Auth::user()->idrol==2 || Auth::user()->idrol==3 || Auth::user()->idrol==4 || Auth::user()->idrol==5 || Auth::user()->idrol==6)
             <li class="treeview">
              <a href="#">
                <i class="fa fa-group"></i>
                <span>Solicitudes</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('ues/solicitudes') }}"><i class="fa fa-circle-o"></i> Solicitudes</a></li>
                    
              </ul>
            </li>
            @endif

            --}}
@if(Auth::check() &&  Auth::user()->idrol==6)
                <li class="treeview">
              <a href="#">
                <i class="fa fa-group"></i>
                <span>Estudiante</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('ues/estudiantes/stepsEst',Auth::user()->idpersona )  }}"><i class="fa fa-circle-o"></i>Datos del Estudiante</a></li>
              </ul>
               <ul class="treeview-menu">
                <li><a href="{{ url('ues/estudiantes/stepsEstUpdate',Auth::user()->idpersona )  }}"><i class="fa fa-circle-o"></i>Actualizar Datos</a></li>
              </ul>
            </li>
            <li class="treeview">
                        <a href="#">
                          <i class="fa fa-group"></i>
                          <span>Grupos</span>
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('ues/grupos') }}"><i class="fa fa-circle-o"></i> CRUD de Grupos</a></li>
                        </ul>
                      </li>
             @endif

            
             @if(Auth::check() && Auth::user()->idrol==1 || Auth::user()->idrol==2 || Auth::user()->idrol==3 || Auth::user()->idrol==4 || Auth::user()->idrol==5 || Auth::user()->idrol==6)
          <li>
              
              <a href="{{ url('ues/actividades') }}"><i class="fa fa-info-circle"></i><small class="label  bg-yellow">Acerca De...</small> </a>
              
           
          </li>
          @endif
          
           <li>
              
              <a target="_blank" href="{{ url('img/M_U.pdf') }}"><i class="fa fa-question-circle"></i><small class="label  bg-light-blue">Ayuda.</small> </a>
          </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <h4 class="control-sidebar-heading">Opciones de Dise&ntilde;o</h4>


        <div class="form-group"><label class="control-sidebar-subheading">
          <input type="checkbox" data-sidebarskin="toggle" class="pull-right"> Cambiar la Barra de M&aacute;scaras</label>
          <p>Alternar entre m&aacute;scaras oscuras y claras para la barra lateral derecha</p>
        </div>


        <h4 class="control-sidebar-heading">M&aacute;scaras</h4>
        <ul class="list-unstyled clearfix">

          <li style="float:left; width: 33.33333%; padding: 5px;">
           <a href="javascript:void(0);" data-skin="skin-blue" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
            <div>
              <span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9;">
              </span>
              <span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;">
              </span>
            </div>
            <div>
              <span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;">
              </span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;">
              </span>
            </div>
          </a>
          <p class="text-center no-margin">Azul</p>
        </li>
        <li style="float:left; width: 33.33333%; padding: 5px;">
          <a href="javascript:void(0);" data-skin="skin-black" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
            <div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"> 
              <span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe;">
              </span>
              <span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe;"> 
              </span>
            </div>
            <div><span style="display:block; width: 20%; float: left; height: 20px; background: #222;">
            </span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;">
            </span></div></a><p class="text-center no-margin">Negro</p>
          </li><li style="float:left; width: 33.33333%; padding: 5px;">
            <a href="javascript:void(0);" data-skin="skin-purple" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
              <div>
                <span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active">
                </span>
                <span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;">
                </span>
              </div>
              <div>
                <span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;">
                </span>
                <span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;">
                </span>
              </div>
            </a>
            <p class="text-center no-margin">P&uacute;rpura</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
            <a href="javascript:void(0);" data-skin="skin-green" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
              <div>
                <span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active">
                </span>
                <span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;">
                </span>
              </div>
              <div>
                <span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;">
                </span>
                <span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;">
                </span>
              </div>
            </a>
            <p class="text-center no-margin">Verde</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
            <a href="javascript:void(0);" data-skin="skin-red" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
              <div>
                <span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active">
                </span>
                <span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;">
                </span>
              </div>
              <div>
                <span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;">
                </span>
                <span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;">
                </span>
              </div>
            </a>
            <p class="text-center no-margin">Rojo</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
            <a href="javascript:void(0);" data-skin="skin-yellow" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
              <div>
                <span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active">
                </span>
                <span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;">
                </span>
              </div>
              <div>
                <span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;">
                </span>
                <span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;">
                </span>
              </div>
            </a>
            <p class="text-center no-margin">Amarrillo</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
            <a href="javascript:void(0);" data-skin="skin-blue-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
              <div>
                <span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9;">
                </span>
                <span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;">
                </span>
              </div>
              <div>
                <span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;">
                </span>
                <span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;">
                </span>
              </div>
            </a>
            <p class="text-center no-margin" style="font-size: 12px">Azul Ligero</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
            <a href="javascript:void(0);" data-skin="skin-black-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
              <div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix">
                <span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe;">
                </span>
                <span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe;">
                </span>
              </div>
              <div>
                <span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;">
                </span>
                <span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;">
                </span>
              </div>
            </a>
            <p class="text-center no-margin" style="font-size: 12px">Negro Ligero</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
            <a href="javascript:void(0);" data-skin="skin-purple-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
              <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active">
              </span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;">
              </span>
            </div>
            <div>
              <span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;">
              </span>
              <span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;">
              </span>
            </div>
          </a>
          <p class="text-center no-margin" style="font-size: 12px">P&uacute;rpura Ligero</p>
        </li><li style="float:left; width: 33.33333%; padding: 5px;">
          <a href="javascript:void(0);" data-skin="skin-green-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
            <div>
              <span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active">
              </span>
              <span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;">
              </span>
            </div>
            <div>
              <span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;">
              </span>
              <span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;">
              </span>
            </div>
          </a>
          <p class="text-center no-margin" style="font-size: 12px">Verde Ligero</p>
        </li>
        <li style="float:left; width: 33.33333%; padding: 5px;">
          <a href="javascript:void(0);" data-skin="skin-red-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
            <div>
              <span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active">
              </span>
              <span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;">}
              </span>
            </div>
            <div>
              <span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;">
              </span>
              <span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;">
              </span>
            </div>
          </a>
          <p class="text-center no-margin" style="font-size: 12px">Rojo Ligero</p>
        </li>
        <li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0);" data-skin="skin-yellow-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
          <div>
            <span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active">
            </span>
            <span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;">
            </span>
          </div>
          <div>
            <span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;">
            </span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;">
            </span>
          </div>
        </a>
        <p class="text-center no-margin" style="font-size: 12px;">Amarrillo Ligero</p>
      </li>
    </ul>

    <!-- Tab panes -->
     <!--   <div class="tab-content">
          
          <div class="tab-pane" id="control-sidebar-home-tab">
    
            
           



          </div> -->

        </aside><!-- /.control-sidebar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

          <!-- Main content -->
          <section class="content">








            <div class="row">
              <div class="col-md-12">
                <div class="box">




                  <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>

                  {{-- --}}
                  <!--Contenido-->
                  @yield('contenido')
                  <!--Fin Contenido-->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      @include('ues.usuarios.auth_pass')
      @include('plantillas.access')

      <footer class="page-footer font-small special-color-dark pt-4" >
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="http://www.fmp.ues.edu.sv/">UES-FMP</a>.</strong> Todos los derechos reservados.
      </footer>

<script >

  function fill() {
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      var Data = {
          email: "{{ Auth::user()->email }}",
      };

      $.ajax({
          type:'POST',
          url:"{{ url('fill') }}",
          data:Data,
          dataType:'json',
          success:function (data) {
              $('#select-carrera').empty();
              $('#select-carrera').append('<option value="-99">[Seleccione una opci&oacute;n]</option>');
              for (var i = 0 ; i <= data['carreras'].length-1; i++) {
                  var carrera=data['carreras'][i];
                  $('#select-carrera').append('<option value="'+carrera.idcarrera+'">'+carrera.nombre+'</option>');
              }
          },error:function (data) {
            console.log('Error:', (data.responseText));
        }
    });
  }
  

  function fill_roles() {
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      var Data = {
          email: "{{ Auth::user()->email }}",
          idcarrera: $('#select-carrera option:selected').val(),
      };
      console.log(JSON.stringify(Data));
      $.ajax({
          type:'POST',
          url:"{{ url('fillroles') }}",
          data:Data,
          dataType:'json',
          success:function (data) {
              $('#select-rol').empty();
              
              for (var i = 0 ; i <= data['roles'].length-1; i++) {
                  var rol=data['roles'][i];
                  $('#select-rol').append('<option value="'+rol.idrol+'">'+rol.nombre+'</option>');
              }
              
          },error:function (data) {
            console.log('Error:', (data.responseText));
        }
    });
  }
    </script>


<script>
      $(document).ready(function() {
    $('#alumnos').DataTable({
    
    "language":{
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
}



        );
} );
    </script>

      <!-- AdminLTE App -->
      <!-- AdminLTE App -->
      <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
      <!-- Bootstrap 3.3.5 -->
      <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>


      <!-- AdminLTE App -->
      <script src="{{asset('js/app.js')}}"></script>
      <script src="{{asset('js/app.min.js')}}"></script>

      <script type="text/javascript" language="javascript" src="{{asset('js/bootstrapValidator.js')}}" > </script>
      <!-- jQuery UI 1.11.4 -->
      <script src="{{asset('plugins\jQueryUI/jquery-ui.min.js')}}"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
        $.widget.bridge('uibutton', $.ui.button);
      </script>
      <!-- Morris.js charts -->
      <script src="{{asset('plugins/raphael-min.js')}}"></script>
      <script src="{{asset('plugins/morris/morris.min.js')}}"></script>
      <!-- Sparkline -->
      <script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
      <!-- jvectormap -->
      <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
      <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
      <!-- jQuery Knob Chart -->
      <script src="{{asset('plugins/knob/jquery.knob.js')}}"></script>
      <!-- daterangepicker -->
      <script src="{{asset('plugins/moment-with-locales.js')}}"></script>
      <script src="{{asset('plugins/bsdatepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
      <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
      <!-- datepicker -->
      <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
      <script src="{{asset('plugins/jQueryUI/jquery-ui.js')}}"></script>
      <!-- Bootstrap WYSIHTML5 -->
      <script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
      <!-- Slimscroll -->
      <script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
      <!-- FastClick -->
      <script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>



      <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

      <script type="text/javascript" language="javascript" src="{{asset('js/bootbox.min.js')}}" > </script>
      <script type="text/javascript" language="javascript" src="{{asset('js/bootstrapValidator.js')}}" > </script>

      <script type="text/javascript" language="javascript" src="{{asset('js/jquery.dataTables.min.js')}}" > </script>
      <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}" > </script>
      <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}" > </script>
      <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.responsive.min.js')}}" > </script>



      <script src="{{asset('plugins/chosen/chosen.jquery.js')}}"></script>

      <script src="{{asset('plugins/toast/toastr.min.js')}}"></script>



      <script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
      <script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
      <script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
      <script src="{{asset('plugins/plantilla.js')}}"></script> 

      <script src="{{asset('dist/js/demo.js')}}"></script>

      <script type="text/javascript">
        $(function () {
          $('.datepicker').datetimepicker({
            format: 'LT'
          });
          $('.datetimepicker').datetimepicker({
            locale: 'es',
            format: 'L',
          });
        });
      </script>
      <script type="text/javascript">
        $(function () {
          });
      </script>


      <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>
<script>
        $(function () {

            $('#start').datetimepicker({
                format: 'LT',
                date: moment()
            });

            $('#end').datetimepicker({
                format: 'LT',
                useCurrent: false,
                date: moment().add(1, 'hours')
            });

            $("#start").on("dp.change", function (e) {
                // console.log(e.date._i);
                e.target.value = e.date;
                //$('#end').data("DateTimePicker").minDate(e.date);
                //time_range(e.target.id,e.target.dataset.hours);

            });

            $("#end").on("dp.change", function (e) {
                // console.log(e);
                e.target.value = e.date;
                //$('#start').data("DateTimePicker").maxDate(e.date);
            });


            /////////////////////////////////////////////////////////////////////////////

            $('#formAsistencia').validator({
                custom: {
                    'date_range': function (el) {
                        /* if ($el.val() != $el.target.dataset.date_range) {
                            return true;
                        } */
                        // console.log(el.val());
                        let val1 = el.val();
                        let val2 = $('#' + el.data("date_range")).val();
                        $('#' + el.data("date_range")).focus();
                        if (el.data("date_range") == "start_hour") {
                            let tmp = val2;

                            val2 = val1;
                            val1 = tmp;
                        }
                        let time1 = new Date(new Date().toDateString() + " " + val1 + ":00");
                        let time2 = new Date(new Date().toDateString() + " " + val2 + ":00");
                        console.log('date1' + time1);
                        console.log('date2' + time2);
                        let diff = diff_hours(time1, time2);
                        let msg = (el.data("date_range") != "start_hour") ? "La hora de inicio debe ser antes de la hora de finalizacion" : "La hora de finalizacion debe ser despues de la hora de inicio"
                        return (diff <= 0) ? msg : "";
                    }
                },
                errors: {
                    date_range: "Please choose an option"
                }
            });
        });
        function diff_hours(date_start, date_end) {
            var diff = (date_end.getTime() - date_start.getTime()) / 1000;
            diff /= (60 * 60);
            return (Math.round(diff));
        }
    </script>

     
      @yield('script')

    </body>
    </html>
