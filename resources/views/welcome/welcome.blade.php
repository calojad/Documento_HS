@extends('layouts.app')
@section('style')
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 77vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            margin-bottom: 30px;
            color: #00517e;
        }
    </style>
@endsection
@section('content')
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md" align="center">
                    <h1>Sistema de generacion del<br>REGLAMENTO INTERNO DE<br>HIGIENE y SEGURIDAD</h1>
                </div>
            </div>
        </div>
@endsection