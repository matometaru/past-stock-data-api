<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters;

class CsvExporter extends CsvExporter
{

    /**
     * @param Collection $records
     *
     * @return array
     */
    public function getHeaderRowFromRecords(Collection $records): array
    {
        $titles = collect(array_dot($records->first()->toArray()))->keys()->map(
            function ($key) {
                $key = str_replace('.', ' ', $key);

                return $key;
            }
        );

        return $titles->toArray();
    }
}
