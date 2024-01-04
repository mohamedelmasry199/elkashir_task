<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/subCategories.css') }}">
    <title>Document</title>
</head>
<body>

<div class="card-container">
@foreach ($subcategories as $subCategory)
<a href="{{ route('subcategories.show',  ['category' => $subCategory->name]) }}" class="card-link">
<div class="card">
    <div class="category-image">
        <img src="{{ asset('/' . $subCategory->image) }}" alt="{{ $subCategory->name }}">
    </div>
  <h1>{{$subCategory->name}}</h1>
  <form action="{{route('subcategories.edit',$subCategory->id)}}">
     <button>Update</button>
  </form>
  <form action="{{route('subcategories.destroy',$subCategory->id)}}" method="post">
    @method('DELETE')
    @csrf
    <button>Delete</button>
</form>

</div>
@endforeach
</div>
</body>
</html>
