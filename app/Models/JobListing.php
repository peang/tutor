<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'salary',
    'employer_id',
  ];

  public function employer()
  {
    return $this->belongsTo(Employer::class);
  }

  public function tags()
  {
    return $this->belongsToMany(Tag::class, 'job_tag', 'job_listing_id');
  }
}
