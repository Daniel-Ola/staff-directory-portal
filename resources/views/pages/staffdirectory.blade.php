@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Staff Directory</h2>

        @livewire('staff-directory')
        <!-- Dynamic Table Full -->
        <div class="block d-none">
            <div class="block-header block-header-default">
                <h3 class="block-title">All Staffs <small></small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                {{-- <table class="table table-responsive table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Designation</th>
                            <th>Subsidiary</th>
                            <th class="text-center" style="width: 15%;">Profile</th>
                            @if (Auth::user()->access == '1')
                                <th class="text-center" style="width: 15%;">Action</th>
                            @endif
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
                        <tr id="user{{ $staff->id }}">
                            <form id="editUser{{$count}}" method="post">
                            <td class="text-center">
                                <span class="">{{ $count }}</span>
                                <input type="hidden" class="form-control editable" value="{{ $staff->id }}" name="id" readonly form="editUser{{$count}}">
                            </td>
                            <td class="font-w600">
                                <span id="name{{ $count }}" class="noEdit output{{ $count }}">{{ $staff->firstname.' '.$staff->lastname }}</span>
                                <input type="text" class="form-control editable input{{ $count }}" value="{{ $staff->firstname.' '.$staff->lastname }}" readonly name="name" style="display: none;" form="editUser{{$count}}">
                            </td>
                            <td class="">
                                <span id="email{{ $count }}" class="noEdit output{{ $count }}">{{ $staff->email }}</span>
                                <input type="text" id="inputId{{ $count }}" class="form-control editable input{{ $count }}" value="{{ $staff->email }}" name="email" style="display: none;" form="editUser{{$count}}">
                            </td>
                            <td class="">
                                <span id="phone{{ $count }}" class="noEdit output{{ $count }}">{{ $staff->phone }}</span>
                                <input type="text" class="form-control editable input{{ $count }}" value="{{ $staff->phone }}" name="phone" style="display: none;" form="editUser{{$count}}">
                            </td>
                            <td class="">



                                <span id="desig{{ $count }}" class="noEdit output{{ $count }}">{{ $staff->desname }}</span>
                                <select id="profile-desig-edit{{ $count }}" class="form-control editable input{{ $count }} selectable" required style="display: none;">
                                    <option value="0" selected>Select One</option>
                                    @foreach ($desigs as $desig)
                                        <option value="{{ $desig->id }}">{{ $desig->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="profile-settings-desig{{ $count }}" value="{{ $staff->designation ?? '0' }}" name="designation" form="editUser{{$count}}">


                                
                            </td>
                            <td class="">


                                <span id="sub{{ $count }}" class="noEdit output{{ $count }}">{{ $staff->subname }}</span>
                                <select id="profile-sub-edit{{ $count }}" class="form-control editable input{{ $count }} selectable" required style="display: none;" form="editUser{{$count}}">
                                    <option value="0" selected>Select One</option>
                                    @foreach ($subs as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="profile-settings-sub{{ $count }}" value="{{ $staff->subsidiary ?? '0' }}" name="subsidiary" form="editUser{{$count}}">


                            </td>

                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-secondary fetchProfile" user="{{ $staff->id }}" title="View Profile">
                                    <i class="fa fa-user"></i>
                                </button>
                            </td>
                            @if (Auth::user()->access == '1')
                                <td class="text-center">
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-primary noEditBtn m-1"
                                        inId="#inputId{{ $count }}"
                                        in=".input{{ $count }}"
                                        out=".output{{ $count }}"
                                        count="{{ $count }}"
                                        select1="#profile-sub-edit{{ $count }}"
                                        select2="#profile-settings-sub{{ $count }}"
                                        deselect1="#profile-desig-edit{{ $count }}"
                                        deselect2="#profile-settings-desig{{ $count }}"
                                        title="Edit Profile">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button type="submit" style="display: none;" form="editUser{{ $count }}" class="btn btn-sm btn-primary updateProfile m-1" count="{{ $count }}" title="Update Profile"
                                    in=".input{{ $count }}"
                                    out=".output{{ $count }}" >
                                        <i class="fa fa-save"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger deleteProfile m-1" user="{{ $staff->id }}" title="Delete User" remove="#user{{ $staff->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                </td>
                            @endif
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table> --}}
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

<script>
    function setVal(select, input) {
        console.log(select);
    }
</script>