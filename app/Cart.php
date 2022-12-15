<?php

namespace App;


class Cart
{
    public $contents = [];
    private $totalQty;
    private $totalPrice;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->contents   = $oldCart->contents;
            $this->totalQty   = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function addCategory($category)
    {
        array_push($this->contents,  $category->id);
        $this->totalQty++;
        $this->totalPrice   += $category->price;
    }

    public function removeCategory($category)
    {
        // $this->contents = [];
        // $this->totalQty = 0;
        // $this->totalQty = 0;
        // $this->totalPrice = 0;
        if ($this->contents) {
            $key = array_search($category->id, $this->contents);
            array_splice($this->contents, $key, 1);
        }
        if (!($this->totalQty <= 0)) {
            $this->totalQty--;
        } else {
            $this->totalQty     = 0;
        }
        if (!($this->totalPrice <= 0)) {
            $this->totalPrice  -= $category->price;
        } else {
            $this->totalPrice   = 0;
        }
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function getTotalQty()
    {
        return $this->totalQty;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
}
