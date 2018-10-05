<?php

namespace App\Admin\Controllers;

use App\Stock;
use App\Market;
use App\Category;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Admin\Extensions\Tools\UserGender;
use App\Admin\Extensions\Tools\ImportButton;
use App\Admin\Extensions\CsvExporter;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StockController extends Controller
{
    use HasResourceActions;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

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

        $grid->id('ida');
        $grid->code('Code');
        $grid->name('Name');
        $grid->color('Color');
        $grid->url('Url');
        $grid->market()->display(function($market) {
            return $market['name'];
        });
        $grid->category()->display(function($category) {
            return $category['name'];
        });

        $grid->tools(function ($tools) {
            $tools->append(new ImportButton());
        });

        $grid->exporter(new CsvExpoter());

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

        $show->id('id');
        $show->code('Code');
        $show->name('Name');
        $show->color('Color');
        $show->url('Url');
        $show->market('Markert');
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
        // $form->number('market', 'Markert')->max(10);
        $form->number('category_id', 'Category')->max(33);
        $form->date('listing_date', 'Listing date')->default(date('Y-m-d'));
        $form->date('delisting_date', 'Delisting date')->default(date('Y-m-d'));

        $form->select('market_id')->options([
            1 => '東証1部',
            2 => '東証2部',
            3 => 'マザーズ',
            4 => 'JASDAQスタンダード',
            5 => 'JASDAQグロース', 
            6 => '名証1部',
            7 => '名証2部',
            8 => '名証セントレックス',
            9 => '札証',
            10 => '福証'
        ]);

        return $form;
    }

    /**
     * Import interface.
     */
    protected function import(Content $content, Request $request)
    {
        $file = $request->file('file');
        $reader = Excel::load($file->getRealPath());

        $rows = $reader->toArray();

        foreach ($rows as $row){
            // firstOrNewで条件に合致したものがあればfirst()で取得し、なければnewでインスタンス生成
            $record = $this->stock->firstOrNew(['code' => $row['code']]);
            $record->fill($row)->save();
        }
        return redirect('admin/stocks');
    }
}
