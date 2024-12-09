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
<div class="container">
    <h1>Kategoriler</h1><button class="btn btn-success" style="display: inline;">Yeni Kategori Ekle</button>
    @foreach($categories as $category)
    <ul>
        <li>
            <strong>{{ $category->name }}</strong>
            @if($category->children->isNotEmpty())
                <ul>
                    @foreach($category->children as $child)
                    <li>{{ $child->name }}</li>
                    @endforeach
                </ul>
            @else
            <ul>
                <li>Alt Kategori Yok</li>
            </ul>

            @endif
        </li>
    </ul>
@endforeach

    <div class="accordion" id="categoryAccordion">
        @foreach($categories as $category)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $category->id }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" aria-expanded="true" aria-controls="collapse{{ $category->id }}">
                        {{ $category->name }}
                    </button>
                </h2>
                <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $category->id }}" data-bs-parent="#categoryAccordion">
                    <div class="accordion-body">
                        <!-- Alt kategoriler burada listelenecek -->
                        <ul class="subcategories" id="subcategories-{{ $category->id }}">
                            <!-- Alt kategoriler AJAX ile yüklenecek -->
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- JavaScript -->
<script>
$(document).ready(function() {

    $('.accordion-button').on('click', function() {
        var categoryId = $(this).attr('data-bs-target').replace('#collapse', '');

        var subcategoriesContainer = $('#subcategories-' + categoryId);


            $.get('/category/' + categoryId + '/subcategories', function(data) {
                console.log("Received subcategories:", data); // Gelen veriyi kontrol et

                if (data && data.length > 0) {
                    data.forEach(function(subcategory) {
                        subcategoriesContainer.append('<li>' + subcategory.name + '</li>');
                    });
                } else {
                    subcategoriesContainer.append('<li>Alt kategori bulunmamaktadır.</li>');
                }
            }).fail(function(xhr, status, error) {
                subcategoriesContainer.append('<li>Alt kategori yüklenemedi.</li>');
                console.log("Error fetching subcategories: " + error);
            });
    });
});



</script>

@endsection