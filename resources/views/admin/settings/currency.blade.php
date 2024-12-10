@extends('layout.app')
@section('title','Para Birimleri')
@section('content')
<div class="container">
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
                    <button type="button" class="btn btn-warning edit-button" data-id="{{ $currency->id }}" data-toggle="modal" data-target="#editCurrencyModal">
                        <i class="fa fa-edit"></i> Düzenle
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

<!-- Para Birimi Düzenleme Modalı -->
<div class="modal fade" id="editCurrencyModal" tabindex="-1" role="dialog" aria-labelledby="editCurrencyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCurrencyModalLabel">Para Birimi Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Para Birimi Düzenleme Formu -->
                <form id="editCurrencyForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_currencyId" name="id">

                    <div class="form-group">
                        <label for="name">Para Birimi Adı</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="symbol">Para Birimi Sembolü</label>
                        <input type="text" name="symbol" id="edit_symbol" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="abbreviation">Kısaltma</label>
                        <input type="text" name="abbreviation" id="edit_abbreviation" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="value">Kur Değeri</label>
                        <input type="number" name="rate" id="edit_value" class="form-control" required step="0.01">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Güncelle</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
                        $('#editCurrencyModal').modal('hide'); // Modal'ı gizler
        
                            // Swal ile başarı mesajı göster
                            Swal.fire(
                                'Başarılı!',
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
<script>
$(document).on('click', '.edit-button', function() {
    const currencyId = $(this).data('id');
    
    // Para birimi bilgilerini al
    $.get("{{ url('/currency') }}/" + currencyId + "/edit", function(data) {

        $('#edit_currencyId').val(data.id); // ID'yi gizli alana yerleştir
        $('#edit_name').val(data.name); // Para birimi adı
        $('#edit_symbol').val(data.symbol); // Para birimi sembolü
        $('#edit_abbreviation').val(data.abbreviation); // Kısaltma
        $('#edit_value').val(data.rate); // Kur değeri
    });
});
    // Formu gönder
    $('#editCurrencyForm').on('submit', function(e) {
        e.preventDefault();

        const formData = $(this).serialize();
        const currencyId = $('#edit_currencyId').val();
        console.log(currencyId);
        // Ajax ile veriyi güncelle
        $.ajax({
            url: "{{ url('/currency') }}/" + currencyId,
            type: 'PUT',
            data: formData,
            success: function(response) {
                $('#editCurrencyModal').modal('hide');
                Swal.fire(
                            'Silindi!',
                            response.success,
                            'success'
                        ).then(() => {
                            location.reload(); // Sayfayı yeniden yükle
                        });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert('Bir hata oluştu!');
            }
        });
    });
</script>
@endsection