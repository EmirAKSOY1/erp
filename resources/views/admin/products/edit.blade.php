@extends('layout.app')

@section('content')
<div class="container">
    <div class="card-body">
        <h2>Ürün Düzenle</h2>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Barkod -->
                <div class="col-md-6 mb-3">
                    <label for="barcode" class="form-label">Barkod</label>
                    <input type="text" class="form-control" id="barcode" name="barcode" required value="{{ old('barcode', $product->barcode) }}">
                </div>

                <!-- Adı -->
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Adı</label>
                    <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $product->name) }}">
                </div>
            </div>

            <div class="row">
                <!-- Açıklama -->
                <div class="col-md-12 mb-3">
                    <label for="description" class="form-label">Açıklama</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <div class="row">
                <!-- Stok Miktarı -->
                <div class="col-md-4 mb-3">
                    <label for="stock_quantity" class="form-label">Stok Miktarı</label>
                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required value="{{ old('stock_quantity', $product->stock_quantity) }}">
                </div>

                <!-- Birim -->
                <div class="col-md-4 mb-3">
                    <label for="unit" class="form-label">Birim</label>
                    <input type="text" class="form-control" id="unit" name="unit" required value="{{ old('unit', $product->unit) }}">
                </div>

                <!-- Stok Uyarı Sayısı -->
                <div class="col-md-4 mb-3">
                    <label for="stock_warning_quantity" class="form-label">Stok Uyarı Sayısı</label>
                    <input type="number" class="form-control" id="stock_warning_quantity" name="stock_warning_quantity" required value="{{ old('stock_warning_quantity', $product->stock_warning_quantity) }}">
                </div>
            </div>

            <div class="row">
                <!-- Alış Fiyatı -->
                <div class="col-md-4 mb-3">
                    <label for="purchase_price" class="form-label">Alış Fiyatı</label>
                    <input type="number" step="1" class="form-control" id="purchase_price" name="purchase_price" required value="{{ old('purchase_price', $product->purchase_price) }}">
                </div>

                <!-- Satış Fiyatı -->
                <div class="col-md-4 mb-3">
                    <label for="sale_price" class="form-label">Satış Fiyatı</label>
                    <input type="number" step="1" class="form-control" id="sale_price" name="sale_price" required value="{{ old('sale_price', $product->sale_price) }}">
                </div>

                <!-- İskonto -->
                <div class="col-md-4 mb-3">
                    <label for="discount" class="form-label">İskonto(%)</label>
                    <input type="number" step="1" class="form-control" id="discount" name="discount" value="{{ old('discount', $product->discount) }}">
                </div>
            </div>

            <div class="row">
                <!-- KDV -->
                <div class="col-md-4 mb-3">
                    <label for="vat" class="form-label">KDV(%)</label>
                    <input type="number" step="1" class="form-control" id="vat" name="vat" required value="{{ old('vat', $product->vat) }}">
                </div>

                <!-- Para Birimi -->
                <div class="col-md-4 mb-3">
                    <label for="currency_id" class="form-label">Para Birimi</label>
                    <select class="form-select" id="currency_id" name="currency_id" required>
                        <option value="" disabled selected>Para Birimi Seçin</option>
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}" {{ $currency->id == $product->currency_id ? 'selected' : '' }}>
                                {{ $currency->name }} ({{ $currency->symbol }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Kategori -->
                <div class="col-md-4 mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="" disabled selected>Kategori Seçin</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <!-- Resim -->
                <div class="col-md-12 mb-3">
                    <label for="image" class="form-label">Ürün Resmi</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="Ürün Resmi" class="mt-2" width="100px">
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Güncelle</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">İptal</a>
            </div>
        </form>
    </div>
</div>
@endsection
