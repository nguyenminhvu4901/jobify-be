<?php

use Illuminate\Database\Eloquent\Model;

if (! function_exists('refreshWithRelations')) {
    /**
     * Refresh model and eager load given relations.
     *
     * @param  Model  $model
     * @param  array|string|null  $relations
     * @return Model
     */
    function refreshWithRelations(Model $model, array|string|null $relations = null): Model
    {
        $model = $model->refresh();

        if ($relations) {
            $model->load($relations);
        }

        return $model;
    }
}
