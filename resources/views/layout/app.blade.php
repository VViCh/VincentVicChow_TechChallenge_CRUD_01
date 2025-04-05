<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRUD</title>
</head>
<body>
    <nav>    
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('create_product') }}">Create New Product</a>
    </nav>
    
    <h1>CRUD Application</h1>

    <div class="container">

        @yield('content')
    </div>
</body>
</html>