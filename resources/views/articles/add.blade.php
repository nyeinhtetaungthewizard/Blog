@extends("layouts.app")
@section("content")
    <div class="container" style="max-width:800px">

{{-- validation code  --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err )
                    {{ $err }}
                @endforeach
            </div>
        @endif
{{-- end validation  --}}

        <form method="post">
            @csrf
            <div class="mb-2">
                <label>Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-2">
                <label>Body</label>
                <textarea name="body" class="form-control"></textarea>
            </div>
            <div class="mb-2">
                <label>Category</label>
                <select name="category_id" id="" class="form-select">
                    <option value="1">News</option>
                    <option value="2">Tech</option>
                </select>
            </div>
            <button class="btn btn-primary">Add Article</button>
        </form>
    </div>
@endsection
