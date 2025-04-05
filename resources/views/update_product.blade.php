@extends('layout.app')

@section('content')
<h1>Update Product</h1>

<form id="updateProductForm" enctype="multipart/form-data">
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
        <div id="currentImage"></div>
    </div>

    <button type="button" onclick="updateProduct()">Update Product</button>
</form>

<script>
    const productId = window.location.pathname.split('/').pop();

    function fetchProductData() {
        fetch(`/api/products/${productId}`)
            .then(response => response.json())
            .then(product => {
                document.getElementById('name').value = product.name;
                document.getElementById('description').value = product.description;
                document.getElementById('price').value = product.price;
                document.getElementById('stock').value = product.stock;
                document.getElementById('category').value = product.category;
                document.getElementById('sku').value = product.sku;

                const currentImage = document.getElementById('currentImage');
                if (product.image_url) {
                    currentImage.innerHTML = `<img src="${product.image_url}" alt="Product Image" width="50">`;
                } else {
                    currentImage.innerHTML = 'No image available';
                }
            })
            .catch(error => console.error('Error fetching product data:', error));
    }

    function updateProduct() {
        const formData = new FormData(document.getElementById('updateProductForm'));

        fetch(`/api/products/${productId}`, {
            method: 'PUT',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            alert('Product updated successfully!');
            window.location.href = '/';
        })
        .catch(error => console.error('Error updating product:', error));
    }

    document.addEventListener('DOMContentLoaded', fetchProductData);
</script>
@endsection