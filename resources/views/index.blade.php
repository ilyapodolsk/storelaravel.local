<x-main-layout>
    <x-slot name="title">Интернет-магазин</x-slot>
    <x-slot name="right">
        <table>
            <tr>
                <td rowspan="2">
                    <div class="header">
                        <h3>Новинки</h3>
                    </div>
                </td>
                <td class="section_bg"></td>
                <td class="section_right"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="sort">
                        <tr>
                            <td>Сортировать по:</td>
                            <td>цене (
                                <a href="{{ route('sort', ['sort' => 'price', 'order' => 'asc']) }}">возр.</a> |
                                <a href="{{ route('sort', ['sort' => 'price', 'order' => 'desc']) }}">убыв.</a>
                                )
                            </td>
                            <td>названию (
                                <a href="{{ route('sort', ['sort' => 'title', 'order' => 'asc']) }}">возр.</a> |
                                <a href="{{ route('sort', ['sort' => 'title', 'order' => 'desc']) }}">убыв.</a>
                                )
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="products">
        @foreach ($movies->chunk(4) as $chunkedMovies)
                <tr>
                    @foreach($chunkedMovies as $movie)
                        <td>
                            <div class="intro_product">
                                <p class="img">
                                    <img src="images/products/{{ $movie->alias }}.jpg" alt="{{ $movie->title }}" />
                                </p>
                                <p class="title">
                                    <a href="{{ route('product', ['movie' => $movie->id]) }}">{{ $movie->title }}</a>
                                </p>
                                <p class="price">{{ $movie->price }} руб.</p>
                                <form action="/" method="POST">
                                    @csrf
                                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                    <input type="hidden" name="movie_price" value="{{ $movie->price }}">
                                    <button type="submit" class="link_cart" style="border: none; cursor: pointer;"></button>
                                </form>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </x-slot>
</x-main-layout>