<?php

namespace App\Repositories\Contracts;


interface EloquentInterface
{
    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();

    /**
     * Save a new model and return the instance.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|$this
     * @static
     */
    public function create($attributes);

    /**
     * Execute a query for a single record by ID.
     *
     * @param  int    $id
     * @return mixed|static
     */
    public function find($id);

    /**
     * Destroy the models for the given IDs.
     *
     * @param  array|int  $ids
     * @return int
     */
    public function delete($ids);

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @param  array  $options
     * @return bool
     */
    public function update($attributes, array $options);

    /**
     * Get Model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel();
}