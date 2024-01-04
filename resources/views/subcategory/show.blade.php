<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/subCategory.css') }}">
    <title>{{ $subCategory->name }} Details</title>
</head>
<body>

    <div class="subCategory-details">
        <div class="subCategory-image">
            <img src="{{asset('/' . $subCategory->image) }}" alt="{{ $subCategory->name }}">
        </div>
        <div class="subCategory-info">
            <h2>{{ $subCategory->name }}</h2>
  <form action="{{route('subcategories.update',$subCategory->id)}}">
     <button>Update</button>
  </form>
  <form action="{{route('subcategories.delete',$subCategory->id)}}" method="post">
    @method('DELETE')
    @csrf
    <button>Delete</button>
</form>
@else
  <form action="{{ route('subcategories.show', ['id' => $subCategory->id]) }}" method="POST">
    @csrf
    <button type="submit">Buy Now</button>
</form>

</div>
        </div>

    </div>
</body>
</html>
