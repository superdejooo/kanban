<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Column;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CardController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $card = Card::create([
            'title'         => $request->input('title'),
            'description'   => $request->input('description'),
            'column_id'     => $request->input('column_id'),
            'order'         => Card::where('column_id', $request->input('column_id'))->get()->max('order') + 1,
        ]);

        return response()->json([
            'data' => $card
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Card $card
     * @return JsonResponse
     */
    public function show(Card $card): JsonResponse
    {
        return response()->json([
            'data' => $card
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Card $card
     * @return JsonResponse
     */
    public function update(Request $request, Card $card)
    {
        $card->update([
            'title'         => $request->input('title'),
            'description'   => $request->input('description'),
        ]);

        return response()->json([
            'data' => $card
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Card $card
     * @return Response
     */
    public function destroy(Card $card)
    {
        $card->delete();

        return response(null, 204);
    }



    /**
     * Update the order of cards in columns.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function move(Request $request)
    {
        $card = Card::findOrFail($request->input('card_id'));

        // update orders in old column
        $old_column = Column::findOrFail($card->column_id);
        $old_column->cards()->each(function ($_card) use ($card) {
            if ($_card->order > $card->order) {
                $_card->order = $_card->order - 1;
                $_card->save();
            }
        });

        // update orders in new column
        $new_column = Column::findOrFail($request->input('column_id'));
        $new_column->cards()->each(function ($_card) use ($request) {
            if ($_card->order >= $request->input('order')) {
                $_card->order = $_card->order + 1;
                $_card->save();
            }
        });


        // update the card
        $card->update([
            'column_id' => $request->input('column_id'),
            'order'     => $request->input('order'),
        ]);


        return response()->json([
            'data' => $card
        ]);
    }
}
