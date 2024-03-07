<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;



class Event extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia,SoftDeletes;

    protected $table = 'events';
    protected $fillable = [
        'titre',
        'description',
        'id_image',
        'created_by',
        'prix',
        'nombre_place',
        'ville_id',
        'deadline',
        'category_id',
        'acceptation'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lieu()
    {
        return $this->belongsTo(Lieu::class, 'ville_id');
    }

}
