@foreach ($publications as $item)
<div class="row">
    <div class="col-12 col-md-12 mb-5" style="text-align: justify;">
        <div class="card mb-3 w-100 border-0">
            <div class="row g-0">
                <div class="col-md-4">
                <img src="{{ Storage::url($item->cover) }}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <a class="mb-3" href="{{ $item->link }}" target="__BLANK"> {{ $item->title }}<i class="fa-solid fa-link"></i></a>
                    <h5 class="card-title fw-bold mt-2">{{ $item->no_issn }}</h5>
                    <p class="card-text">{!! $item->description !!}</p>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endforeach