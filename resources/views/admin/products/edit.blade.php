<!-- Edit View for product -->

@extends('admin.layouts.app')

@section('content')
  <h1>Edit product</h1>
  <form action="{{ route('product.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="userId">UserId</label>
    <input type="text" name="userId" id="userId" value="{{ $product->userId }}" required />
    <br />
    <br />
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="{{ $product->title }}" required />
    <br />
    <br />
    <label for="metaTitle">MetaTitle</label>
    <input type="text" name="metaTitle" id="metaTitle" value="{{ $product->metaTitle }}" required />
    <br />
    <br />
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" value="{{ $product->slug }}" required />
    <br />
    <br />
    <label for="summary">Summary</label>
    <input type="text" name="summary" id="summary" value="{{ $product->summary }}" required />
    <br />
    <br />
    <label for="type">Type</label>
    <input type="text" name="type" id="type" value="{{ $product->type }}" required />
    <br />
    <br />
    <label for="sku">Sku</label>
    <input type="text" name="sku" id="sku" value="{{ $product->sku }}" required />
    <br />
    <br />
    <label for="price">Price</label>
    <input type="text" name="price" id="price" value="{{ $product->price }}" required />
    <br />
    <br />
    <label for="discount">Discount</label>
    <input type="text" name="discount" id="discount" value="{{ $product->discount }}" required />
    <br />
    <br />
    <label for="quantity">Quantity</label>
    <input type="text" name="quantity" id="quantity" value="{{ $product->quantity }}" required />
    <br />
    <br />
    <label for="shop">Shop</label>
    <input type="text" name="shop" id="shop" value="{{ $product->shop }}" required />
    <br />
    <br />
    <label for="createdAt">CreatedAt</label>
    <input type="text" name="createdAt" id="createdAt" value="{{ $product->createdAt }}" required />
    <br />
    <br />
    <label for="updatedAt">UpdatedAt</label>
    <input type="text" name="updatedAt" id="updatedAt" value="{{ $product->updatedAt }}" required />
    <br />
    <br />
    <label for="publishedAt">PublishedAt</label>
    <input type="text" name="publishedAt" id="publishedAt" value="{{ $product->publishedAt }}" required />
    <br />
    <br />
    <label for="startsAt">StartsAt</label>
    <input type="text" name="startsAt" id="startsAt" value="{{ $product->startsAt }}" required />
    <br />
    <br />
    <label for="endsAt">EndsAt</label>
    <input type="text" name="endsAt" id="endsAt" value="{{ $product->endsAt }}" required />
    <br />
    <br />
    <label for="content">Content</label>
    <input type="text" name="content" id="content" value="{{ $product->content }}" required />
    <br />
    <br />
    <button type="submit">Update</button>
  </form>
@endsection
