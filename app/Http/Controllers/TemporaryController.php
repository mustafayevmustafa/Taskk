<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class TemporaryController extends Controller
{
    /**
     * @param $path
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function path($path){
        return Storage::disk('local')->download(str_replace('-','/',$path));
    }
}
