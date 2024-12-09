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
        
        <form action="{{ route('supplier.store') }}" method="POST"  enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tedarikçi Adı</label>
                <input type="text" class="form-control" name="name" id="exampleFormControlInput1" value="deneme">
            </div>
            <br>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tedarikçi Tam Ad</label>
                <input type="text" class="form-control" name="full" id="exampleFormControlInput1" value="deneme">
            </div>
            <br>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Banka</label>
                <input type="text" class="form-control" name="bank" id="exampleFormControlInput1" value="deneme">
            </div>
            <br>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">IBAN</label>
                <input type="text" class="form-control" name="iban" id="exampleFormControlInput1" value="deneme">
            </div>
            <br>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">VKN</label>
                <input type="text" class="form-control" name="vkn" id="exampleFormControlInput1" value="deneme">
            </div>
            <br>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Vergi Dairesi</label>
                <input type="text" class="form-control" name="vd" id="exampleFormControlInput1" value="deneme">
            </div>
            <br>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Adres</label>
                <input type="text" class="form-control" name="adress" id="exampleFormControlInput1" value="deneme">
            </div>
            <br>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Telefon</label>
                <input type="tel" class="form-control" name="tel" id="exampleFormControlInput1" value="05426307649">
            </div>
            <br>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">İletişimdeki Çalışan</label>
                <input type="tel" class="form-control" name="contact_person" id="exampleFormControlInput1" value="deneme">
            </div>
            <br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Firma Logosu</label>
                <input type="file" class="form-control" name="logo" id="exampleFormControlInput1" accept="image/*">
            </div>
            <br>
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Not</label>
                <br>
                <textarea class="form-control" name="note" >deneme</textarea>
            </div>
            <br>
            <!-- Diğer form alanları buraya eklenebilir -->

            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
	</div>

@endsection






