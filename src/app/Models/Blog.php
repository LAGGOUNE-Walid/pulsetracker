<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Blog extends Model
{
    use CrudTrait, HasSEO;

    protected $fillable = ['title', 'cover', 'cover_alt', 'slug', 'content'];

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->title,
            description: substr(strip_tags(Str::markdown($this->content)), 0, 300),
            author: "Pulsetracker",
            image: $this->cover
        );
    }
}
