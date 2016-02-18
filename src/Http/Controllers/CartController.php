<? namespace JetCMS\Cart\Http\Controllers;

use Request;
use Session;
use Validator;
use Mail;

use App\User;
use App\Page;
use JetCMS\Cart\Cart;

use AdminForm;
use FormItem;

use App\Http\Controllers\Controller;

class CartController extends  Controller
{

    /**
     * @return array
     */
    Public function generateCart(){
        $cost = Cart::cost();
        $size = Cart::sizeof();
        $item = Cart::item();

        return compact('cost','size','item');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    Public function getAdd($id){
        Cart::add($id);
        return redirect('/cart/item');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    Public function postAdd(){
        Cart::add(Request::input('id'));
        return  response()->json($this->generateCart());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    Public function getRemove($id){
        Cart::remove($id);
        return redirect('/cart/item');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    Public function postRemove(){
        Cart::remove(Request::input('id'));
        return  response()->json($this->generateCart());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    Public function getClear($id){
        Cart::clear($id);
        return redirect('/cart/item');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    Public function postClear(){
        Cart::clear(Request::input('id'));
        return  response()->json($this->generateCart());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    Public function getItem() {
        $val = $this->generateCart();
        $val['collection'] = Cart::getList();
        $val['cost'] = Cart::cost();
        return view('jetcms.cart::tpl.cart_item',$val);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    Public function postItem() {
        $val = $this->generateCart();
        $val['collection'] = Cart::getList();
        return view('jetcms.cart::chunk.list',$val);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    Public function getDrop() {
        Cart::drop();
        return redirect('/cart/item');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    Public function getBay(){
        return view('jetcms.cart::tpl.bay');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    Public function postBay(){
        Request::flash();

        $validator = Validator::make(
            Request::all(),
            [
                'name' => 'required',
                'telefon' => 'required|min:7'
            ],[
                'name.required'=> 'Требуется заполнить Ф.И.О.',
                'telefon.required'=> 'Требуется заполнить Телефон',
                'min'=> 'Слишком короткий номер',
            ]
        );

        $messages = null;
        if ($validator->fails())
        {
            $messages = $validator->messages();
        }else{
            $this->baySuccess();
            Cart::drop();
            return redirect(config('jetcms.cart.redirect_bay_success'));
        }

        return view('jetcms.cart::tpl.bay',compact('messages'));
    }

    /**
     * @return array
     */
    protected function getItemCartEmail(){
        return [
            'list' => Cart::getList(),
            'item' => Cart::item(),
            'cost'=>Cart::cost(),
            'size' => Cart::sizeof(),
            'name' => Request::get('name'),
            'telefon' => Request::get('telefon'),
            'dostavka' => Request::get('dostavka'),
            'adress' => Request::get('adress'),
            'name_site' => 'Название сайта',
            'title' => 'Оформилен заказ',
            'description' => 'Содержимое корзины'
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function baySuccess(){

        Mail::send('jetcms.cart::tpl.email', $this->getItemCartEmail(), function($message)
        {
            $user = User::whereIn('id',config('jetcms.cart.email'))->get();
            foreach($user as $val) {
                $message->to($val->email, $val->first_name.' '.$val->last_name)->subject('Оформления корзины!');
            }
        });
        return redirect(config('jetcms.cart.redirect_bay_success'));
    }
}