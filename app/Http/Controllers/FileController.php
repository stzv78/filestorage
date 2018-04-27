<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\File;
use App\Models\Traits\FileTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Validator;
use Mail;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::paginate(25);
        return view('filelist', ['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\File $file
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileLink = FileTrait::fileUpload($request);
        if ($fileLink) {
            Mail::send(new SendMail($request->userEmail, $fileLink, $request->file->getClientOriginalName()));
            session()->flash('success', 'Файл успешно сохранен. Ссылка на файл направлена на e-mail');
        } else {
            session()->flash('alert', 'Ошибка отправки данных.');
        }

        return view('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view('form', ['file' => $file]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\File $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:255'
        ], [
            'required' => 'Обязательное поле',
            'max' => 'Не более 255 символов',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $file->update($request->all());
            session()->flash('success', 'Описание файла успешно изменено.');
            return redirect(route('file.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $path = "uploaded/$file->hash_user";
        $file->delete("$path/$file->hash_file");

        if ($deleted) {
            if (File::destroy($file->id)) {
                session()->flash('success', 'Файл успешно удален.');
            } else {
                session()->flash('alert', 'Ошибка связи с базой данных. Файл не удален');
            }
        } else {
            session()->flash('alert', 'Ошибка удаления файла.');
        }

        return redirect(route('file.index'));
    }
}
