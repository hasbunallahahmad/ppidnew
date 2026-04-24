<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description',
        'content',
        'structured_content',
        'pdf_file',
    ];
    protected $casts = [
        'structured_content' => 'array',
    ];
    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
