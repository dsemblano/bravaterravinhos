@php global $product; @endphp

<div class="text-2xl font-bold text-secondary">
{!! $product->get_price_html() !!}
</div>
