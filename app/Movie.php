<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
  protected $fillable = [
    'title',
    'year',
    'genre',
    'box_office',
    'synopsis',
  ];

  /**
  * Get all of the members for the division.
  */
  public function cinemas()
  {
    return $this->belongsToMany(Cinema::class);
  }
}
