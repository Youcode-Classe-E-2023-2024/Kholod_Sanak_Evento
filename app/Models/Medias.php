<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Medias extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        "user_id",
    ];

    public function getMediaName()
    {
        // Retrieve the first media associated with this model
        $media = $this->getFirstMedia();

        // Check if media exists
        if ($media) {
            // Return the media name
            return $media->name;
        } else {
            // Return a default value if media doesn't exist
            return 'No media available';
        }
    }

}
