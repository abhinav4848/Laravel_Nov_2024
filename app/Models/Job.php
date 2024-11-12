<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    //by default, if you make an eloquent model, model name is singular form of the table name.
    //But since there's a clash with table name as table 'jobs' already exists, we have to name our table something different in the migration
    //so here as well we need to specify the unique table name
    protected $table = 'job_listings';
    protected $fillable = ['title', 'salary']; // allows mass assignment via eg. App\Models\Job::create(['title'=>'Director','salary'=>'$350000'])

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: "job_listing_id"); // we need to mention the foreignPivotKey becuase it's expecting a column name of job_id but we couldn't use it because Laravel has a table with job_id already in it.
        // we use foreignPivotKey because job_listing_id column on the pivot table refers to the ID of the **current** model
        // see Tag Model for relatedPivotKey
    }
}
