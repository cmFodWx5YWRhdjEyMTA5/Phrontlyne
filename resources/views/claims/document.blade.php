
        <div class="modal-body">
         <div class="fallback">
          <form method="post"  enctype="multipart/form-data" action="/uploadfiles">
          <input type="text" class="form-control" width="1000px" height="40px" name="filename" id="filename" placeholder="Enter file name" /><br>
          <input type="file" class="form-control dropbox" width="1000px" height="40px" name="image" /><br>
          <input type="submit" name="submit"  class="btn btn-success btn-s-xs" value="upload" />
          <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
        </div>
          <br>
          <br>
          <br>
              <div class="jumbotron how-to-create">
                <ul>
                    <li>Documents/Images are uploaded as soon as you drop them</li>
                    <li>Maximum allowed size of image is 8MB</li>
                </ul>

            </div>
<br>
<br>
<br>
            {{-- <div>
              <h1 class="well well-lg">Image & Document List </h1>
              @foreach( $images as $image )
              <section class="panel panel-info">
                        <div class="panel-body">
                          <a href="{!! 'uploads/images/'.$image->filepath !!}" class="thumb pull-right m-l">
                            <img src="{!! 'uploads/images/'.$image->filepath !!}" class="img-circle">
                          </a>
                          <div class="clear">
                            <a href="{!! 'uploads/images/'.$image->filepath !!}" class="text-info">{{$image->filename}}<i class="icon-download"></i></a>
                            <small class="block text-muted">created on :  {{$image->created_on}}</small>
                            <a href="{!! 'uploads/images/'.$image->filepath !!}" class="btn btn-xs btn-success m-t-xs">View</a>
                          </div>
                        </div>
            </section>
            @endforeach
            </div> --}}
      </div>