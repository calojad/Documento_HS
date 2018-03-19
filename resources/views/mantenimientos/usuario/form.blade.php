@extends('layouts.mante')
@section('content')
    <div class="row"></div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{$titulo}}
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12 form-horizontal">
                {!! Form::model($usuario, array('method'=>'post','class'=>'row-border','enctype'=>'multipart/form-data')) !!}
                <div class="form-group">
                    <label class="col-md-2 control-label">* Nombre:</label>
                    <div class="col-md-7">
                        <input name="name" class="form-control" type="text" value="{{$usuario->name == null?old('name'):$usuario->name}}" title="Nombre" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">* Email:</label>
                    <div class="col-md-7">
                        <input name="email" title="Email" class="form-control" type="email" value="{{$usuario->email == null?old('email'):$usuario->email}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">* Estado:</label>
                    <div class="col-md-7">
                        {!! Form::select('estado',[1=>'Activo',2=>'Inactivo'],$usuario->estado,['required'=>'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">* Role:</label>
                    <div class="col-md-7">
                        {!! Form::select('role',[1=>'Administrador',2=>'Usuario'],$usuario->role,['required'=>'required']) !!}
                    </div>
                </div>
                <div class="form-group{{ $errors->has('contraseña') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">Contraseña:</label>
                    <div class="col-md-7">
                        <input name="contraseña" title="Contraseña" type="password">
                        @if ($errors->has('contraseña'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contraseña') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Confirmar Contraseña:</label>
                    <div class="col-md-7">
                        <input name="contraseña_confirmation" title="Contraseña" type="password">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit">Guardar</button>
                <a href="{{URL::to('mantenimiento/usuarios')}}" class="btn btn-default pull-left">Regresar</a>
            </div>
                {!! Form::close() !!}
        </div>
    </div>
@endsection