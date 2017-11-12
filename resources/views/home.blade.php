@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
     <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        @if(Auth::guest())
            <div class="col-md-6">
           
            	<!-- <div class="row"> -->
                    <div style="margin: 20px 0">
                        <h1>A better place for developers</h1>
                    </div>
                    <!-- <div class="col-xs-4"> -->

            		    <h2><i class="fa fa-share-alt"></i> Share</h2>
                        <!-- <h1 class="text-center">Share</h1> -->
                    <!-- </div>
                    <div class="col-xs-4"> -->
                        <h2><i class="fa fa-search"></i> Search</h2>
                        <!-- <h1 class="text-center">Search</h1> -->
                    <!-- </div>
                    <div class="col-xs-4"> -->
                        <h2><i class="fa fa-users"></i> Connect</h2>
                       <!--  <h1 class="text-center">Connect</h1> -->
            		<!-- </div> -->
            	<!-- </div> -->
            </div>
            <div class="col-md-6">
                @include('auth.signupform')
            </div>
        @else
            <table  class="tablesorter display compact">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date created</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            @if (count($posts) > 0 )
                @foreach ($posts as $post)
                    <tr>
                        <td><a href="{{ url('/post/' . $post->url )}}">{{ $post->title }}</a></td>
                        <td>{{ date("F j, Y, g:i a", strtotime($post->created_at)) }}</td>
                        <td>{{ $post->published == '1' ? 'Yes' : 'No'}}</td>
                        <td><a href="/post/edit/{{ $post->id }}" class="btn btn-default btn-sm btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                    </tr>
                @endforeach
            @endif
            </table>

            @section('page-script')
                <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

                <script type="text/javascript">
                    $(document).ready(function() {
                        // datatable config
                        $('table').DataTable({
                            "columnDefs": [
                                { "orderable": false, "targets": [3] }
                              ],
                            order: [[ 0, "asc" ]],
                            info: false,
                            paging: false,
                        });
                    });
                </script>
            @endsection
        @endif
    </div>

@endsection
