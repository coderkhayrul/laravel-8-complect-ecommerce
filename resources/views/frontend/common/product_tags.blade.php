@php
    $tags_en =  App\Models\Product::groupBy('product_tag_en')->select('product_tag_en')->get();
    $tags_hin =  App\Models\Product::groupBy('product_tag_hin')->select('product_tag_hin')->get();
@endphp
<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">

        <div class="tag-list">
        @if (session()->get('language') == 'hindi')
        @foreach ($tags_hin as $tag)
        <a class="item active" title="{{ $tag->product_tag_hin }}" href="{{ url('product/tag',$tag->product_tag_hin) }}">{{ $tag->product_tag_hin }}</a>
        @endforeach

        @else

        @foreach ($tags_en as $tag)
        <a class="item active" title="{{ $tag->product_tag_en }}" href="{{ url('product/tag',$tag->product_tag_en) }}">{{ $tag->product_tag_en }}</a>
        @endforeach
        @endif
        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>

