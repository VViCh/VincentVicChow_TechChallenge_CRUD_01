@extends('layout.app')

@section('content')
<h1>Create New Product</h1>

<form id="createProductForm" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
    </div>

    <div>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required step="0.01">
    </div>

    <div>
        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" required>
    </div>

    <div>
        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required>
    </div>

    <div>
        <label for="sku">SKU:</label>
        <input type="text" name="sku" id="sku" required>
    </div>

    <div>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image">
    </div>

    <button type="button" onclick="createProduct()">Create Product</button>
</form>

<script>
    function createProduct() {
        const formData = new FormData(document.getElementById('createProductForm'));

        fetch('/api/products', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            alert('Product created successfully!');
            window.location.href = '/';
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endsection