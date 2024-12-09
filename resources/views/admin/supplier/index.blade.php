@extends('layout.app')
@section('title', 'Tedarikçiler') 
@section('page', 'Entegreler') 
@section('detail', 'Aktif Veri Gelen Entegreler') 
@section('css')
<style>

.delete-button {
    
    color: rgb(0, 0, 0); /* Beyaz yazı rengi */
    border: none; /* Kenar yok */
    padding: 8px 12px; /* İçerik boşluğu */
    border-radius: 5px; /* Köşe yuvarlama */
    cursor: pointer; /* İmleç el */
}

.delete-button:hover {
    background-color: #d32f2f; /* Hover durumunda daha koyu kırmızı */
}
</style>

@endsection
@section('content') 
<div class="container">
<button type="button"  onclick="window.location='{{ route('supplier.create') }}'" class="btn btn-success">Yeni Tedarikçi Ekle</button>
	<div class="row">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">Tedarikçi Adı</th>
                <th scope="col">Tedarikçi Tam Adı</th>
                <th scope="col">Tedarikçi Yetkilisi</th>
                <th scope="col">Durum</th>
                <th scope="col">İşlemler</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                <tr>
                    <th><img src="{{ $supplier->company_logo ? asset('uploads/suppliers/' . $supplier->company_logo) : asset('uploads/suppliers/supplier.png') }}" alt="Logo" width="50rem"></th>
                    <th>{{ $supplier->company_name }}</th>
                    <th>{{ $supplier->company_full_name }}</th>
                    <th>{{ $supplier->contact_person }}</th>
                    <th>{{ $supplier->status ==='active' ? 'Aktif' :'Pasif' }}</th>
                    <th>
                        <button type="button" class="btn" onclick="window.location='{{ route('supplier.show', $supplier->id) }}'"><i class="fa-solid fa-eye"></i></button> 
                        <button type="button" class="btn" onclick="window.location='{{ route('supplier.edit', $supplier->id) }}'"><i class="fa-solid fa-pen-to-square"></i></button> 
                        <button type="button" class="btn delete-button" data-url="{{ route('supplier.destroy', $supplier->id) }}"><i class="fa-solid fa-trash"></i> Sil</button>
                    </th>
                </tr>
        @endforeach
        </tbody>
    </table>
	</div>
    <div class="pagination-wrapper">
    {{ $suppliers->links('pagination::bootstrap-4') }}
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
                        'Entegre başarıyla silindi.',
                        'success'
                    ).then(() => {
                        location.reload(); // Sayfayı yeniden yükle
                    });
                },
                error: function(xhr) {
                    // Hata mesajını göster
                    Swal.fire(
                        'Hata!',
                        'Bir hata oluştu: ' + xhr.responseText,
                        'error'
                    );
                }
            });
        }
    });
});


</script>
@endsection





