<?php
Route::controller('cart', config('jetcms.cart.controller'));

View::composer('jetcms.cart::widgets.mini_cart', config('jetcms.cart.composer'));