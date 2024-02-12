@if ($errors->any())
    <div class="errors">
        <h3 class="text-danger">Something went wrong</h3>
        <div class="alert alert-danger">
            <ul class="list-group mb-0 ">
                @foreach ($errors->all() as $error)
                    <li class="list-group-item bg-danger-subtle border-0">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
