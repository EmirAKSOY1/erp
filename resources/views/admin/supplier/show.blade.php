@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">{{ $supplier->company_name }} - Detaylar</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ $supplier->company_logo ? asset('uploads/suppliers/' . $supplier->company_logo) : asset('uploads/suppliers/supplier-256.png') }}" class="card-img-top mx-auto d-block" alt="Firma Logo" style="width: 50%; height: auto;">
                <div class="card-body">
                    <h5 class="card-title">{{ $supplier->company_name }}</h5>
                    <p class="card-text"><strong>Firma Adı:</strong> {{ $supplier->company_full_name }}</p>
                    <p class="card-text"><strong>Telefon:</strong> {{ $supplier->phone_number }}</p>
                    <p class="card-text"><strong>Adres:</strong> {{ $supplier->address }}</p>
                    <p class="card-text"><strong>İletişimdeki Kişi:</strong> {{ $supplier->contact_person }}</p>
                    <a href="{{ route('supplier.index') }}" class="btn btn-primary">Tedarikçi Listesine Dön</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detaylar</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Vergi Numarası:</strong> {{ $supplier->tax_number }}</li>
                        <li class="list-group-item"><strong>Vergi Dairesi:</strong> {{ $supplier->tax_office }}</li>
                        <li class="list-group-item"><strong>IBAN:</strong> {{ $supplier->iban }}</li>
                        <li class="list-group-item"><strong>Banka Adı:</strong> {{ $supplier->bank_name }}</li>
                        <li class="list-group-item"><strong>Durum:</strong> 
                            <span class="badge {{ $supplier->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ $supplier->status === 'active' ? 'Aktif' : 'Pasif' }}
                            </span>
                        </li>
                        <li class="list-group-item"><strong>Notlar:</strong> {{ $supplier->notes }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
