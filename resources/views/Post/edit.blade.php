@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Edit Post</h4>

                        </div>
                        <div class="content table-responsive table-full-width">
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif
                            <form style="padding: 28px;" action="{" method="Post">
                                @csrf
                                <div class="form-group">
                                  <label for="text">Title:</label>
                                  <input type="text" value="{{ $post->title }}" class="form-control" name="title" id="text">
                                </div>
                                <div class="form-group">
                                  <label for="pwd">Body:</label>
                                  <textarea class="form-control" name="body" id="" cols="30" rows="10">
                                    {!! $post->body  !!} 
                                  </textarea>
                                </div>

                                <button type="submit" class="btn btn-default">Update {{ $post->title }}</button>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
