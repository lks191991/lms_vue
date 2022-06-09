@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CSV</div>
<form action="{{route('csvUploadVideoPost')}}" method = "post" enctype="multipart/form-data">
    @csrf
                <div class="card-body">
				 <div class="form-group ">
                        <label>Course</label>
                        <select name="course" id="course" class="custom-select" required>
                            <option value="" selected="" disabled="">Course</option>
                            @foreach($courses as $course)
                            <option value="{{$course->id}}">{{$course->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group video_url_section">
                        <label>CSV File</label><br>
                         <input type="file" id="uploaded_file_csv" name="uploaded_file_csv">
                        <small class="form-text text-muted">.csv</small>
                    </div>
                </div>
				</form>
            </div>
        </div>
    </div>
</div>
@endsection
