@forelse($collection as $val)

<div class="item">
    <div class="row">

        <div class="image">
            <img src="/{{image_thumb_resize_canvas($val->getCartField('image'),300)}}"  alt="{{$val->getCartField('title')}}">
        </div>

        <div class="desc">
            <h3>{{$val->getCartField('title')}}</h3>
            <p>{{$val->getCartField('description')}}</p>
        </div>

        <div class="info">
            <div class="amount">
                <lable>Вколичестве</lable>
                <p>{{$val->getCartField('amount')}} шт</p>
            </div>

            <div class="cost">
                <lable>Цена</lable>
                <p class="func">{{$val->getCartField('price')}}р * {{$val->getCartField('amount')}}шт</p>
                <p class="summ">{{$val->getCartField('cost')}}р</p>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="control">
            <a data-cart-clear="{{$val->getCartField('id')}}"
               data-cart-action-val="Выполняется"
               class="clear" href="/cart/clear/{{$val->getCartField('id')}}">Убрать</a>
            <a data-cart-remove="{{$val->getCartField('id')}}"
               data-cart-action-val="Удаляем"
               class="remove" href="/cart/remove/{{$val->getCartField('id')}}">-</a>
            <a data-cart-add="{{$val->getCartField('id')}}"
               data-cart-action-val="Добовляем"
               class="add" href="/cart/add/{{$val->getCartField('id')}}">+</a>
        </div>
    </div>
</div>
@empty
<div class="item">
   <div class="row">
       <div class="empty">
           <h3>В корзине пусто</h3>
       </div>
   </div>
</div>
@endforelse