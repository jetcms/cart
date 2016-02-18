<?php namespace JetCMS\Cart;

trait CartTrait {

    function getCartField($name,$default = null){

        $field = 'getCart'.studly_case($name);

        $value = $this->$field();
        if ($value){
            return $value;
        }
        return $default;
    }

    function getCartId() {
        return $this->id;
    }

    function getCartTitle() {
        return $this->title;
    }

    function getCartDescription() {
        if ($this->description){
            return words_limit($this->field('description', $this->description), 20);
        }else{
            return words_limit($this->field('description', $this->content), 20);
        }
    }

    function getCartContent() {
        return $this->content;
    }

    function getCartImage() {
        return $this->gallery[0];
    }

    function getCartPrice() {
        return $this->price;
    }

    function getCartCost() {
        return Cart::getAmount($this->id)*$this->price;
    }

    function getCartAmount() {
        return Cart::getAmount($this->id);
    }

    function getCartUrl() {
        return $this->url;
    }

    function getCartOutprod() {
        return $this->field('outprod',false);
    }

    function getCartArticul() {
        return $this->field('articul',false);
    }

}