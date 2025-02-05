<x-main-layout>
    <x-slot name="title">Корзина</x-slot>
    <x-slot name="right">
        <div id="cart">
            <h2>Корзина</h2>
            <form name="cart" action="{{ route('update.cart') }}" method="post">
                @csrf
                <table>
                    <tr>
                        <td colspan="8" id="cart_top"></td>
                    </tr>
                    <tr>
                        <td class="cart_left"></td>
                        <td colspan="2">Товар</td>
                        <td>Цена за 1 шт.</td>
                        <td>Количество</td>
                        <td>Стоимость</td>
                        <td></td>
                        <td class="cart_right"></td>
                    </tr>
                    <tr>
                        <td class="cart_left"></td>
                        <td colspan="6">
                            <hr />
                        </td>
                        <td class="cart_right"></td>
                    </tr>
                        @foreach ($movies as $movie)
                    <tr class="cart_row">
                        <td class="cart_left"></td>
                        <td class="img">
                            <img src="images/products/{{ $movie->alias }}.jpg" alt="{{ $movie->title }}" />
                        </td>
                        <td class="title">{{ $movie->title }}</td>
                        <td>{{ $movie->price }} руб.</td>
                        <td>
                        <table class="count">
                                <tr>
                                    <td>
                                         @php
                                            $count = 0;
                                            $cart = session('cart', []);
                                            foreach ($cart as $cart_movie_id) {
                                                if ($cart_movie_id == $movie->id) {  
                                                $count++;
                                                }
                                            }
                                        @endphp
                                        <input type="text" name="quantities[{{ $movie->id }}]" value="{{ $count }}" min="0"/>
                                    </td>
                                    <td>шт.</td>
                                </tr>
                            </table>
                        </td>
                        <td class="bold">{{ $movie->price * $count }} руб.</td>
                        <td>
                        <button type="submit" class="link_delete" name="delete[{{ $movie->id }}]" value="1">x удалить</button>
                        </td>
                        <td class="cart_right"></td>
                    </tr>
                        @endforeach
                    <tr>
                        <td class="cart_left"></td>
                        <td colspan="6" class="cart_border">
                            <hr />
                        </td>
                        <td class="cart_right"></td>
                    </tr>
            </form>                     
                    <tr id="discount">
                        <td class="cart_left"></td>
                        <td colspan="6">
                            <form name="discount" action="{{ route('discount.cart') }}" method="post">
                            @csrf
                                <table>
                                    <tr>
                                        <td>Введите имя купона со скидкой<br /><span>(если есть)</span></td>
                                        <td>
                                            <input type="text" name="discount" value="" />
                                        </td>
                                        <td>
                                            <input type="image" src="images/cart_discount.png" alt="Получить скидку" onmouseover="this.src='images/cart_discount_active.png'" onmouseout="this.src='images/cart_discount.png'" />
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                            @endif
                        </td>
                        <td class="cart_right"></td>
                    </tr>
                    <tr id="summa">
                        <td class="cart_left"></td>
                        <td colspan="6">
                            <p>Итого : <span>{{ session('total', 0) }} руб.</span></p>
                        </td>
                        <td class="cart_right"></td>
                    </tr>
                    <tr>
                        <td class="cart_left"></td>
                        <td colspan="2">
                            <div class="left">
                            <input type="image" src="images/cart_recalc.png" alt="Пересчитать" onmouseover="this.src='images/cart_recalc_active.png'" onmouseout="this.src='images/cart_recalc.png'" />
                            </div>
                        </td>
                        <td colspan="4">
                            <div class="right">
                                <input type="hidden" name="func" value="cart" />
                                @php
                                    $cart = session('cart', []);
                                @endphp
                                @if (!empty($cart))
                                    <a href="{{ route('order') }}">
                                        <img src="" alt="Оформить заказ" onmouseover="this.src='images/cart_order_active.png'" onmouseout="this.src='images/cart_order.png'" />
                                    </a>
                                    @else
                                        <img src="" alt="Оформить заказ (корзина пуста)" onmouseover="this.src='images/cart_order_active.png'" onmouseout="this.src='images/cart_order.png'" style="cursor: not-allowed;" />
                                @endif
                            </div>
                        </td>
                        <td class="cart_right"></td>
                    </tr>
                    <tr>
                        <td colspan="8" id="cart_bottom"></td>
                    </tr>
                </table>
        </div>
    </x-slot>
</x-main-layout>