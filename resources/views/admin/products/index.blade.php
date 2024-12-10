@extends('layout.app')
@section('title','Ürünler')
@section('content')
<div class="container">
    <button type="button"  onclick="window.location='{{ route('products.create') }}'" class="btn btn-success">Yeni Ürün Ekle</button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
        Excel ile Ürün Yükle
    </button>
    <button type="button" onclick="window.location='{{ route('products.export') }}'" class="btn btn-warning" >Excel Dışarı Aktar</button>
    <br>
    <br>
    <br>
        <div class="row">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Ürün Adı</th>
                    <th scope="col">Ürün Barkodu</th>
                    <th scope="col">Ürün Stok</th>
                    <th scope="col">Ürün Fiyatı</th>
                    <th scope="col">Ürün Kategorisi</th>
                    <th scope="col">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <th><img src="{{ $product->image ? asset($product->image) : asset('uploads/suppliers/supplier.png') }}" alt="Logo" width="50rem"></th>
                        <th>{{ $product->name }}</th>
                        <th>{{ $product->barcode }}{{ $product->barcode }}</th>
                        <th>{{ $product->stock_quantity }} {{ $product->unit}}</th>
                        <th>{{ $product->sale_price }} {{ $product->currency->abbreviation }}</th>
                        <th>{{ $product->category->name }}</th>
                        <th>
                            {{-- <button type="button" class="btn" onclick="window.location='{{ route('products.show', $product->id) }}'"><i class="fa-solid fa-eye"></i></button>  --}}
                            <button type="button" class="btn" onclick="window.location='{{ route('products.edit', $product->id) }}'"><i class="fa-solid fa-pen-to-square"></i></button> 
                            <button type="button" class="btn delete-button" data-url="{{ route('products.destroy', $product->id) }}"><i class="fa-solid fa-trash"></i> Sil</button>
                        </th>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        </div>
        <div class="pagination-wrapper">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Excel Dosyasını Yükle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Dosya Yükleme Formu -->
                    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Excel Dosyasını Seçin</label>
                            <input type="file" class="form-control" name="file" id="file" accept=".xlsx,.xls,.csv" required>
                        </div>
                        <button type="submit" class="btn btn-success">Yükle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
<script>
    $('.delete-button').on('click', function(e) {
        e.preventDefault();

        const url = $(this).data('url');

        Swal.fire({
            title: 'Silmek istediğinizden emin misiniz?',
            text: "Bu işlem geri alınamaz!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, sil!'
        }).then((result) => {
            if (result.isConfirmed) {
                // DELETE isteği gönder
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // CSRF token gönder
                    },
                    success: function(response) {
                        // Başarı mesajını göster
                        Swal.fire(
                            'Silindi!',
                            response.success,
                            'success'
                        ).then(() => {
                            location.reload(); // Sayfayı yeniden yükle
                        });
                    },
                    error: function(xhr) {
                        // Hata mesajını göster
                        let errorMessage = 'Bir hata oluştu';
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        }
                        Swal.fire(
                            'Hata!',
                            errorMessage,
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>

@endsection