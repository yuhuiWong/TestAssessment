<?php
	use App\Common;
?>

@extends('layouts.app')

@section('content')



  <div class="panel-body">
    @if (count($movies) > 0)
      <table class="table table-striped task-table">
        <!-- Table Headings -->
        <thead>
					<br>
          <tr>
            <th>No.</th>
            <th>Title</th>
            <th>Year</th>
            <th>Genre</th>
						<th>Box Office(Million USD)</th>
						<th>Synopsis</th>
						@if ($isAdmin)
            <th>Actions</th>
						@endif
          </tr>
        </thead>

        <!-- Table Body -->
        <tbody>
          @foreach ($movies as $i => $movie)
          <tr>
            <td class="table-text">
              <div>{{ $i+1 }}</div>
            </td>

            <td class="table-text">
              <div>
                {!! link_to_route('movie.show', $title = $movie->title, $parameters = ['id' => $movie->id,]) !!}
              </div>
            </td>

            <td class="table-text">
              <div>{{ $movie->year }}</div>
            </td>

            <td class="table-text">
              <div>{{ $movie->genre }}</div>
            </td>

						<td class="table-text">
              <div>{{ $movie->box_office }}</div>
            </td>

						<td class="table-text">
							<div>{{ $movie->synopsis }}</div>
						</td>
						@if ($isAdmin)
            <td class="table-text">
              <div>
                {!! link_to_route('movie.edit', $title = 'Edit', $parameters = ['id' => $movie->id,]) !!}
                <a href="{{ route('movie.delete', $movie->id) }}">Delete</a>
              </div>
            </td>
						@endif
          </tr>
          @endforeach
        </tbody>
      </table>
			@if ($isAdmin)
			<div class="form-group row">
          <div class="col-sm-offset-3 col-sm-6">
              <a href="{{url('/movie/create')}}">{!! Form::button('Create', [
                'type' => 'submit',
                'class' => 'btn btn-primary',
                ]) !!}</a>
          </div>
      </div>
			@endif
      {{ $movies->links() }}
    @else
      <div>
        No records found
			<div class="form-group row">
          <div class="col-sm-offset-3 col-sm-6">
              <a href="{{url('/movie/create')}}">{!! Form::button('Create', [
                'type' => 'submit',
                'class' => 'btn btn-primary',
                ]) !!}</a>
          	</div>
					</div>
      </div>
    @endif

@endsection
