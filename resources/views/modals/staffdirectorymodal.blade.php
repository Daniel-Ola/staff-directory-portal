@php
$subsidiary = Auth::user()->subsidiary;
$subsidiaries = \App\Subsidiary::all();
$department = Auth::user()->department;
$departments = \App\Department::all();
$designation = Auth::user()->designation;
$des = \App\Designation::join('departments as dept', 'dept.id', 'dept_id')->select('designations.*', 'dept.name as deptname', 'dept.id as deptid')->orderBy('deptname')->get();
$designations = [];
foreach ($des as $de) {
    $deptname = $de->deptname.'_'.$de->deptid;
    $newItem = ['name' => $de->name, 'id'=> $de->id];
    if(!array_key_exists($deptname, $designations)) {
        $designations[$deptname] = [];// $newItem;
    }
    array_push($designations[$deptname], $newItem);
}
@endphp

<div class="modal fade" id="modal-edituser" tabindex="-1" role="dialog" aria-labelledby="modal-message" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document" style="border-bottom: 5px solid #343a40;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Edit User</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                {{-- <div class="block-content block-content-full block-content-sm bg-body font-size-sm">
                </div> --}}
                <div class="block-content">
                    <form action="{{ route('up.profile') }}" method="post">
                        @csrf
                        <input type="hidden" class="id" name="id">
                        <div class="form-group row">
                            <label>Firstname</label>
                            <input type="text fname" class="form-control fname" name="firstname">
                        </div>
                        <div class="form-group row">
                            <label>Email</label>
                            <input type="text" class="form-control email" name="email">
                        </div>
                        <div class="form-group row">
                            <label>Subsidiary</label>
                            <select name="subsidiary" class="form-control subsidiary">
                                <option value="0" {{ $subsidiary == 0 ? 'selected disabled hidden' : '' }}>Select One</option>
                                @foreach ($subsidiaries as $sub)
                                    <option value="{{ $sub['id'] }}" {{ $subsidiary == $sub['id'] ? 'selected' : '' }}>{{ $sub['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <label>Department</label>
                            <select name="department" class="form-control department">
                                <option value="0" {{ $department == 0 ? 'selected disabled hidden' : 'disabled hidden' }}>Select One</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept['id'] }}" {{ $department == $dept['id'] ? 'selected' : '' }}>{{ $dept['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <label>Designation</label>
                            <select name="designation" class="form-control designation">
                                <option value="" {{ $designation == '' ? 'selected disabled hidden' : 'disabled' }}>Select One</option>
                                @if ( ! empty($designations))
                                    @foreach ($designations as $dept => $desig)
                                    @php
                                        $exploded = explode('_', $dept);
                                    @endphp
                                        <optgroup label="{{ $exploded[0] }}" class="desiggroup" id="desiggroup{{ $exploded[1] }}" aria-selected="true">
                                            @forelse ($desig as $des)
                                                <option value="{{ $des['id'] }}" {{ $designation == $des['id'] ? 'selected' : '' }}>{{ $des['name'] }}</option>
                                            @empty
                                                <option value="">No designations available</option>
                                            @endforelse
                                        </optgroup>
                                        
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="w-100">
                                <button type="submit" class="btn btn-alt-info" name="action" value="update">
                                    Update
                                </button>
                                <button type="submit" class="btn btn-alt-danger" name="action" value="delete" form="deleteProfile">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </form>
                    <form action="{{ route('del.profile') }}" method="post" id="deleteProfile">
                        @csrf
                        <input type="hidden" class="id" name="id" form="deleteProfile">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>