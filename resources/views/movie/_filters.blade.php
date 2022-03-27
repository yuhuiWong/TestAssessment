<?php
use App\Common;
use App\Movie;
?>

<section class="filters" >
  <div>
    {!! Form::open([
    'route' => ['movie.index'],
    'method' => 'get',
    'class' => 'form-inline'
    ]) !!}
    <div>
    <!-- Filter Title -->
    {!! Form::label('movie-title', 'Title', [
    'class'         => 'control-label col-sm-3',
    ]) !!}
    {!! Form::text('title', null, [
    'id'        => 'movie-title',
    'class'     => 'form-control',
    'maxlength' => 100,
    ]) !!}
   </div>

   <div>
    <!-- Filter Genre -->
    {!! Form::label('movie-genre', 'Genre', [
    'class'         => 'control-label col-sm-3',
    ]) !!}
    {!! Form::select('genre', Common::$genres, null, [
    'class'         => 'form-control',
    'placeholder'   => '-All-',
    ]) !!}
    </div>

    <div>
    <!-- Filter Year -->
    {!! Form::label('movie-year', 'Year', [
    'class'         => 'control-label col-sm-3',
    ]) !!}
    {!! Form::select('year', Common::$years, null, [
    'class'         => 'form-control',
    'placeholder'   => '-All-',
    ]) !!}
    </div>

    <div>
    <!-- Submit Button -->
    {!! Form::button('Filter', [
    'type'          => 'submit',
    'class'         => 'btn btn-primary',
    ]) !!}

    {!! Form::close() !!}

  </div>
  </div>
</section>
