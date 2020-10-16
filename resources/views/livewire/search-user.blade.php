<div>

    <div class="card">
        <input class="form-control" wire:model="query" placeholder="Enter firstname, lastname or email" />
        <div wire:loading class="w-100">
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


    @if ($selected)
        {{-- @if ($isLoading)
            <div class="alert alert-primary" role="alert" style="z-index: 999999;">
                <strong>Loading...</strong>
            </div>
        @else --}}
            <div class="row" style="margin-top: 10px;">
                <div class="col-12">
                    <div class="block block-themed">
                        <div class="block-header bg-info">
                            <h3 class="block-title">{{ "{$data['firstname']} {$data['lastname']}" }}</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content" style="padding-bottom: 10px;">
                            <form method="POST" action="{{ route('dosoftwares.assign') }}">
                                @csrf
                                <input type="hidden" value="{{ $data['id'] }}" name="user_id">
                                <input type="hidden" value="can" name="attribute">
                                @foreach ($softwares as $soft)
                                    <div class="form-check" style="margin-bottom: 10px;">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="software_id[]" id="" value="{{ $soft->id }}" {{ in_array($soft->id, $added) ? 'checked' : '' }}>
                                            {{ $soft->name }}
                                        </label>
                                    </div>
                                @endforeach
                                <button class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        {{-- @endif --}}
    @endif
    
</div>
