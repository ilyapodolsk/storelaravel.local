<x-main-layout>
    <x-slot name="title">{{ $movie->title }}</x-slot>
    <x-slot name="right">
            <table id="hornav">
            <tr>
                <td>
                    <a href="{{ route('index') }}">Главная</a>
                </td>
                <td>
                    <img src="" alt="" />
                </td>
                <td>
                    <a href="{{ route('section', ['id' => $category->id]) }}">{{ $category->title }}</a>
                </td>
                <td>
                    <img src="" alt="" />
                </td>
                <td>{{ $movie->title }}</td>
            </tr>
        </table>

        <table id="product">
            <tr>
                <td class="product_img">
                    <img src="/images/products/{{ $movie->alias }}.jpg" alt="{{ $movie->title }}" />
                </td>
                <td class="product_desc">
                    <p>Название: <span class="title">{{ $movie->title }}</span></p>
                    <p>Год выхода: <span>{{ $movie->date }}</span></p>
                    <p>Жанр: <span>{{ $category->title }}</span></p>
                    <p>Страна-производитель: <span>{{ $movie->country }}</span></p>
                    <p>Режиссёр: <span>{{ $movie->producer }}</span></p>
                    <p>Продолжительность: <span>{{ $movie->duration }}</span></p>
                    <p>В ролях: <span>{{ $movie->actors }}</span></p>
                    <table>
                        <tr>
                            <td>
                                <p class="price">{{ $movie->price }} руб.</p>
                            </td>
                            <td>
                                <form action="/" method="POST">
                                    @csrf
                                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                    <input type="hidden" name="movie_price" value="{{ $movie->price }}">
                                    <button type="submit" class="link_cart" style="border: none; cursor: pointer;"></button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="desc_title">Описание:</p>
                    <p class="desc">{{ $movie->description }}</p>
                </td>
            </tr>
        </table>

        <div id="others">
            <h3>С этим товаром также заказывают:</h3>
            <table class="products">
                <tr>
                    @foreach ($movies as $movie)
                    <td>
                        <div class="intro_product">
                            <p class="img">
                            <img src="/images/products/{{ $movie->alias }}.jpg" alt="{{ $movie->title }}" />
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
            </table>
        </div>	
    </x-slot>
</x-main-layout>