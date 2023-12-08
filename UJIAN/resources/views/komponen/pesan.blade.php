@if (Session::has('berhasil'))
<div class="pt-3">
    <div class="alert alert-berhasil">
        {{Session::get('berhasil')}}
    </div>
</div>
    
@endif  
@if ($errors->any())
<div class="pt-3">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif