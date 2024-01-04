<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Home</title>
    @include('store')
</head>
<body>


    <main>
        <section class="categories">
            <h2>Categories</h2>
            <div class="category-list">
                @foreach ($categories as $category)
                    <a href="{{ route('categories.show', ['category' => $category->name]) }}" class="category">
                        <div class="category-image">
                        <img src="{{ $category->image }}" alt="{{ $category->category_name }}">
                        </div>
                        <div class="category-name">{{ $category->name }}</div>
                <form action="{{route('categories.edit',$category->id)}}">
                  <button>Update</button>
                </form>
                <form action="{{route('categories.destroy',$category->id)}}" method="post">
                  @method('DELETE')
                  @csrf
                 <button>Delete</button>
                </form>
                    </a>
                @endforeach
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Your E-Commerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
