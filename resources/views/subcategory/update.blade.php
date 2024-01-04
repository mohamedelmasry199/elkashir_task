<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>update</title>
</head>
<body>
<form action="{{ route('subcategories.update', $subCategory->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="subCategory_name">subCategory Name</label>
    <input type="text" id="subCategory_name" name="name" value="{{ old('name', $subCategory->name) }}">
    @if ($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
    @endif
    <label for="category_id">Category ID</label>
    <input type="text" id="category_id" name="category_id" value="{{ old('category_id', $subCategory->category_id) }}">
    @if ($errors->has('category_id'))
        <span class="error">{{ $errors->first('category_id') }}</span>
    @endif

    <label for="image">subCategory Image</label>
    <input type="file" id="image" name="image">
    @if ($errors->has('image'))
       <span class="error">{{ $errors->first('image') }}</span>
    @endif

    @if(!$errors->has('image') && $subCategory->image) <!-- Check if there are no errors and there's an existing image -->
       <p>Current Image:</p>
       <img src="{{ asset('' . $subCategory->image) }}" alt="Current Image">
    @endif


    <input type="submit">
</form>

</body>
</html>
