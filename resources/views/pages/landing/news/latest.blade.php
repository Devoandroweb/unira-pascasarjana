<div class="new-popular sticky-md-top" style="top: 1rem;">
    <div class="header bg-secondary p-3 pb-2 mb-3 rounded-top">
        <h2 class="fw-bold">#{{ __("Latest") }}</h2>
    </div>
    <div class="content">
        <div class="row">
            @php
                $news = App\Models\News::orderBy("created_at",'desc')->get()
            @endphp
            @foreach ($news as $nw)
            <div class="col-12 mb-3">
                <div class="item-popular">
                    <div class="d-flex align-items-start">
                        <img style="width: 100px;height: 100px;" class="rounded-2 me-2" src="{{$nw->getImage()}}" alt="">
                        <div class="description">
                            <div class="badge bg-danger mb-2">
                                <p class="small mb-0">{{$nw->created_at->format("d/m/Y, H:i")}}</p>
                            </div>
                            <p class="small">
                                {{$nw->title}}
                            </p>
                        </div>
                    </div>
                    @if(!$loop->last)
                    <hr class="my-1">
                    @endif
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
