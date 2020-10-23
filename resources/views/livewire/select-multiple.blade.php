<div>
    <div class="form-group">
        <input type="text" placeholder="Search User" wire:model="query" class="form-control">
        <div wire:loading wire:target="query">
            <ul class="list-group list-group-flush w-100" style="border-radius: 0px;">
                <li class="list-group-item search-results"><i>Searching</i></li>
            </ul>
        </div>
        @if (!empty($query))
            @forelse ($results as $i => $res)
                @if ($i != 0)
                    <ul class="list-group list-group-flush w-100" style="border-radius: 0px;">
                        <li class="list-group-item" wire:click="getSelected({{ $i }})">{{ "{$res['firstname']} {$res['lastname']} - {$res['email']}" }}</li>
                    </ul>
                @endif
            @empty
                <ul class="list-group list-group-flush w-100" style="border-radius: 0px;">
                    <li class="list-group-item">Nothing Found</li>
                </ul>
            @endforelse
        @endif
    </div>
    <div class="form-group" style="
        -webkit-tap-highlight-color: rgba(0,0,0,0);
font-family: Verdana,sans-serif;
font-size: 15px;
line-height: 1.5;
color: #000!important;
box-sizing: inherit;
min-height: 20px;
padding: 19px;
margin-bottom: 20px;
background-color: #f5f5f5;
border: 1px solid #e3e3e3;
border-radius: 4px;
box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
    ">
        {{-- @if (!empty($query)) --}}
            @forelse ($selected as $j => $select)
            <ul class="list-inline">
                <li class="list-inline-item">
                    <span class="p-5" style="background-color: #cccccc; color: #383838;"><i class="fa fa-times" wire:click="removeSelected({{ $j }})" aria-hidden="true"></i> {{ $select['email'] }}</span>
                    <input type="hidden" name="user_id[]" value="{{ $select['id'] }}">
                </li>
            </ul>
            @empty
                No user selected
            @endforelse
        {{-- @endif --}}
    </div>
</div>
