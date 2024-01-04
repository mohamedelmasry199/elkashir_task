<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="category_name">Category Name</label>
    <input type="text" id="category_name" name="name">
    @if ($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
    @endif
    <label for="image">Category Image</label>
    <input type="file" id="image" name="image">
    @if ($errors->has('image'))
        <span class="error">{{ $errors->first('image') }}</span>
    @endif

    <input type="submit" >
</form>

</body>
</html>
