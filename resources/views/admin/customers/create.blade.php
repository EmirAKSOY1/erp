
@extends('layout.app')
@section('title','Müşteri Ekle')
@section('content')
    <div class="container">
        <h1>Yeni Müşteri Ekle</h1>

        <form action="{{ route('customer.store') }}" method="POST" id="customerForm">
            @csrf

            <!-- Müşteri Tipi (Bireysel/Şirket) -->
            <div class="mb-3">
                <label class="form-label">Müşteri Tipi</label><br>
                <input type="radio" id="individual" name="customer_type" value="individual" checked onclick="toggleFormFields()"> Bireysel
                <input type="radio" id="company" name="customer_type" value="company" onclick="toggleFormFields()"> Şirket
            </div>

            <!-- Ad / Soyad -->
            <div class="mb-3" id="individualFields">
                <label for="first_name" class="form-label">Ad</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" >

                <label for="last_name" class="form-label">Soyad</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" >

                <label for="last_name" class="form-label">TC No</label>
                <input type="text" class="form-control" id="last_name" name="tc_number" value="{{ old('tc_number') }}" >
            </div>

            <!-- Firma Adı ve Resmi Adı -->
            <div class="mb-3" id="companyFields" style="display: none;">
                <label for="company_name" class="form-label">Firma Adı</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}">
                <br>
                <label for="company_full_name" class="form-label">Resmi Firma Adı</label>
                <input type="text" class="form-control" id="company_full_name" name="company_full_name" value="{{ old('company_full_name') }}">
                <br>
                <label for="company_full_name" class="form-label">Vergi Dairesi</label>
                <input type="text" class="form-control" id="company_full_name" name="tax_office" value="{{ old('tax_office') }}">
                <br>
                <label for="company_full_name" class="form-label">Vergi Kimlik No</label>
                <input type="text" class="form-control" id="company_full_name" name="vkn" value="{{ old('vkn') }}">
                <br>
                <label for="company_full_name" class="form-label">Yetkili Kişi</label>
                <input type="text" class="form-control" id="company_full_name" name="contact_person" value="{{ old('contact_person') }}">
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Banka</label>
                <input type="text" class="form-control" id="country" name="bank_name" value="{{ old('bank_name') }}" required>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">IBAN</label>
                <input type="text" class="form-control" id="country" name="iban" value="{{ old('iban') }}" required>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Ülke</label>
                <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" required>
            </div>
            <!-- Diğer ortak alanlar -->
            <div class="mb-3">
                <label for="address" class="form-label">Adres</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Telefon Numarası</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>





            <div class="mb-3">
                <label for="note" class="form-label">Not</label>
                <textarea class="form-control" id="note" name="notes">{{ old('notes') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Durum</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Pasif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
    </div>
@endsection
@section('js')
<script>
    function toggleFormFields() {
        var customerType = document.querySelector('input[name="customer_type"]:checked').value;

        if (customerType === 'individual') {
            document.getElementById('individualFields').style.display = 'block';
            document.getElementById('companyFields').style.display = 'none';
        } else if (customerType === 'company') {
            document.getElementById('individualFields').style.display = 'none';
            document.getElementById('companyFields').style.display = 'block';
        }
    }

    window.onload = toggleFormFields;
</script>
@endsection