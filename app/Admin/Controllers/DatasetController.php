<?php

namespace App\Admin\Controllers;

use App\Dataset;
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
use App\Admin\Extensions\CsvCustomExporter;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DatasetController extends Controller
{
    use HasResourceActions;

    public function __construct(Dataset $dataset)
    {
        $this->dataset = $dataset;
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
        $grid = new Grid(new Dataset);

        $grid->id('id');
        $grid->code('code');
        $grid->date('date');
        $grid->total('total');
        $grid->open('open');
        $grid->high('high');
        $grid->low('low');
        $grid->close('close');
        $grid->volume('volume');
        $grid->close_adj('close_adj');

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
        $show = new Show(Dataset::findOrFail($id));

        $show->id('id');
        $show->code('code');
        $show->date('date');
        $show->total('total');
        $show->open('open');
        $show->high('high');
        $show->low('low');
        $show->close('close');
        $show->volume('volume');
        $show->close_adj('close_adj');
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
        $form = new Form(new Dataset);

        $form->date('date', 'Date')->default(date('Y-m-d'));
        $form->number('total', 'Total');
        $form->number('open', 'Open');
        $form->number('high', 'High');
        $form->number('low', 'Low');
        $form->number('close', 'Close');
        $form->number('volume', 'Volume');
        $form->number('close_adj', 'Close adjust');

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
            $record = $this->dataset->firstOrNew(['code' => $row['code'],'date' => $row['date']]);
            $record->fill($row)->save();
        }
        return redirect('admin/datasets');
    }

}
