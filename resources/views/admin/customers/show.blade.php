@extends('layout.app')

@section('content')
<div class="container mt-4">

    @if($customer->customer_type =='individual')
    <h2 class="text-center mb-4">Müşteri Detayları</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    
                    <h5 class="card-title">İletişim Bilgileri</h5>
                    <hr>
                    <p class="card-text"><strong>Müşteri Adı:</strong> {{ $customer->first_name }}</p>
                    <p class="card-text"><strong>Müşteri Soyadı:</strong> {{ $customer->last_name }}</p>
                    <p class="card-text"><strong>Telefon:</strong> {{ $customer->phone_number }}</p>
                    <p class="card-text"><strong>E-Mail:</strong> {{ $customer->email }}</p>
                    <p class="card-text"><strong>Ülke:</strong> {{ $customer->country }}</p>
                    <p class="card-text"><strong>Adres:</strong> {{ $customer->address }}</p>
                    <a href="{{ route('customer.index') }}" class="btn btn-primary">Müşteri Listesine Dön</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detaylar</h5>
                    <hr>
                    <ul class="list-group">
                        
                        <li class="list-group-item"><strong>Müşteri Tipi: </strong>{{ $customer->customer_type ==='individual' ?  "Bireysel" : "Şirket" }}</li>
            
                        <li class="list-group-item"><strong>TC:</strong> {{ $customer->tc_number }}</li>
                        <li class="list-group-item"><strong>Banka Adı:</strong> {{ $customer->bank_name }}</li>
                        <li class="list-group-item"><strong>Banka Adı:</strong> {{ $customer->iban }}</li>
                        <li class="list-group-item"><strong>Durum:</strong> 
                            <span class="badge {{ $customer->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ $customer->status === 'active' ? 'Aktif' : 'Pasif' }}
                            </span>
                        </li>
                        <li class="list-group-item"><strong>Notlar:</strong> {{ $customer->notes }}</li>
                        <li class="list-group-item"><strong>Notlar:</strong> {{ $customer->created_at }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @else
    <h2 class="text-center mb-4">{{ $customer->company_name }} - Detaylar</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $customer->company_name }}</h5>
                    <p class="card-text"><strong>Firma Adı:</strong> {{ $customer->company_full_name }}</p>
                    <p class="card-text"><strong>Telefon:</strong> {{ $customer->phone_number }}</p>
                    <p class="card-text"><strong>Adres:</strong> {{ $customer->address }}</p>
                    <p class="card-text"><strong>İletişimdeki Kişi:</strong> {{ $customer->contact_person }}</p>
                    <a href="{{ route('supplier.index') }}" class="btn btn-primary">Tedarikçi Listesine Dön</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detaylar</h5>
                    <hr>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Vergi Numarası:</strong> {{ $customer->tax_number }}</li>
                        <li class="list-group-item"><strong>Vergi Dairesi:</strong> {{ $customer->tax_office }}</li>
                        <li class="list-group-item"><strong>IBAN:</strong> {{ $customer->iban }}</li>
                        <li class="list-group-item"><strong>Banka Adı:</strong> {{ $customer->bank_name }}</li>
                        <li class="list-group-item"><strong>Durum:</strong> 
                            <span class="badge {{ $customer->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ $customer->status === 'active' ? 'Aktif' : 'Pasif' }}
                            </span>
                        </li>
                        <li class="list-group-item"><strong>Notlar:</strong> {{ $customer->notes }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
