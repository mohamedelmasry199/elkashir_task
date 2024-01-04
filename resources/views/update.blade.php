<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="category_name">Category Name</label>
    <input type="text" id="category_name" name="name" value="{{ old('name', $category->name) }}">
    @if ($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
    @endif
    <label for="image">Product Image</label>
    <input type="file" id="image" name="image">
    @if ($errors->has('image'))
       <span class="error">{{ $errors->first('image') }}</span>
    @endif

    @if(!$errors->has('image') && $category->image) <!-- Check if there are no errors and there's an existing image -->
       <p>Current Image:</p>
       <img src="{{ asset('' . $category->image) }}" alt="Current Image">
    @endif


    <input type="submit">
</form>


</body>
</html>
