<x-main-layout>
    <x-slot name="title">Оформление заказа</x-slot>
    <x-slot name="right">
            <div id="order">
            <h2>Оформление заказа</h2>
            @if ($errors->any())
                @foreach ($errors->all() as $message)
                    <p class="message">{{ $message }}</p>
                @endforeach
            @endif
            <form name="order" action="{{ route('order') }}" method="post">
                @csrf
                <table>
                    <tr>
                        <td class="w120">ФИО:</td>
                        <td>
                            <input type="text" name="name" value="{{ old('name') }}" />
                        </td>
                    </tr>
                    <tr>
                        <td>Телефон:</td>
                        <td>
                            <input type="text" name="phone" value="{{ old('phone') }}" />
                        </td>
                    </tr>
                    <tr>
                        <td>E-mail:</td>
                        <td>
                            <input type="text" name="email" value="{{ old('email') }}" />
                        </td>
                    </tr>
                    <tr>
                        <td>Доставка:</td>
                        <td>
                            <select name="delivery" onchange="changeDelivery(this)">
                                <option value="">выберите, пожалуйста...</option>
                                <option value="0" >Доставка</option>
                                <option value="1" >Самовывоз</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr id="address">
                        <td>
                            <p>Полный адрес (Страна, город, индекс, улица, дом, квартира):</p>
                            <textarea name="address" cols="80" rows="6"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Примечание к заказу:</p>
                            <textarea name="notice" cols="80" rows="6"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="button">
                            <input type="hidden" name="func" value="order" />
                            {!! htmlFormSnippet() !!}
                            <input type="image" src="images/order_end.png" alt="Закончить оформление заказа" onmouseover="this.src='images/order_end_active.png'" onmouseout="this.src='images/order_end.png'" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </x-slot>
</x-main-layout>