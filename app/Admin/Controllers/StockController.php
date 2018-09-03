<?php

namespace App\Admin\Controllers;

use App\Stock;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Admin\Extensions\Tools\UserGender;
use App\Admin\Extensions\Tools\ImportButton;
use Illuminate\Http\Request;

class StockController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Stock);

        $grid->id('Id');
        $grid->code('Code');
        $grid->name('Name');
        $grid->color('Color');
        $grid->url('Url');
        $grid->markert('Markert');
        $grid->category('Category');
        $grid->listing_date('Listing date');
        $grid->delisting_date('Delisting date');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        $grid->tools(function ($tools) {
            $tools->append(new ImportButton());
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Stock::findOrFail($id));

        $show->id('Id');
        $show->code('Code');
        $show->name('Name');
        $show->color('Color');
        $show->url('Url');
        $show->markert('Markert');
        $show->category('Category');
        $show->listing_date('Listing date');
        $show->delisting_date('Delisting date');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Stock);

        $form->number('code', 'Code');
        $form->text('name', 'Name');
        $form->color('color', 'Color');
        $form->url('url', 'Url');
        $form->switch('markert', 'Markert');
        $form->switch('category', 'Category');
        $form->date('listing_date', 'Listing date')->default(date('Y-m-d'));
        $form->date('delisting_date', 'Delisting date')->default(date('Y-m-d'));

        return $form;
    }

    /**
     * Import interface.
     */
    protected function import(Content $content, Request $request)
    {
        // $name = $request->input('name');
        $file = $request->input('file');
        $path = $request->file('file')->storeAs(
            'avatars', 'your_filename', 'public'
        );
        return $content
            ->body($path);
    }
}
