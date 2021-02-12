<div>
    <div class="form-group row">
        <div class="col-12">
            <label for="profile-settings-desig">Department</label>
            <select name="department" id="profile-dept-edit" class="form-control" required wire:model="deptId">
                @php
                    $did = Auth::user()->department? : '0'; // $deptid
                @endphp
                <option value="" disabled @if($did == 0) {{ 'selected' }} @else {{ 'hidden' }} @endif>Select One</option>
                @foreach ($depts as $dept)
                    <option value="{{ $dept->id }}" @if($dept->id == $did) {{ 'selected' }} @endif>{{ $dept->name }}</option>
                @endforeach
            </select>
            <input type="hidden" class="form-control form-control-lg" id="profile-settings-desig" value="{{ Auth::user()->department ?? '0' }}" required>
        </div>
    </div>

    {{-- @if ( ! empty($desigs)) --}}
        <div class="form-group row">
            <div class="col-12">
                <label for="profile-settings-desig">Designation<span wire:loading.remove wire:target="deptId">s in <b>{{ strtoupper($deptName) }}</b></span></label>
                <div wire:loading wire:target="deptId"> Loading designations <i class="fa fa-spin fa-spinner"></i> </div>
                <select name="designation" id="profile-desig-edit" class="form-control" required>
                    <option value="" disabled hidden




                    @if(Auth::user()->designation == 0) {{ 'selected' }} @endif>Select One</option>
                    @forelse ($desigs as $desig)
                        <option value="{{ $desig['id'] }}" @if($desig['id'] == Auth::user()->designation) {{ 'selected' }} @endif>{{ $desig['name'] }}</option>
                    @empty
                        <option value='0' selected disabled>No designations found in <b>{{ $deptName }}</b></option>
                    @endforelse
                </select>
                <input type="hidden" class="form-contr
                ol form-control-lg" id="profile-settings-desig" value="{{ Auth::user()->designation ?? '0' }}" required>
            </div>
        </div>
    {{-- @endif --}}
</div>
