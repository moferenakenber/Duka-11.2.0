<!-- Show View for product -->

@extends('layouts.app')

@section('content')
    <h1>Show product Details</h1>
    <p><strong>Id:</strong> {{ $product->id }}</p><p><strong>UserId:</strong> {{ $product->userId }}</p><p><strong>Title:</strong> {{ $product->title }}</p><p><strong>MetaTitle:</strong> {{ $product->metaTitle }}</p><p><strong>Slug:</strong> {{ $product->slug }}</p><p><strong>Summary:</strong> {{ $product->summary }}</p><p><strong>Type:</strong> {{ $product->type }}</p><p><strong>Sku:</strong> {{ $product->sku }}</p><p><strong>Price:</strong> {{ $product->price }}</p><p><strong>Discount:</strong> {{ $product->discount }}</p><p><strong>Quantity:</strong> {{ $product->quantity }}</p><p><strong>Shop:</strong> {{ $product->shop }}</p><p><strong>CreatedAt:</strong> {{ $product->createdAt }}</p><p><strong>UpdatedAt:</strong> {{ $product->updatedAt }}</p><p><strong>PublishedAt:</strong> {{ $product->publishedAt }}</p><p><strong>StartsAt:</strong> {{ $product->startsAt }}</p><p><strong>EndsAt:</strong> {{ $product->endsAt }}</p><p><strong>Content:</strong> {{ $product->content }}</p>
    <a href="{{ route('product.edit', $product->id) }}">Edit</a>
    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection