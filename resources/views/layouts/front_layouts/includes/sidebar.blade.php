@php
use App\Section;
$sections = Section::sections();
@endphp

<div id="sidebar" class="span3">
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @foreach ($sections as $section)
            @if (count($section['categories']) > 0)
                <li class="subMenu"><a>{{ $section['name'] }}</a>
                    @foreach ($section['categories'] as $category)
                        <ul>
                            <li><a href="{{ url($category['category_url']) }}"><i
                                        class="icon-chevron-right"></i><strong>{{ $category['category_name'] }}</strong></a>
                            </li>
                            @foreach ($category['subcategories'] as $subcategory)
                                <li><a href="{{ url($subcategory['category_url']) }}"><i
                                            class="icon-chevron-right"></i>{{ $subcategory['category_name'] }}</a></li>
                            @endforeach
                        </ul>
                    @endforeach
                </li>
            @endif
        @endforeach
    </ul>
    <br>
    @if (isset($page_name) && $page_name == 'listing')
        <div class="well well-small">
            <h5>Fabric</h5>
            @foreach ($fabricArray as $fabric)
                <input style="margin-top: -3px;" type="checkbox" class="fabric" name="fabric[]"
                    id="{{ $fabric }}" value="{{ $fabric }}">&nbsp;&nbsp;{{ $fabric }}<br>
            @endforeach
        </div>

        <div class="well well-small">
            <h5>Pattern</h5>
            @foreach ($patternArray as $pattern)
                <input style="margin-top: -3px;" type="checkbox" class="pattern" name="pattern[]"
                    id="{{ $pattern }}" value="{{ $pattern }}">&nbsp;&nbsp;{{ $pattern }}<br>
            @endforeach
        </div>

        <div class="well well-small">
            <h5>Sleeve</h5>
            @foreach ($sleeveArray as $sleeve)
                <input style="margin-top: -3px;" type="checkbox" class="sleeve" name="sleeve[]"
                    id="{{ $sleeve }}" value="{{ $sleeve }}">&nbsp;&nbsp;{{ $sleeve }}<br>
            @endforeach
        </div>

        <div class="well well-small">
            <h5>Fit</h5>
            @foreach ($fitArray as $fit)
                <input style="margin-top: -3px;" type="checkbox" class="fit" name="fit[]"
                    id="{{ $fit }}" value="{{ $fit }}">&nbsp;&nbsp;{{ $fit }}<br>
            @endforeach
        </div>
    @endif

    <div class="thumbnail">
        <img src="{{ asset('images/front_images/payment_methods.png') }}" title="Payment Methods"
            alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>
