@extends('layout.app')
@section('title','Müşteri Düzenle')
@section('content')
<div class="container">
    <h2>Müşteri Düzenle</h2>
    <form action="{{ route('customer.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Müşteri Tipi Seçimi -->
        <div class="mb-3">
            <label for="customer_type" class="form-label">Müşteri Tipi</label><br>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="customer_type" id="individual" value="individual" {{ $customer->customer_type == 'individual' ? 'checked' : '' }}>
                <label class="form-check-label" for="individual">Bireysel</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="customer_type" id="business" value="business" {{ $customer->customer_type == 'business' ? 'checked' : '' }}>
                <label class="form-check-label" for="business">Şirket</label>
            </div>
        </div>

        <!-- Bireysel Müşteri Alanları -->
        <div id="individual-fields" style="{{ $customer->customer_type == 'individual' ? '' : 'display: none;' }}">
            <div class="mb-3">
                <label for="first_name" class="form-label">Ad</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $customer->first_name }}">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Soyad</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $customer->last_name }}">
            </div>
            <div class="mb-3">
                <label for="tc_number" class="form-label">TC Kimlik Numarası</label>
                <input type="number" class="form-control" id="tc_number" name="tc_number" value="{{ $customer->tc_number }}">
            </div>
        </div>

        <!-- Şirket Müşteri Alanları -->
        <div id="business-fields" style="{{ $customer->customer_type == 'business' ? '' : 'display: none;' }}">
            <div class="mb-3">
                <label for="company_name" class="form-label">Firma Adı</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $customer->company_name }}">
            </div>
            <div class="mb-3">
                <label for="company_full_name" class="form-label">Firma Tam Adı</label>
                <input type="text" class="form-control" id="company_full_name" name="company_full_name" value="{{ $customer->company_full_name }}">
            </div>
            <div class="mb-3">
                <label for="vkn" class="form-label">Vergi Kimlik Numarası</label>
                <input type="number" class="form-control" id="vkn" name="vkn" value="{{ $customer->vkn }}">
            </div>
            <div class="mb-3">
                <label for="contact_person" class="form-label">İletişimdeki Kişi</label>
                <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ $customer->contact_person }}">
            </div>
        </div>

        <!-- Ortak Alanlar -->
        <div class="mb-3">
            <label for="email" class="form-label">Ülke</label>
            <input type="text" class="form-control" id="email" name="country" value="{{ $customer->country }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Banka</label>
            <input type="text" class="form-control" id="email" name="bank_name" value="{{ $customer->bank_name }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Iban</label>
            <input type="text" class="form-control" id="email" name="iban" value="{{ $customer->iban }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Telefon</label>
            <input type="tel" class="form-control" id="phone" name="phone_number" value="{{ $customer->phone_number }}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adres</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $customer->address }}">
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Not</label>
            <textarea class="form-control" id="note" name="notes">{{$customer->notes}}</textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Durum</label>
            <select class="form-select" id="status" name="status" required>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Pasif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
</div>

<!-- JavaScript ile Dinamik Alan Gösterimi -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const individualFields = document.getElementById('individual-fields');
        const businessFields = document.getElementById('business-fields');
        const individualRadio = document.getElementById('individual');
        const businessRadio = document.getElementById('business');

        function toggleFields() {
            if (individualRadio.checked) {
                individualFields.style.display = 'block';
                businessFields.style.display = 'none';
            } else {
                individualFields.style.display = 'none';
                businessFields.style.display = 'block';
            }
        }

        // İlk yüklemede kontrol et
        toggleFields();

        // Radio buton değişimlerini dinle
        individualRadio.addEventListener('change', toggleFields);
        businessRadio.addEventListener('change', toggleFields);
    });
</script>
@endsection
