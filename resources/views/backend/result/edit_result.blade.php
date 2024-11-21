@extends('admin.admin_dashboard')
@section('admin')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Update a Result</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Update</a></li>
                        <li class="breadcrumb-item active">Result</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Update Student Result</h4>

            <form action="{{route('update.result')}}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label style="text-align: right" class="col-sm-2 col-form-label">Student Name</label>
                    <div class="col-sm-10">
                        <h6 style="padding-top: 10px; font-style: italic">{{ $result[0]->student->name}}</h6>
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label style="text-align: right" class="col-sm-2 col-form-label">Class</label>
                    <div class="col-sm-10">
                        <h6 style="padding-top: 10px; font-style: italic">
                            {{ $result[0]->student->class->class_name}} Section - {{ $result[0]->student->class->section}}
                        </h6>
                    </div>
                </div>
                <!-- end row -->

                @php
                    $count = count($result);
                @endphp

                <div class="row mb-3 showSubjects">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Subject</label>
                    <div class="col-sm-10 sub">
                        @for ($i = 0; $i < $count; $i++)
                            <label for="{{ $result[$i]->subject->subject_name }}">{{ $result[$i]->subject->subject_name }}</label>
                            <input class="form-control" type="hidden" name="result_ids[]" value="{{ $result[$i]->id }}">
                            <input class="form-control" type="hidden" name="subject_ids[]" value="{{ $result[$i]->subject->id }}">
                            <input class="form-control" required type="text" name="marks[]" placeholder="Enter mark out of 100" value="{{ $result[$i]->marks }}">
                        @endfor
                    </div>
                </div>
                <!-- end row -->

                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Results</button>
            </form>
            
        </div>
    </div>
</div>

@endsection