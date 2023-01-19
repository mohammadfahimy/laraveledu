<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class RelatedProduct extends Component
{
    public $relatedProduct;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $category_id = $product->category->id;
        $this->relatedProduct = Product::where('category_id',$category_id)->get()->except($product->id);
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.related-product');
    }
}
