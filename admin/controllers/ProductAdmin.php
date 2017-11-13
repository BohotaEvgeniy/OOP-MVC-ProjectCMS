<?php
class ProductAdmin extends CoreAdmin
{
    public function fetch()
    {
        $products = new Products();
        $categories = new Categories();
        $request = new Request();
        ////////////////////////////
        $product = new stdClass();

        if($request->method() == 'POST') {

            $product->id_category = $request->post('id_category');
            $product->name = $request->post('name');
            $product->description = $request->post('description');
            $product->visible = $request->post('visible','integer');
            $product->brand = $request->post('brand');
            $product->price = $request->pregmatchPrice($request->post('price'));
            $product->image = $request->files('image','name');
            $request->uploadImgFile('image');

            if(empty($request->post('url'))) {
                $product->url = CoreAdmin::translit($request->post('name'));
            } else {
                $product->url = $request->post('url');
            }

            if($request->post('id','integer')) {
                $id = $products->updateProduct($request->post('id','integer'),$product);

            } else {
                //Добавление товара
                $id = $products->addProduct($product);
            }

            $product = $products->getProduct($id);

        }
        $array_vars = array(
            'categories' => $categories->getCategories(),
            'product' => $product,
            'backUp' => "Back",
        );

        return $this->view->render('product.html',$array_vars);
    }
}