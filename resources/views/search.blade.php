<x-main-layout>
    <x-slot name="title">Поиск: {{ $search_add }}</x-slot>
    <x-slot name="right">
            <div id="search_result">
            <h2>Результаты поиска: {{ $search_add }}</h2>
            <table>
                <tr>
                    <td rowspan="2">
                        <div class="header">
                            <h3>Поиск</h3>
                        </div>
                    </td>
                    <td class="section_bg"></td>
                    <td class="section_right"></td>
                </tr>
            </table>
            <table class="products">
    @if (!count($movies))
        <div id="other">
            <h1>Результат поиска: {{ $search_add }}</h1>
            <div id="pm">
                <p>По вашему запросу ничего не найдено!</p>
                <p>
                    <a href="{{ route('index') }}">Вернуться на главную</a>
                </p>
            </div>
        </div>
    @else
        <tr>
            @foreach ($movies as $key => $movie)
                <td>
                    <div class="intro_product">
                        <p class="img">
                            <img src="images/products/{{ $movie->alias }}.jpg" alt="{{ $movie->title }}" />
                        </p>
                        <p class="title">
                            <a href="{{ route('product', ['movie' => $movie->id]) }}">{{ $movie->title }}</a>
                        </p>
                        <p class="price">{{ $movie->price }} руб.</p>
                        <p>
                            <form action="/" method="POST">
                                @csrf
                                <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                <input type="hidden" name="movie_price" value="{{ $movie->price }}">
                                <button type="submit" class="link_cart" style="border: none; cursor: pointer;"></button>
                            </form>
                        </p>
                    </div>
                </td>
                @if (($key + 1) % 4 == 0)
                    </tr><tr>
                @endif
            @endforeach
        </tr>
    @endif
</table>
        </div>
    </x-slot>
</x-main-layout>