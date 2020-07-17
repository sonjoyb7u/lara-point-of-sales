
@if (session()->has('message'))
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('message') }} 
    </div>
@endif