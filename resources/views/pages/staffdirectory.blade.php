@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Staff Directory</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">All Staffs <small></small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th>Name</th>
                            <th class="d-none d-sm-table-cell">Email</th>
                            <th class="d-none d-sm-table-cell">Phone Number</th>
                            <th class="d-none d-sm-table-cell">Designation</th>
                            <th class="d-none d-sm-table-cell">Subsidiary</th>
                            <th class="text-center" style="width: 15%;">Profile</th>
                            <th class="text-center" style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 0;
                        @endphp
                    @foreach ($staffs as $staff)
                    @php
                        $count ++;
                    @endphp
                        <tr>
                            <form id="editUser{{$count}}" method="post">
                                {{-- <input type="hidden" value="" name="_token"> --}}
                            <td class="text-center">
                                <span class="">{{ $count }}</span>
                                <input type="hidden" class="form-control editable" value="{{ $staff->id }}" name="id" readonly form="editUser{{$count}}">
                            </td>
                            <td class="font-w600">
                                <span id="name{{ $count }}" class="noEdit output{{ $count }}" inId="#inputId{{ $count }}" in=".input{{ $count }}" out=".output{{ $count }}">{{ $staff->firstname.' '.$staff->lastname }}</span>
                                <input type="text" class="form-control editable input{{ $count }}" value="{{ $staff->firstname.' '.$staff->lastname }}" readonly name="name" style="display: none;" form="editUser{{$count}}">
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <span id="email{{ $count }}" class="noEdit output{{ $count }}" inId="#inputId{{ $count }}" in=".input{{ $count }}" out=".output{{ $count }}">{{ $staff->email }}</span>
                                <input type="text" id="inputId{{ $count }}" class="form-control editable input{{ $count }}" value="{{ $staff->email }}" name="email" style="display: none;" form="editUser{{$count}}">
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <span id="phone{{ $count }}" class="noEdit output{{ $count }}" inId="#inputId{{ $count }}" in=".input{{ $count }}" out=".output{{ $count }}">{{ $staff->phone }}</span>
                                <input type="text" class="form-control editable input{{ $count }}" value="{{ $staff->phone }}" name="phone" style="display: none;" form="editUser{{$count}}">
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <span id="desig{{ $count }}" class="noEdit output{{ $count }}" inId="#inputId{{ $count }}" in=".input{{ $count }}" out=".output{{ $count }}">{{ $staff->designation ?? 'Staff' }}</span>
                                <input type="text" class="form-control editable input{{ $count }}" value="{{ $staff->designation }}" name="designation" style="display: none;" form="editUser{{$count}}">
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <span id="sub{{ $count }}" class="noEdit output{{ $count }}" in=".input{{ $count }}" out=".output{{ $count }}">{{ $staff->subsidiary ?? 'CFS Group' }}</span>
                                <input type="text" class="form-control editable input{{ $count }}" value="{{ $staff->subsidiary }}" name="subsidiary" style="display: none;" form="editUser{{$count}}">
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-secondary fetchProfile" user="{{ $staff->id }}" title="View Profile">
                                     {{-- data-toggle="modal" data-target="#myModal" --}}
                                    <i class="fa fa-user"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button type="submit" form="editUser{{ $count }}" class="btn btn-sm btn-primary updateProfile m-1" count="{{ $count }}" title="Update Profile">
                                     {{-- data-toggle="modal" data-target="#myModal" --}}
                                    <i class="fa fa-save"></i>
                                </button>
                                <button type="submit" form="editUser{{ $count }}" class="btn btn-sm btn-danger deleteProfile m-1" user="{{ $staff->id }}" title="Delete Profile">
                                    {{-- data-toggle="modal" data-target="#myModal" --}}
                                   <i class="fa fa-trash"></i>
                               </button>
                            </td>
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->

    <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background: transparent;">
      
        <!-- Modal Header -->
        <div class="modal-header d-none">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          
            <section class="container">
     
                <div class="row active-with-click">
                    <div class="col-12">
                        <article class="material-card Red">
                            <h2>
                                <span id="staffName">Staff Name</span>
                                <strong>
                                    <i class="fa fa-fw fa-magic"></i>
                                    <span id="staffMail">Staff email</span>
                                </strong>
                            </h2>
                            <div class="mc-content">
                                <div class="img-container">
                                    <img class="img-responsive img-fluid w-100" id="staffImg" src="/assets/media/avatars/avatar15.jpg" style="height: 100%;">
                                </div>
                                <div class="mc-description">
                                    <ul style="list-style: none;">
                                        <li><b>Phone:</b> <span id="staffPhone"></span></li>
                                        <li><b>Designation:</b> <span id="staffDesig"></span></li>
                                        <li><b>Subsidiary:</b> <span id="staffSub"></span></li>
                                    </ul>
                                    {{-- Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ... --}}
                                </div>
                            </div>
                            <a class="mc-btn-action">
                                <i class="fa fa-bars"></i>
                            </a>
                            <div class="mc-footer d-none">
                                <h4>
                                    Social
                                </h4>
                                <a target=_parent href="https://www.wpdownloadmanager.com/" class="fa fa-fw fa-facebook"></a>
                                <a target=_parent href="https://www.wpdownloadmanager.com/"  class="fa fa-fw fa-twitter"></a>
                                <a target=_parent href="https://www.wpdownloadmanager.com/"  class="fa fa-fw fa-linkedin"></a>
                                <a target=_parent href="https://www.wpdownloadmanager.com/"  class="fa fa-fw fa-google-plus"></a>
                            </div>
                        </article>
                    </div>
                    
                </div>
            </section>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer d-none">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>




 





</main>
@endsection