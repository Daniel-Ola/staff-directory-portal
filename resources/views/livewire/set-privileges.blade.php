<div>
    <form action="{{ route('set.priviledges') }}" method="POST" enctype="multipart/form-data">
        @csrf


        <div class="card mb-5">
            <input class="form-control" wire:model="query" placeholder="Enter firstname, lastname or email" />
            <div wire:loading wire:target="updatedQuery" class="w-100">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Searching... <i>{{ $query }}</i> </li>
                </ul>
            </div>
            @if (!empty($query))
                <ul class="list-group list-group-flush {{ $showList }}">
                    <li class="list-group-item">{{ $users[0] }}</li>
                    @forelse ($users as $i => $user)
                        @if ($i != 0)
                            <li class="list-group-item" wire:click='fillUp({{ $i }})'>{{ $user['firstname'].' '.$user['lastname'].' - '.$user['email'] }}</li>
                        @endif
                    @empty
                        <li class="list-group-item">No Results</li>
                    @endforelse
                </ul>
            @endif
        </div>

        <div class="row" style="margin-top: 100px;">
            <div class="col-6">
                @if ($selected)
                    <div class="row justify-content-center">
                        <div class="col form-group">
                            <input type="hidden" name="user_id" value="{{ $user_id }}" readonly required>
                            <input type="text" class="form-control" value="{{ $data['email'] }}" readonly required>
                        </div>
                    </div>
                @endif
                @if (!empty($user_id))
                    <div class="row justify-content-center">
                        <div class="col form-group">
                            <select name="software" wire:model="software" class="form-control" required>
                                <option value="" selected hidden disabled>Select Software</option>
                                @foreach ($softwares as $soft)
                                    <option value="{{ $soft->name }}">{{ $soft->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if (!empty($software))
                        <div class="row" wire:loading wire:target="updatedSoftware">
                            {{-- {!! $spinner !!} --}}
                            <div class="col-12 form-group text-center">
                                {{-- <input type="text" value="loading" class="form-control"> --}}
                                <i class="fa fa-spin fa-spinner" style="font: 50px; font-weight:400;" aria-hidden="true"></i> </div>
                            {{-- <i class="fa fa-spin fa-spinner" aria-hidden="true"></i> --}}
                        </div>
                        <div class="row justify-content-center" wire:loading.remove>
                            <div class="col-12 form-group">
                                @if (!is_string($modules))
                                    <select name="module_id" class="form-control" required>
                                        <option value="" selected hidden disabled>Select a module</option>
                                        @forelse ($modules as $mod)
                                            <option value="{{ $mod->id }}">{{ ucfirst($mod->name) }}</option>
                                        @empty
                                            <option value="" disabled>{{ $software }} has no module</option>
                                        @endforelse
                                    </select>
                                @endif
                            </div>
                            <div class="col-12 form-group">
                                <select name="access" class="form-control">
                                    <option value="" selected disabled hidden>Choose Aceess</option>
                                    <option value="viewany">Can view all</option>
                                    <option value="view">Can view specific</option>
                                    <option value="delete">Can Delete</option>
                                    <option value="update">Can Update</option>
                                    {{-- <option value="edit">Can Edit</option> --}}
                                    <option value="download">Can Download</option>
                                    <option value="create">Can Create</option>
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                <select name="user_type" class="form-control">
                                    <option value="" selected disabled hidden>Select user type</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="superadmin">Super Admin</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 form-group">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-center">Permissions</h4>
                    <ul class="list-inline">
                        @if (count($permissions) > 0)
                            @forelse ($permissions as $permit)
                                <li class="list-inline-item p-1" style="border: 1px solid;">{{ $permit->access }} <span><i class="fa fa-times-circle-o" aria-hidden="true"></i></span></li>
                            @empty
                                No permissions
                            @endforelse
                        @endif
                    </ul>
                  </div>
                </div>
                {{-- <h5 class="h5">Permissions</h5> --}}
            </div>
        </div>

    </form>
</div>
