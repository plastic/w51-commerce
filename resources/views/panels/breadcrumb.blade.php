<div class="content-header row">
  <div class="content-header-left col-md-11 col-12 mb-2">
    <div class="row breadcrumbs-top">
      <div class="col-12">
        <h2 class="content-header-title float-start mb-0">@yield('title')</h2>
        <div class="breadcrumb-wrapper">
          @if(@isset($breadcrumbs))
          <ol class="breadcrumb">
              {{-- this will load breadcrumbs dynamically from controller --}}
              @foreach ($breadcrumbs as $breadcrumb)
              <li class="breadcrumb-item">
                  @if(isset($breadcrumb['link']))
                  <a href="{{ $breadcrumb['link'] == 'javascript:void(0)' ? $breadcrumb['link']:url($breadcrumb['link']) }}">
                      @endif
                      {{$breadcrumb['name']}}
                      @if(isset($breadcrumb['link']))
                  </a>
                  @endif
              </li>
              @endforeach
          </ol>
          @endisset
        </div>
      </div>
    </div>
  </div>

  @if(@isset($btnCreate))
  <div class="content-header-right text-md-end col-md-1 col-12 d-md-block d-none">
    <div class="mb-1 breadcrumb-right d-grid pe-2">
        <a class="btn btn-primary btn-round " href="{{$btnCreate['link']}}">{{$btnCreate['name']}}</a>
    </div>
  </div>
  @endif

</div>
