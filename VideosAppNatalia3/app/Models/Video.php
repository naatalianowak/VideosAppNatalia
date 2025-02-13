<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * App\Models\Video
 *
 * @property string|null $title
 * @property string|null $description
 * @property string|null $url
 * @property \Carbon\Carbon|null $published_at
 * @property string|null $previous
 * @property string|null $next
 * @property int|null $series_id
 * @method static findOrFail(int $id)
 */
class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'url', 'published_at', 'previous', 'next', 'series_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $dates = ['published_at'];

    /**
     * Obtiene la fecha de publicación formateada.
     *
     * @return string|null
     */
    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('d \d\e F \d\e Y') : null;
    }

    /**
     * Obtiene la fecha de publicación en formato humano.
     *
     * @return string|null
     */
    public function getFormattedForHumansPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->diffForHumans() : null;
    }

    /**
     * Obtiene el timestamp de la fecha de publicación.
     *
     * @return int|null
     */
    public function getPublishedAtTimestampAttribute()
    {
        return $this->published_at ? $this->published_at->timestamp : null;
    }
}
