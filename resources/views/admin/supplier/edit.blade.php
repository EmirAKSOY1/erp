@extends('layout.app')
@section('title', 'Tedarikçiler') 
@section('css')

<style>
    .alert-dismissible {
        position: relative;
    }
    .close {
        position: absolute;
        right: 1rem;
        top: 0.5rem;
        color: inherit; /* Uyumlu renk */
        font-size: 1.25rem; /* İsteğe bağlı: daha büyük çarpı */
        opacity: 0.5; /* Çarpı için saydamlık */
    }
</style>
@endsection
@section('content') 

	<div class="container">
        
        <form action="{{ route('supplier.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- PUT metodu eklenmeli, çünkü bu bir güncelleme işlemi olacak -->
        
            <div class="mb-3">
                <label for="company_name" class="form-label">Tedarikçi Adı</label>
                <input type="text" class="form-control" name="company_name" id="company_name" value="{{ old('company_name', $supplier->company_name) }}">
            </div>
            <br>
        
            <div class="mb-3">
                <label for="company_full_name" class="form-label">Tedarikçi Tam Ad</label>
                <input type="text" class="form-control" name="company_full_name" id="company_full_name" value="{{ old('company_full_name', $supplier->company_full_name) }}">
            </div>
            <br>
        
            <div class="mb-3">
                <label for="bank_name" class="form-label">Banka</label>
                <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{ old('bank_name', $supplier->bank_name) }}">
            </div>
            <br>
        
            <div class="mb-3">
                <label for="iban" class="form-label">IBAN</label>
                <input type="text" class="form-control" name="iban" id="iban" value="{{ old('iban', $supplier->iban) }}">
            </div>
            <br>
        
            <div class="mb-3">
                <label for="tax_number" class="form-label">VKN</label>
                <input type="text" class="form-control" name="tax_number" id="tax_number" value="{{ old('tax_number', $supplier->tax_number) }}">
            </div>
            <br>
        
            <div class="mb-3">
                <label for="tax_office" class="form-label">Vergi Dairesi</label>
                <input type="text" class="form-control" name="tax_office" id="tax_office" value="{{ old('tax_office', $supplier->tax_office) }}">
            </div>
            <br>
        
            <div class="mb-3">
                <label for="address" class="form-label">Adres</label>
                <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $supplier->address) }}">
            </div>
            <br>
        
            <div class="mb-3">
                <label for="phone_number" class="form-label">Telefon</label>
                <input type="tel" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number', $supplier->phone_number) }}">
            </div>
            <br>
        
            <div class="mb-3">
                <label for="contact_person" class="form-label">İletişimdeki Çalışan</label>
                <input type="text" class="form-control" name="contact_person" id="contact_person" value="{{ old('contact_person', $supplier->contact_person) }}">
            </div>
            <br>
        
            <div class="mb-3">
                <label for="company_logo" class="form-label">Firma Logosu</label>
                <input type="file" class="form-control" name="company_logo" id="company_logo" accept="image/*">
                @if($supplier->company_logo)
                    <div class="mt-3">
                        <img src="{{ asset('uploads/suppliers/' . $supplier->company_logo) }}" alt="Firma Logo" class="img-thumbnail" style="width: 150px;">
                    </div>
                @else
                    <p>Logo bulunmamaktadır.</p>
                @endif
            </div>
            <br>
        
            <div class="mb-3">
                <label for="notes" class="form-label">Not</label>
                <textarea class="form-control" name="notes" id="notes">{{ old('notes', $supplier->notes) }}</textarea>
            </div>
            <br>
        
            <div class="mb-3">
                <label for="status" class="form-label">Durum</label>
                <select class="form-control" name="status" id="status">
                    <option value="active" {{ $supplier->status == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ $supplier->status == 'inactive' ? 'selected' : '' }}>Pasif</option>
                </select>
            </div>
            <br>
        
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
        
	</div>

@endsection






