<?php 
    
class Cart 
{
    public function add(Product $product)
    {
      $inCart = false;
      $this->setTotal($product);
      if(count($this->getCart()) > 0) {
        foreach ($this->getCart() as $productInCart) {
            if ($productInCart->getId() === $product->getId()) {
                $quantity = $productInCart->getQuantity() + $product->getQuantity();
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
        $_SESSION['cart']['product'][] = $product;

    }

    private function setTotal(Product $product) {
        $_SESSION['cart']['total'] += $product->getPrice() * $product->getQuantity();
    }

    public function remove(int $id)
    {
        if(isset($_SESSION['cart']['product']))
        {
            foreach($this->getCart() as $index => $product) {
                if($product->getId() === $id)
                {
                    unset($_SESSION['cart']['product'][$index]);
                    $_SESSION['cart']['total'] -= $product->getPrice() * $product->getQuantity();
                }
            }
        }
    }

    public function getCart() {
        return $_SESSION['cart']['product'] ?? [];
    }

    public function getTotal() {
        return $_SESSION['cart']['total'] ?? 0;
    }
}
?>