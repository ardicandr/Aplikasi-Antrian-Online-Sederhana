<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index() {
        $current = Queue::where('status', 'calling')->first();
        $list = Queue::where('status', 'waiting')->orderBy('queue_number', 'asc')->get();
        return view('dashboard', compact('current', 'list'));
    }

    public function store() {
        $lastQueue = Queue::orderBy('queue_number', 'desc')->first();
        $nextNumber = $lastQueue ? $lastQueue->queue_number + 1 : 1;

        Queue::create([
            'queue_number' => $nextNumber,
            'status' => 'waiting'
        ]);

        return back()->with('success', 'Nomor antrian berhasil ditambahkan.');
    }

    public function next() {
        Queue::where('status', 'calling')->update(['status' => 'finished']);

        $next = Queue::where('status', 'waiting')->orderBy('queue_number', 'asc')->first();
        
        if ($next) {
            $next->update(['status' => 'calling', 'called_at' => now()]);
        }
        
        return back();
    }

    public function prev() {
        $current = Queue::where('status', 'calling')->first();
        if ($current) {
            $current->update(['status' => 'waiting']);
        }

        $prev = Queue::where('status', 'finished')->orderBy('updated_at', 'desc')->first();
        if ($prev) {
            $prev->update(['status' => 'calling']);
        }

        return back();
    }

    public function getQueueStatus() {
        $current = Queue::where('status', 'calling')->first();
        $waiting = Queue::where('status', 'waiting')->orderBy('queue_number', 'asc')->get();
        return response()->json([
            'current' => $current ? $current->queue_number : '-',
            'waiting' => $waiting
        ]);
    }
}