<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="text-gray-dark">{{ $title }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach ($bc_data as $bc)
                    <li class="breadcrumb-item @class(['active' => $bc['is_active']])">
                        @if ($bc['is_active'])
                        {{ $bc['text'] }}
                        @else
                        <a href="{{ $bc['link'] }}">{{ $bc['text'] }}</a>
                        @endif
                    </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="hr"></div>