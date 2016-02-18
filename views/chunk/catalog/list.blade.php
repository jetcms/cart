<div class="jet-cart__catalog-list">
    @if(isset($collection))
        @foreach($collection as $val)
            <div class="row">
                <div class="col-md-3 text-center">
                    @if ($val->getCartField('image'))

                            <a href="{{$val->getCartField('url')}}" title="{{$val->getCartField('title')}}">
                                <img style="width: 100%;max-width: 250px;"
                                     data-src="/{{image_thumb_resize_canvas($val->getCartField('image'),250,200)}}"
                                     src="/{{image_thumb_resize_canvas($val->getCartField('image'),250,200)}}"
                                     alt="{{$val->getCartField('title')}}"
                                     class="">
                            </a>


                    @endif
                </div>
                <div class="col-md-7">
                    <div class="caption">
                        <a href="{{$val->getCartField('url')}}" title="{{$val->getCartField('title')}}">
                            <h3 style="margin-top: 0px;">{{$val->getCartField('title')}}</h3>
                        </a>

                        @if ($val->getCartField('description'))
                            <p>{!! words_limit($val->getCartField('description'),20) !!}</p>
                        @else
                            <p>{!! words_limit($val->getCartField('description'),20) !!}</p>
                        @endif
                        <p>Артикуль:<strong>{{$val->getCartField('articul')}}</strong></p>



                    </div>
                </div>

                <div class="col-sm-2 text-center">
                    <p class="h4 text-danger">{{$val->getCartField('price')}}р</p>
                    <p>
                        <a href="{{$val->getCartField('url')}}">Подробнее</a>
                    </p>
                    <p>
                        <a data-cart-add="{{$val->getCartField('id')}}"
                           data-cart-action-val="Выполняется"
                           href="/cart/add/{{$val->getCartField('id')}}"
                           class="btn
                        btn-success"
                           role="button">Купить</a>
                    </p>
                    @if ($val->getCartField('outprod'))
                        <p class="text-success">Есть на складе</p>
                    @else
                        <p class="text-danger">Под заказ</p>
                    @endif
                </div>

            </div>
            <hr />
        @endforeach
        {!! $collection->appends(Request::all())->render() !!}
    @endif
</div>

