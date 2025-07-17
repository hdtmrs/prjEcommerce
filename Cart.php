<?php 
    
class Cart 
{
    public function add(Product $product)
    {
      $inCart = false;
      if(count($this->getCart()['product']) > 0) {
        foreach ($this->getCart()['product'] as $productInCart) {
            if ($productInCart->getId() === $product->getId()) {
                $quantity = $productInCart->getQuanity() + $product->getQuantity();
                $productInCart->setQuantity($quantity);
                $inCart = true;
                break;
            }
        }
      }

      if(!$inCart) {
        $this->setProductInCart($product);
      }

    }

    private function setProductInCart($product) {
        $this->getCart()['product'][] = $product;

    }

    public function remove()
    {

    }

    public function getCart() {
        return $_SESSION['cart'] ?? [];
    }
}
?>