@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    @include ('flashes')

                    <div class="panel-heading">Добро пожаловать, Администратор!</div>

                    <div class="panel-body">
                        <div class="panel-body">
                            <li><a href="{{ route('file.create') }}" class="cancel">Загрузить файл >></a>
                            <li><a href="{{ route('file.index') }}" class="cancel">Работать с файлами >></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection