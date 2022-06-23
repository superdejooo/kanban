<?php

namespace App\Http\Controllers;

use App\Http\Resources\ColumnResource;
use App\Models\Column;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return ColumnResource::collection(Column::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ColumnResource
     */
    public function store(Request $request)
    {
        $column = Column::create([
            'title' => $request->input('title')
        ]);

        return new ColumnResource($column);
    }

    /**
     * Display the specified resource.
     *
     * @param Column $column
     * @return ColumnResource
     */
    public function show(Column $column)
    {
        return new ColumnResource($column);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Column $column
     * @return ColumnResource
     */
    public function update(Request $request, Column $column)
    {
        $column->update([
            'title' => $request->input('title'),
        ]);

        return new ColumnResource($column);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Column $column
     * @return Response
     */
    public function destroy(Column $column)
    {
        $column->delete();

        return response(null, 204);
    }
}
