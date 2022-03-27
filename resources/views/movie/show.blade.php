<?php
use App\Common;
?>
@extends('layouts.app')

@section('content')

<div class="panel-body">
  <table class="table table-striped task-table">
    <!-- Table Headings -->
    <thead>
      <tr>
        <th>Movie's Attributes</th>
        <th>Value</th>
      </tr>
    </thead>

    <!-- Table Body -->
    <tbody>
      <tr>
        <td>Title</td>
        <td >{{ $movie->title }}</td>
      </tr>

      <tr>
        <td>Year</td>
        <td>{{ $movie->year }}</td>
      </tr>

      <tr>
        <td>Genre</td>
        <td>{{ $movie->genre }}</td>
      </tr>

      <tr>
        <td>Box Office(Million USD)</td>
        <td>{{ $movie->box_office }}</td>
      </tr>

      <tr>
        <td>Synopsis</td>
        <td>{{ $movie->synopsis }}</td>
      </tr>

      <tr>
        <td>On Showed Cinemas</td>
        <td>
          <ol>
            @foreach ($cinemas as $cinema)
              <li >{{ $cinema->name }}</li>
            @endforeach
          </ol>
        </td>
      </tr>
    </tbody>
  </table>
  <!-- Back Button -->
            <div class="form-group row">
                <div class="col-sm-offset-3 col-sm-6">
                    <a href="{{url('/movie')}}">{!! Form::button('Back', [
                      'type' => 'submit',
                      'class' => 'btn btn-primary',
                      ]) !!}</a>
                </div>
            </div>
</div>
@endsection
