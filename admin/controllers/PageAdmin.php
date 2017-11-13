<?php
/**
 * Created by PhpStorm.
 * User: Evil Genius
 * Date: 06.11.2017
 * Time: 19:22
 */

class PageAdmin extends CoreAdmin
{
    public function fetch()
    {
        $pages = new Pages();
        $request = new Request();
        ////////////////////////////
        $page = new stdClass();

        if($request->method() == 'POST') {
            $page->name = $request->post('name');
            $page->description = $request->post('description');
            $page->visible = $request->post('visible','integer');
            $page->image = $request->files('image','name');
            $request->uploadImgFile('image');

            if(empty($request->post('url'))) {
                $page->url = '/' . CoreAdmin::translit($request->post('name'));
            } else {
                $page->url = '/' . CoreAdmin::translit($request->post('url'));
            }

            if($request->post('id','integer')) {
                $id = $pages->updatePages($request->post('id','integer'),$page);

            } else {
                //Добавление страницы
                $id = $pages->addPage($page);
            }
            if (!empty($id)){
                $result = 'Страница добавлена';
            }
            $page = $pages->getPage($id);
        }
        $array_vars = array(
            'page_name' => 'Добавление страницы',
            'page' => $page,
            'result' => $result,
            'backUp' => "Back",
        );

        return $this->view->render('page.html',$array_vars);
    }
}