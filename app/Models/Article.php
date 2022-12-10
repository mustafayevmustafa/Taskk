<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'description', 'file', 'type'];

    /**
     * @var string[]
     */
    protected $hidden = ['file'];

    /**
     * @return string
     */
    public function getTemporaryUrlAttribute()
    {
        return Storage::disk('local')->temporaryUrl('articles-'.$this->file, now()->addMinutes(1));
    }
}
