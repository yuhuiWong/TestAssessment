@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><b><i><font size="6">Home Page</font></i></b></div>

                <div class="panel-body">
                      @if (session('status'))
                          <div class="alert alert-success">
                              {{ session('status') }}
                          </div>
                      @endif
                      <div class="homepage">
                          <div>
                            <a href="{{url('/movie')}}"><img src="/icons/{{ 'movie.jpg' }}" height="250px" width="400px"/></a>
                          </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
