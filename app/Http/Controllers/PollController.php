<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\Option;

class PollController extends Controller
{
    // Tampilkan halaman utama polling
    public function index()
    {
        $poll = Poll::with('options')->first();
        return view('poll', compact('poll'));
    }

    // Simpan suara
    public function vote(Request $request)
    {
        $option = Option::find($request->option_id);
        $option->increment('votes');
        return response()->json(['success' => true]);
    }

    // Ambil hasil polling
    public function results()
    {
        $poll = Poll::with('options')->first();
        return response()->json($poll);
    }

    // Reset hasil (bonus)
    public function reset()
    {
        Option::query()->update(['votes' => 0]);
        return response()->json(['success' => true]);
    }
}
