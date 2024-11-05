@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">{{ $post->title }}</h4>
                            <br>

                            <a href="{{ route('editpost', $post) }}" class="btn btn-primary">EDIT</a><br>
                            <br>
                    <form action="{{ route('deletepost', $post) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Post - {{ $post->title }}</button>
                    </form>


                    {!! $post->body !!}
                        </div>
                        <div class="content table-responsive table-full-width">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
