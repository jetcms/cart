@extends('jetcms.core::layouts.master')

@section('body')
    <div class="jet-cart__head-list">
        <h1>Корзина</h1>
    </div>

    <div class="jet-cart__list">
        @include('jetcms.cart::chunk.list',['collection'=>$collection])
    </div>

    <div class="jet-cart__footer-list">
        <div class="info">
            <p class="cost">Общая стоимость: <span data-slot="cart-cost">{{$cost}}р</span></p>
        </div>
        <div class="control">
            <a class="drop" href="/cart/drop">Очистить корзину</a>
            <a class="bay" href="/cart/bay">Продолжить покупку</a>
        </div>
    </div>
@stop


