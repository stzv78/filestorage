@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    @include ('flashes')

                    <div class="panel-heading">
                        @if(!isset($file))
                            Загрузка файла:
                        @else
                            Редактирование файла:
                        @endif
                    </div>

                    <div class="panel-body">

                        @if(isset($file))
                            <form class="form-horizontal" method="POST" action="{{ route('file.update', ['file' => $file]) }}">
                        @else
                            <form class="form-horizontal" method="POST" action="{{ route('file.store') }}" enctype="multipart/form-data">
                        @endif

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="file" class="col-md-4 control-label">
                                @if(!isset($file))
                                    Выберите файл:
                                @else
                                    Файл:
                                @endif
                            </label>

                            <div class="col-md-8">
                                @if(isset($file))
                                    <h5>{{ $file->hash_file }}</h5>
                                @else
                                    <input id="file" type="file" class="form-control" name="file" value="" required autofocus>
                                @endif

                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Описание файла:</label>

                            <div class="col-md-8">
                                <textarea id="description" class="form-control" name="description"
                                          value="" required>{{ isset($file->description) ?  $file->description : '' }}
                                </textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif

                            </div>
                        </div>

                        @empty($file)
                            <div class="form-group">
                                <label for="userEmail" class="col-md-4 control-label">Ваш e-mail:</label>

                                <div class="col-md-8">
                                    <input id="userEmail" type="email" class="form-control" name="userEmail"
                                           value="{{ old('userEmail') or '' }}" required>

                                    @if ($errors->has('userEmail'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('userEmail') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                        @endempty


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                @isset($file){{ method_field('PUT') }}@endisset
                                <button type="submit" class="btn btn-primary">
                                    Отправить
                                </button>
                                <a class="btn btn-link" href="{{ route('file.index') }}" class="cancel">Отменить</a>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection