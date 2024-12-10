@extends('layout.app')
@section('title','Kategoriler')
@section('css')
<style>
#categoryAccordion {
    margin-top: 20px;
}

.accordion-item {
    margin-bottom: 10px;
}

.accordion-button {
    font-size: 18px;
}

.subcategories {
    list-style-type: none;
    padding-left: 20px;
}

.subcategories li {
    margin-bottom: 5px;
}
</style>
@endsection
@section('content')
<div class="container mt-5">
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        <i class="fas fa-plus"></i> Kategori Ekle
    </button>


    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Kategori Adı</th>
            <th scope="col">Kategori Açıklaması</th>
            <th scope="col">Üst Kategori</th>
            <th scope="col">İşlemler</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <th>{{ $category->name }}</th>
                <th>{{ $category->description ?? '--' }}</th>
                <td>
                    @if ($category->parent)
                        {{ $category->parent->name }}
                    @else
                        <span class="badge bg-success">Ana Kategori</span>
                    @endif
                </td>
                
                <th> 
                    <button type="button" class="btn btn-sm btn-warning edit-button" data-url="{{ route('category.edit', $category->id) }}">
                        <i class="fa-solid fa-edit"></i> Düzenle
                    </button>
                    <button type="button" class="btn delete-button" data-url="{{ route('category.destroy', $category->id) }}"><i class="fa-solid fa-trash"></i> Sil</button>
                </th>
            </tr>
            @endforeach
            </tbody>
        </table>


</div>

<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Kategori Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm">
                    @csrf
                    @method('PUT')

                    <!-- Kategori Adı -->
                    <div class="form-group">
                        <label for="edit-name">Kategori Adı</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>

                    <!-- Kategori Açıklaması -->
                    <div class="form-group mt-3">
                        <label for="edit-description">Kategori Açıklaması</label>
                        <textarea class="form-control" id="edit-description" name="description"></textarea>
                    </div>

                    <!-- Üst Kategori Seçimi -->
                    <div class="form-group mt-3">
                        <label for="edit-parent_id">Üst Kategori</label>
                        <select class="form-control" id="edit-parent_id" name="parent_id">
                            <option value="">Ana Kategori</option>
                            <!-- Seçenekler AJAX ile doldurulacak -->
                        </select>
                    </div>

                    <!-- Kaydet Butonu -->
                    <button type="submit" class="btn btn-primary mt-3">Güncelle</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Yeni Kategori Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <!-- Kategori İsmi -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Kategori İsmi</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <!-- Kategori Açıklaması -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Kategori Açıklaması</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <!-- Üst Kategori Dropdown -->
                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Üst Kategori</label>
                        <select class="form-select" id="parent_id" name="parent_id">
                            <option value="">Ana Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Form Gönderme Butonu -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
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
$('#editCategoryForm').on('submit', function(e) {
    e.preventDefault();

    const form = $(this);
    const actionUrl = form.attr('action');

    $.ajax({
        url: actionUrl,
        type: 'PUT',
        data: form.serialize(),
        success: function(response) {
            $('#editCategoryModal').modal('hide');
            Swal.fire('Başarılı!', response.success, 'success').then(() => {
                location.reload(); // Sayfayı yeniden yükle
            });
        },
        error: function(xhr) {
            let errorMessage = 'Bir hata oluştu';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            Swal.fire('Hata!', errorMessage, 'error');
        }
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