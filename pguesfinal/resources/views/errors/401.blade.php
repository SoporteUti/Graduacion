@extends('layouts.errors')

@section('htmlheader_title')
Error 401 - Sin autorizaciòn
@endsection

@section('main-content')
<h1>401 Sin Autorizaciòn</h1>
<p class="zoom-area">No tienes los suficientes <b>privilegios</b> para realizar esta acciòn. </p>
<section class="error-container">
  <span><span>4</span></span>
  <span>0</span>
  <span><span>1</span></span>
</section>
@endsection