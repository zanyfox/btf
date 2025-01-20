<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class CalendarController extends Controller {

  public function index(Request $request) {

    if($request->ajax()) {
      $events = Event::whereDate('start','>=',$request->start)->whereDate('end','<=',$request->end)->get(['id','title','start','end']);
      return response()->json($events);
    }
    $events = Event::all();
    $eventsArr = [];

    $setting = \App\Models\Setting::find(14);
    foreach($events as $event) {
      $eventsArr[] = [
        'id' => $event->id,
        'title' => $event->title,
        'start' => $event->start,
        'end' => $event->end,
        'color' => 'black',
        'textColor' => 'red',
        'eventColor' => 'blue',
        'borderColor' => 'red',
      ];
    }
    return view('admin.calendar.index', ['events' => $eventsArr, 'schedule' => json_decode($setting->value)]);
  }

  public function show(int $id) {
    $event = Event::find($id);
    return response()->json([
      'status' => 'success',
      'event' => $event
    ]);
  }

  public function store(Request $request) {

    /* $request->validate([
      'title' => 'required|string'
    ]); */

    //if($request->ajax()) {
      $event = Event::create([
        'title' => $request->title,
        'start' => $request->start,
        'end' => $request->end,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time
      ]);
      return response()->json([
        'id' => $event->id,
        'title' => $event->title,
        'start' => $event->start,
        'end' => $event->end
      ]);
    //}
  }

  public function update(Request $request, int $id) {
    $event = Event::find($id);
    if(!$event) {
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.RecordNotFound')
      ], 404);
    }
    $event->update([
      'start' => $request->start,
      'end' => $request->end,
      'start_time' => $request->start_time,
      'end_time' => $request->end_time
    ]);
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordUpdatedSuccessfully')
    ]);
  }

  public function destroy(int $id) {
    $event = Event::find($id);
    if(!$event) {
      return response()->json([
        'status' => 'fail',
        'message' => __('admin.RecordNotFound')
      ], 404);
    }
    $event->delete();
    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordDeletedSuccessfully')
    ]);
  }

}
