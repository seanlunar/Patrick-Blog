@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">All Post  ({{ $posts->count() }})</h4>
                            <br>
                            <a href="{{ route('createpost') }}">
                            <button class="btn btn-primary">Add Post</button>
                        </a>

                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Title</th>
                                    <th>Created date</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>
                                            <a style="color: black;" class="btn-success btn-sm" href="{{ route('showpost',$post) }}">View</a>

                                            <a style="color: black;" class="btn-info btn-sm" href="{{ route('editpost', $post) }}">Edit</a>

                                        </td>

                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
