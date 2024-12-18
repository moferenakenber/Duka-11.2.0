<!-- Create View for product -->

@extends('layouts.app')

@section('content')
    <h1>Create product</h1>
    <form action="{{ route('product.store') }}" method="POST">
        @csrf
        <label for='userId'>UserId</label>
                <input type='text' name='userId' id='userId' required><br><br><label for='title'>Title</label>
                <input type='text' name='title' id='title' required><br><br><label for='metaTitle'>MetaTitle</label>
                <input type='text' name='metaTitle' id='metaTitle' required><br><br><label for='slug'>Slug</label>
                <input type='text' name='slug' id='slug' required><br><br><label for='summary'>Summary</label>
                <input type='text' name='summary' id='summary' required><br><br><label for='type'>Type</label>
                <input type='text' name='type' id='type' required><br><br><label for='sku'>Sku</label>
                <input type='text' name='sku' id='sku' required><br><br><label for='price'>Price</label>
                <input type='text' name='price' id='price' required><br><br><label for='discount'>Discount</label>
                <input type='text' name='discount' id='discount' required><br><br><label for='quantity'>Quantity</label>
                <input type='text' name='quantity' id='quantity' required><br><br><label for='shop'>Shop</label>
                <input type='text' name='shop' id='shop' required><br><br><label for='createdAt'>CreatedAt</label>
                <input type='text' name='createdAt' id='createdAt' required><br><br><label for='updatedAt'>UpdatedAt</label>
                <input type='text' name='updatedAt' id='updatedAt' required><br><br><label for='publishedAt'>PublishedAt</label>
                <input type='text' name='publishedAt' id='publishedAt' required><br><br><label for='startsAt'>StartsAt</label>
                <input type='text' name='startsAt' id='startsAt' required><br><br><label for='endsAt'>EndsAt</label>
                <input type='text' name='endsAt' id='endsAt' required><br><br><label for='content'>Content</label>
                <input type='text' name='content' id='content' required><br><br>
        <button type="submit">Create</button>
    </form>
@endsection