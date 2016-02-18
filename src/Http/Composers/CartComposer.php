<?php namespace JetCMS\Cart\Http\Composers;

use App\Page;
use JetCMS\Cart\Cart;

use Session;

use Illuminate\Contracts\View\View;

class CartComposer {

    public function compose(View $view)
    {
        $view->with('size',Cart::sizeof());
        $view->with('cost',Cart::cost());
    }

}