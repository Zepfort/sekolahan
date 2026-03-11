<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource {

    // Class abstract
    abstract public function getModel();
    abstract public function getTemplateData();
    abstract public function getFilterDefinitions();

    public function getQueryData($request) {
        $modelClass = $this->getModel();
        $query = $modelClass::query();
        $filters = $this->getFilterDefinitions();

        // logika filter otomatis
        foreach ($filters as $filter) {
            $fieldName = $filter['name'];
            $value = $request->get($fieldName);


            // Cek apakah ada input dari user untuk q
            if ($request->has($fieldName) && $value !== null) {

                if ($fieldName === "q") {
                    $columns = $this->getGlobalSearchColumns();

                    if (!empty($columns)) {
                    $query->where(function($q) use ($columns, $value) {
                        forEach ($columns as $column) {
                                $q->orWhere($column, 'like', '%' . $value . '%');
                            }
                        });
                    }
                } else {
                        $query->where($fieldName, 'like', '%' . $value . '%');
                }
            }
        }
        return $query->get();
    }

    public function getGlobalSearchColumns() {
        return [];
    }

    public function with($request)
    {
        $routeName = explode('.', $request->route()->getName())[0];

        return [
            'template' => [
                'data' => $this->getTemplateData()
            ],
            'queries' => $this->formatQueries($routeName),
        ];
    }

    protected function formatQueries($routeName)
    {
        $definitions = $this->getFilterDefinitions();

        return [
            [
                'rel' => 'search',
                'href' => route($routeName . '.index'),
                'prompt' => 'Pencarian umum',
                'data' => array_values(array_filter($definitions, fn($f) => $f['name'] === 'q'))
            ],
            [
                'rel' => 'filter',
                'href' => route($routeName . '.index'),
                'prompt' => 'Filter data',
                'data' => array_values(array_filter($definitions, fn($f) => $f['name'] !== 'q'))
            ]
        ];
    }
}
