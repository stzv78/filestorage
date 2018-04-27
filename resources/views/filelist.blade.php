@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    @include ('flashes')

                    <div class="panel-heading">Список файлов</div>

                    <div class="panel-body">
                        <div class="panel-body">
                            Всего файлов: <span class="badge">{{ count($files) }}</span>
                            <a class="btn btn-sm btn-success pull-right"
                               href="{{ route('file.create')}}">Добавить файл </a>
                        </div>

                        <table class="table table-condensed" style="font-size: 14px;">
                            <thead>
                            <th>Директория пользователя</th>
                            <th>Хэш файла</th>
                            <th>Описание файла</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @if (isset($files))
                                @foreach($files as $file)
                                    <tr>
                                        <td class="col-md-2"> {{ $file->hash_user }} </td>
                                        <td class="col-md-4"> {{ $file->hash_file }} </td>
                                        <td class="col-md-3"> {{ $file->description }} </td>

                                        <td style="text-align: center" class="col-sm-2" pull-right>
                                            <form method="POST"
                                                  action="{{ route ('file.destroy', ['file' => $file]) }}">
                                                <a class="btn btn-info "
                                                   href="{{ route('file.edit', ['file' => $file]) }}"><i
                                                            class="glyphicon glyphicon-pencil"></i></a>
                                                <input type="hidden" name="_method" value="delete"/>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <button type="submit" class="btn  btn-danger"><i
                                                            class="glyphicon glyphicon-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <h2> Нет файлов в хранилище</h2>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection