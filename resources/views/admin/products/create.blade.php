@extends('layout.app')
@section('title','Ürün Ekle')
@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Yeni Ürün Ekle</h3>
        </div>
        <div class="card-body">
            <br>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Barkod -->
                    <div class="col-md-6 mb-3">
                        <label for="barcode" class="form-label">Barkod</label>
                        <input type="text" class="form-control" id="barcode" name="barcode" required value="1234">
                    </div>

                    <!-- Adı -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Adı</label>
                        <input type="text" class="form-control" id="name" name="name" required value="1234">
                    </div>
                </div>

                <div class="row">
                    <!-- Açıklama -->
                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Açıklama</label>
                        <textarea class="form-control" id="description" name="description" rows="3">ddd</textarea>
                    </div>
                </div>

                <div class="row">
                    <!-- Stok Miktarı -->
                    <div class="col-md-4 mb-3">
                        <label for="stock_quantity" class="form-label">Stok Miktarı</label>
                        <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required value="1234">
                    </div>

                    <!-- Birim -->
                    <div class="col-md-4 mb-3">
                        <label for="unit" class="form-label">Birim</label>
                        <input type="text" class="form-control" id="unit" name="unit" required value="adet">
                    </div>

                    <!-- Stok Uyarı Sayısı -->
                    <div class="col-md-4 mb-3">
                        <label for="stock_warning_quantity" class="form-label">Stok Uyarı Sayısı</label>
                        <input type="number" class="form-control" id="stock_warning_quantity" name="stock_warning_quantity" required value="1234">
                    </div>
                </div>

                <div class="row">
                    <!-- Alış Fiyatı -->
                    <div class="col-md-4 mb-3">
                        <label for="purchase_price" class="form-label">Alış Fiyatı</label>
                        <input type="number" step="1" class="form-control" id="purchase_price" name="purchase_price" required value="1234">
                    </div>

                    <!-- Satış Fiyatı -->
                    <div class="col-md-4 mb-3">
                        <label for="sale_price" class="form-label">Satış Fiyatı</label>
                        <input type="number" step="1" class="form-control" id="sale_price" name="sale_price" required value="1234">
                    </div>

                    <!-- İskonto -->
                    <div class="col-md-4 mb-3">
                        <label for="discount" class="form-label">İskonto(%)</label>
                        <input type="number" step="1" class="form-control" id="discount" name="discount" value="12">
                    </div>
                </div>

                <div class="row">
                    <!-- KDV -->
                    <div class="col-md-4 mb-3">
                        <label for="vat" class="form-label">KDV(%)</label>
                        <input type="number" step="1" class="form-control" id="vat" name="vat" required value="12">
                    </div>

                    <!-- Para Birimi -->
                    <div class="col-md-4 mb-3">
                        <label for="currency_id" class="form-label">Para Birimi</label>
                        <select class="form-select" id="currency_id" name="currency_id" required>
                            <option value="" disabled selected>Para Birimi Seçin</option>
                            @foreach ($currencies as $currency )
                                <option value="{{$currency->id}}">{{$currency->name}}({{$currency->symbol}})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kategori -->
                    <div class="col-md-4 mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="" disabled selected>Kategori Seçin</option>
                            @foreach ($categories as $category )
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Resim -->
                    <div class="col-md-12 mb-3">
                        <label for="image" class="form-label">Ürün Resmi</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Ürün Ekle</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection