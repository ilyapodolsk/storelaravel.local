<x-main-layout>
    <x-slot name="title">Страница не найдена - 404</x-slot>
    <x-slot name="right">
        <div id="other">
            <h1>Страница не найдена!</h1>
            <div id="pm">
                <p>По вашему запросу ничего не найдено! Пожалуйста, проверьте правильность введённых данных!</p>
                <p>
                    <a href="{{ route('index') }}">Вернуться на главную</a>
                </p>
            </div>
        </div>
    </x-slot>
</x-main-layout>