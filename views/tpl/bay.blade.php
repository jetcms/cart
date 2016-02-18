@extends('jetcms.core::layouts.master')

@section('body')

    <div class="jet-cart__order">
        <h1>Оформление заказа</h1>

        <div class="errors">
        @if (isset($messages) and $messages)
            @foreach($messages->all() as $val)
            <div class="error">{{$val}}</div>
            @endforeach
        @endif
        </div>

        <form action="/cart/bay" method="POST">

            <div class="group">
                <label>Ваше Ф.И.О.</label>
                <input type="text" name="name" placeholder="Введите ваше имя" value="{{old('name')}}">
            </div>

            <div class="group">
                <label>Ваше телефон</label>
                <input type="text" name="telefon" placeholder="Введите ваше телефон" value="{{old('telefon')}}">
            </div>

            <div class="group">
                <label>Способ доставки</label>
                <select name="dostavka">
                    <option value="samovivoz" @if(old('dostavka') == 'samovivoz') selected @endif>Самовывоз</option>
                    <option value="dostavka" @if(old('dostavka') == 'dostavka') selected @endif>Доставка на дом</option>
                </select>
            </div>

            <div class="group">
                <label>Адрес доставки если требуется</label>
                <textarea name="adress" placeholder="Введите ваше адрес">{{old('adress')}}</textarea>
            </div>

            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="submit">
                <button type="submit">Оформить</button>
            </div>

        </form>


    </div>

@stop