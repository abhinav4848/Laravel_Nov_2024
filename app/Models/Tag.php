<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    public function jobs()
    {
        return $this->belongsToMany(Job::class, relatedPivotKey: 'job_listing_id');
        // we use releatedPivotKey because it Specifies the key on the pivot table that refers to the related model being connected (the "foreign" model). If this model itself had a different ID name, we'd use foreignPivotKey here as well but it follows the proper convention.
    }
}
