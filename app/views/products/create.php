```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f5;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.1);
        }

        h1 {
            color: #198754;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .buttons {
            margin-top: 25px;
        }

        button,
        a {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        button {
            background: #198754;
            color: white;
        }

        .cancel {
            background: #6c757d;
            color: white;
            margin-left: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Add Product</h1>

    <form action="<?= base_url('products/store') ?>" method="POST">

        <div class="form-group">
            <label for="product_name">Product Name</label>

            <input
                type="text"
                id="product_name"
                name="product_name"
                required
            >
        </div>

        <div class="form-group">
            <label for="description">Description</label>

            <textarea
                id="description"
                name="description"
            ></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>

            <input
                type="number"
                id="price"
                name="price"
                step="0.01"
                min="0"
                required
            >
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>

            <input
                type="number"
                id="quantity"
                name="quantity"
                min="0"
                required
            >
        </div>

        <div class="buttons">

            <button type="submit">
                Save Product
            </button>

            <a
                href="<?= base_url('products') ?>"
                class="cancel"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

</body>
</html>
```
