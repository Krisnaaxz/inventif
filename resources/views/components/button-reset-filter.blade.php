@props(['route'])
<div>
    <button type="button" id="btn-reset" class="btn" onclick="window.location.href='{{ route($route) }}'">
        <i class="fas fa-times" style="font-size: 15px"></i>
    </button>
</div>
