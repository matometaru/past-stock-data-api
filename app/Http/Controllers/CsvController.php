<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Stock;
use Excel;

class CsvController extends Controller
{
    protected $stock = null;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['stocks'] = $this->stock->all();
        return view('index', $data);
    }

    /**
     * CSVインポート
     *
     * @param  Request
     * @return \Illuminate\Http\Response
     */
     public function import(Request $request)
     {
         $file = $request->file('csv_file');
         $reader = Excel::load($file->getRealPath());

         $rows = $reader->toArray();

         foreach ($rows as $row){
             if (!isset($row['name'])) {
                 return redirect()->back();
             }

             $record = $this->task->firstOrNew(['name' => $row['name']]);
             $record->name = $row['name'];
             $record->save();
         }
         return redirect()->action('CsvController@index');
     }
}