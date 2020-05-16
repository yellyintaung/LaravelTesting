@extends('layouts.app')

@section('content')

@if($errors->any())
<div class="alert alert-warning">
    <ol>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ol>
</div>
@endif

<div class="container">
    <form method="post">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea name="body" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category_id">
                @foreach($categories as $category)
                <option value="{{ $category['id'] }}">
                    {{ $category['name'] }}
                </option>
                @endforeach
            </select>
        </div>
        <input type="submit" value="Add Article"
        class="btn btn-primary">
    </form>
</div>
@endsection
