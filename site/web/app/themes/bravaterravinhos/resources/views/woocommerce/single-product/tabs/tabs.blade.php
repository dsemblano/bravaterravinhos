@php
    global $product;

    $product_tabs = apply_filters('woocommerce_product_tabs', []);
@endphp

@if (!empty($product_tabs))
    <div class="woocommerce-tabs wc-tabs-wrapper my-16 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        {{-- Navegação das Abas (Estilo Nav Limpa) --}}
        <ul class="tabs wc-tabs flex flex-col md:flex-row gap-2 md:gap-8 border-b border-gray-100 pb-4 mb-8"
            role="tablist">
            @foreach ($product_tabs as $key => $product_tab)
                <li class="{{ esc_attr($key) }}_tab @if ($loop->first) active @endif group"
                    id="tab-title-{{ esc_attr($key) }}" role="tab" aria-controls="tab-{{ esc_attr($key) }}">
                    <a href="#tab-{{ esc_attr($key) }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg text-lg font-medium text-gray-600 transition hover:bg-gray-50 hover:text-primary active-tab-style">

                        {{-- Ícone condicional (Opcional, mas dá o toque Néctar) --}}
                        @if ($key === 'description')
                            <svg class="w-5 h-5 opacity-70 group-[.active]:opacity-100" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                        @elseif($key === 'reviews')
                            <svg class="w-5 h-5 opacity-70 group-[.active]:opacity-100" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.916c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                        @endif

                        {{ wp_kses_post(apply_filters('woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key)) }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Conteúdo das Painéis --}}
        @foreach ($product_tabs as $key => $product_tab)
            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--{{ esc_attr($key) }} panel entry-content wc-tab @if (!$loop->first) hidden @endif"
                id="tab-{{ esc_attr($key) }}" role="tabpanel" aria-labelledby="tab-title-{{ esc_attr($key) }}">

                {{-- Customização específica para a Descrição --}}
                @if ($key === 'description')
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed font-serif">
                        {{-- Removemos o título redundante "Description" daqui se ele já está na aba --}}
                        {{-- @php call_user_func($product_tab['callback'], $key, $product_tab) @endphp --}}

                        {{-- Renderizamos o conteúdo puro --}}
                        {!! rawurldecode($product->get_description()) !!}
                    </div>
                @else
                    {{-- Outras abas (como Reviews) mantêm o comportamento padrão --}}
                    @php call_user_func($product_tab['callback'], $key, $product_tab) @endphp
                @endif

            </div>
        @endforeach

        @php do_action('woocommerce_product_after_tabs'); @endphp
    </div>
@endif
