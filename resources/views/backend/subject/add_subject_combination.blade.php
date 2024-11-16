@extends('admin.admin_dashboard')
@section('admin')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Add Subject Combination</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Subject</a></li>
                        <li class="breadcrumb-item active">Combination</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Add Subject Combination</h4>

            <form action="{{route('store.subject.combination')}}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Class</label>
                    <div class="col-sm-10">
                        <select name="class_id" class="form-select" aria-label="Default select example">
                            <option selected="">Select Class</option>
                            @foreach ($classes as $class)
                                <option value="{{$class->id}}">{{$class->class_name}}</option>
                            @endforeach
                            </select>
                    </div>
                </div>

                <div class="show_item">

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Subject</label>
                        <div class="col-sm-7">
                            <select name="subject_ids[]" class="form-select" aria-label="Default select example">
                                <option selected="">-- Select subject --</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-success waves-effect waves-light add_subject_btn">Add More</button>
                        </div>
                    </div>
    
                    {{-- append elements..  --}}
    
                </div>
                <!-- end row -->

                <button type="submit" class="btn btn-primary waves-effect waves-light">Assign</button>
            </form>
            
        </div>
    </div>
</div>


<div id="show_item_add" style="visibility: hidden">

    <div class="row mb-3">
        <label for="example-text-input" class="col-sm-2 col-form-label">Subject</label>
        <div class="col-sm-7">
            <select name="subject_ids[]" class="form-select" aria-label="Default select example">
                <option selected="">-- Select subject --</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <button class="btn btn-danger waves-effect waves-light remove_subject_btn">Remove</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let add_subject = $('#show_item_add').html();

        $('.add_subject_btn').click(function(e) {
            e.preventDefault();
            $('.show_item').append(add_subject);
        });

        $(document).on('click', '.remove_subject_btn', function(e) {
            e.preventDefault();
            let element = $(this).parent().parent();
            $(element).remove();
        });
    })
</script>


{{-- VERSION ORIGINAL --}}

@endsection