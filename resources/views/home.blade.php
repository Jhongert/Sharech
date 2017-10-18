@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endsection

@section('content')

    <div class="row">
        @if(Auth::guest())
            <div class="col-md-6">
           
            	<div class="row">
                    <div class="col-xs-4">
            		    <h1 class="text-center"><i class="fa fa-share-alt fa-3x"></i></h1>
                        <h1 class="text-center">Share</h1>
                    </div>
                    <div class="col-xs-4">
                        <h1 class="text-center"><i class="fa fa-search fa-3x"></i></h1>
                        <h1 class="text-center">Search</h1>
                    </div>
                    <div class="col-xs-4">
                        <h1 class="text-center"><i class="fa fa-users fa-3x"></i></h1>
                        <h1 class="text-center">Connect</h1>
            		</div>
            	</div>
                
                <div style="margin: 20px 0">
                    <p >is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </p>
                    <p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </p>
                </div>
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
                        <td>{{ $post->title }}</td>
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
                                { "orderable": false, "targets": [2,3] }
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
