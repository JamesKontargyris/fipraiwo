<?php


class PagesController extends BaseController {

    public function about_edt()
    {
        return View::make('pages.about_edt')->with('page_title', 'The Fipra Editorial, Design and Translation Team (EDT)');
    }

    public function about_fiplex()
    {
        return View::make('pages.about_fiplex')->with('page_title', 'What is Fiplex?');
    }

    public function error()
    {
        return View::make('pages.error')->with('page_title', 'Error');
    }

    public function success()
    {
        return View::make('pages.success')->with('page_title', 'Success');
    }

} 