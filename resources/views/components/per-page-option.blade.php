<div class="">
    <select id="perPage" class="form-control" name="perPage" onchange="window.location.href='?perPage='+this.value"
        style="width:100px">
        {{-- @if (!request('perPage'))
            <option value="" disabled selected>jumlah</option>
        @endif --}}
        @foreach ($perPageOption as $item)
            <option value="{{ $item }}" {{ request('perPage') == $item ? 'selected' : '' }}>{{ $item }}
            </option>
        @endforeach
    </select>
</div>
