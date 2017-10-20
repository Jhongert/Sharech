    @extends('layouts.app')

    

    @section('content')
    
        
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <textarea id="content" name="content" placeholder="Content"></textarea>
                </div>
            </div>
        </div>
    
    @endsection

    @section('page-script')
        <script src="{{ asset('js/tinymce/tinymce.js') }}"></script>
        
        <script>
            $(document).ready(function(){
                tinymce.init({
                    selector: '#content',
                    branding: false,
                    height : 440,
                    menubar: false,
                    plugins: "codesample",
                    toolbar: "undo redo | cut copy paste | bold italic underline strikethrough | bullist numlist | codesample"
                });
            });
        </script>
    @endsection