<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MovieResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
          'id'=>$this->id,
          'title'=>$this->title,
          'year'=>$this->year,
          'box_office'=>$this->box_office,
          'synopsis'=>$this->synopsis,
          'cinemas'=>CinemaResource::Collection($this->whenLoaded('cinemas'))
      ];
    }
}
