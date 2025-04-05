@extends('layout.app')

@section('content')
<h1>Products</h1>

<div>
    <table border="1" cellpadding="10" cellspacing="0" id="productsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Category</th>
                <th>SKU</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="productsTableBody">
            <!-- Table rows -->
        </tbody>
    </table>
</div>

<script>
    function fetchProducts() {
        fetch('/api/products') // Ensure the URL matches the API route
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(products => {
                const tableBody = document.getElementById('productsTableBody');
                tableBody.innerHTML = '';

                products.forEach(product => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${product.id}</td>
                        <td>${product.name}</td>
                        <td>${product.description}</td>
                        <td>${product.price}</td>
                        <td>${product.stock}</td>
                        <td>${product.category}</td>
                        <td>${product.sku}</td>
                        <td>
                            ${product.image_url ? `<img src="${product.image_url}" alt="Product Image" width="50">` : 'N/A'}
                        </td>
                        <td>${product.status}</td>
                        <td>
                            <button onclick="editProduct(${product.id})">Edit</button> |
                            <button onclick="deleteProduct(${product.id})">Delete</button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching products:', error));
    }

    function editProduct(productId) {
        window.location.href = `/update/${productId}`;
    }

    function deleteProduct(productId) {
        if (confirm('Are you sure you want to delete this product?')) {
            fetch(`/api/products/${productId}`, {
                method: 'DELETE',
            })
            .then(response => {
                if (response.ok) {
                    alert('Product deleted successfully!');
                    fetchProducts();
                } else {
                    alert('Failed to delete the product.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    document.addEventListener('DOMContentLoaded', fetchProducts);
</script>
@endsection