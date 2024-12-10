@extends('layout.app')
@section('title','Para Birimleri')
@section('content')
<div class="container mt-5">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#currencyModal">
        Yeni Para Birimi Ekle
      </button>


    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Birim Adı</th>
            <th scope="col">Birim Sembolü</th>
            <th scope="col">Kur(TL)</th>
            <th scope="col">İşlemler</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($currencies as $currency)
            <tr>
                <th>{{ $currency->name }}</th>
                <th>{{ $currency->symbol ?? '--' }}({{ $currency->abbreviation ?? '--' }})</th>
                <th>{{ $currency->rate ?? '--' }}</th>
                <th> 
                    <button type="button" class="btn btn-sm  edit-button" data-url="{{ route('category.edit', $currency->id) }}">
                        <i class="fa-solid fa-edit"></i> Düzenle
                    </button>
                    <button type="button" class="btn delete-button" data-url="{{ route('currency.destroy', $currency->id) }}"><i class="fa-solid fa-trash"></i> Sil</button>
                </th>
            </tr>
            @endforeach
            </tbody>
        </table>


</div>
<div class="modal fade" id="currencyModal" tabindex="-1" aria-labelledby="currencyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="currencyModalLabel">Yeni Para Birimi Ekle</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form for adding new currency -->
          <form id="currencyForm" method="POST" action="{{ route('currency.store') }}">
            @csrf
            
            <!-- Currency Name -->
            <div class="mb-3">
              <label for="name" class="form-label">Para Birimi Adı</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
  
            <!-- Currency Symbol -->
            <div class="mb-3">
              <label for="symbol" class="form-label">Para Birimi Sembolü</label>
              <input type="text" class="form-control" id="symbol" name="symbol" required>
            </div>
  
            <!-- Currency Abbreviation -->
            <div class="mb-3">
              <label for="abbreviation" class="form-label">Kısaltma</label>
              <input type="text" class="form-control" id="abbreviation" name="abbreviation" required>
            </div>
  
            <!-- Currency Exchange Rate -->
            <div class="mb-3">
              <label for="rate" class="form-label">Kur Değeri</label>
              <input type="number" step="0.01" class="form-control" id="rate" name="rate" required>
            </div>
  
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Ekle</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    $(document).ready(function() {
    $('.edit-button').on('click', function() {
        const url = $(this).data('url');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                // Form alanlarını doldur
                $('#edit-name').val(data.category.name);
                $('#edit-description').val(data.category.description);
                $('#edit-parent_id').empty().append('<option value="">Ana Kategori</option>');

                data.categories.forEach(function(cat) {
                    $('#edit-parent_id').append(
                        `<option value="${cat.id}" ${data.category.parent_id == cat.id ? 'selected' : ''}>${cat.name}</option>`
                    );
                });

                // Formun action URL'sini güncelle
                $('#editCategoryForm').attr('action', `/categories/${data.category.id}`);

                // Modal'ı göster
                $('#editCategoryModal').modal('show');
            },
            error: function() {
                alert('Kategori bilgileri yüklenirken bir hata oluştu.');
            }
        });
    });
});

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
                        console.log(xhr);
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