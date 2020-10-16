@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <div class="row invisible justify-content-center" data-toggle="appear">
            <div class="col-12 well">
                <div class="card-title">Add Created Software</div>
                <hr>
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('software.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Name of Software, e.g. Documentation, Approval" required>
                                </div>
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="URL" name="url" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 form-group">
                                    <textarea name="description" placeholder="Description" class="form-control" required></textarea>
                                </div>  
                                <div class="col-sm-12 col-md-4 form-group">
                                    <div class="form-group row">
                                        <label class="col-12" for="example-file-input">DIsplay Icon</label>
                                        <div class="col-12">
                                            <input type="file" id="example-file-input" name="icon" required>
                                        </div>
                                    </div>
                                </div>            
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>



@endsection
