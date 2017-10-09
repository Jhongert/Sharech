@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h1>Create post</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-9">
      <form id="snippetForm">
        <div class="form-group">
          <input type="text" id="title" name="title" class="form-control" placeholder="Title" autofocus >
        </div>
        <div class="form-group">
          <textarea style="height: 400px" id="content" name="content" class="form-control" placeholder="Content"></textarea>
        </div>
      </form>
    </div>

    <div class="col-md-3">
      <div id="tag-container">
        <h4>Tags</h4>
        <div class="input-group input-group-sm">
          <input type="text" class="form-control" name="tags" id="tags">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button" id="add-tag">Add</button>
          </span>
        </div>
        <label>Separate tags with comma</label>
        <ul id="tag-holder">
        </ul>
      </div>
      <div class="input-group" id="published">
        <label class="form-control">Published</label>
        <span class="input-group-addon">
          <input type="checkbox" aria-label="...">
        </span>
      </div><!-- /input-group -->

      <div class="form-group">
          <button class="btn btn-primary" id="save">Save</button>
        </div>
    </div>
  </div>
</div>
@endsection

@section('page-script')
<script type="text/javascript">
    $(document).ready(function(){
        var tags = [];

        $('#add-tag').on('click', function(){
          var curTag = '';
          var input = $('#tags').val();
          var arrayTags = input.split(',');
          for(var i = 0; i < arrayTags.length; i++){
            curTag = arrayTags[i].trim().toUpperCase();
            if( curTag != "" && !tags.includes(curTag) ){
              var li = $('<li>');
              li.html('<i class="fa fa-trash" aria-hidden="true"></i>' + curTag);
              $('#tag-holder').append(li);
              tags.push(curTag);
            }
          }
          $('#tags').val('').focus();
        });


        $(document).on('click', '.fa-trash', function(){
          var text = $(this).parent().text();
          tags.splice(tags.indexOf(text), 1);
          $(this).parent().remove();
          console.log(tags);
        });


        $('#save').on('click', function(event){
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = {
                id:'3',
                name: 'jhon'
            };

            /*$.post('/post/store', data, function(data){
                console.log(data)
            })*/
            $.ajax({
                type: 'POST',
                url: '/post/store',
                data: data,
                success: function(data){
                    console.log(data);
                }
            })
        })
    });
</script>
@endsection