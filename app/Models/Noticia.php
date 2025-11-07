<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Noticia extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'noticias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'texto',
        'imagen',
        'slug',
    ];

    /**
     * Set the imagen attribute - convert relative path to absolute URL
     *
     * @param  string|null  $value
     * @return void
     */
    public function setImagenAttribute($value): void
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
            // Si es una ruta relativa, convertirla a URL absoluta
            // El FileUpload guarda en noticias/nombre-archivo.jpg
            // Necesitamos convertir a http://localhost/images/noticias/nombre-archivo.jpg
            $this->attributes['imagen'] = url('images/' . $value);
        } else {
            $this->attributes['imagen'] = $value;
        }
    }
}
