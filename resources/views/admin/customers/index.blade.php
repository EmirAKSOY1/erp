@extends('layout.app')
@section('title', 'Müşteriler') 

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
<button type="button"  onclick="window.location='{{ route('customer.create') }}'" class="btn btn-success">Yeni Müşteri Ekle</button>
	<div class="row">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Müşteri No</th>
                <th scope="col">Müşteri Tipi</th>
                <th scope="col">İsim</th>
                <th scope="col">Tam Adı(Soyad)</th>
                <th scope="col">Durum</th>
                <th scope="col">İşlemler</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <th>{{ $customer->id }}</th>
                    <th>{{ $customer->customer_type === 'individual' ? 'Bireysel' : 'Şirket' }}</th>
                    @if($customer->customer_type =='individual')
                        <th>{{ $customer->first_name }}</th>
                        <th>{{ $customer->last_name }}</th>
                    @else
                        <th>{{ $customer->company_name }}</th>
                        <th>{{ $customer->company_full_name }}</th>
                    @endif
                    <th>{{ $customer->status ==='active' ? 'Aktif' :'Pasif' }}</th>
                    <th>
                        <button type="button" class="btn" onclick="window.location='{{ route('customer.show', $customer->id) }}'"><i class="fa-solid fa-eye"></i></button> 
                        <button type="button" class="btn" onclick="window.location='{{ route('customer.edit', $customer->id) }}'"><i class="fa-solid fa-pen-to-square"></i></button> 
                        <button type="button" class="btn delete-button" data-url="{{ route('customer.destroy', $customer->id) }}"><i class="fa-solid fa-trash"></i> Sil</button>
                    </th>
                </tr>
                @endforeach
        </tbody>
    </table>
	</div>
    <div class="pagination-wrapper">
    {{-- {{ $suppliers->links('pagination::bootstrap-4') }} --}}
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
                        'Müşteri başarıyla silindi.',
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





