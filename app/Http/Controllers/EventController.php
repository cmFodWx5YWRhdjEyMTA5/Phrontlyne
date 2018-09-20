<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;
use Phrontlyne\Models\Event;
use Phrontlyne\Http\Requests;
use Phrontlyne\Http\Controllers\Controller;
use DateTime;
use Input;
use Response;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
       $events  = Event::orderBy('start_time','DESC')->paginate(30);
       return view('event/list', compact('events'));
    }

     public function calendar()
    {
        
       $events  = Event::orderBy('start_time')->paginate(30);
       return view('event/calendar', compact('events'));
    }
   
    
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|min:3|max:100',
            'title' => 'required|min:5|max:100',
            'time'  => 'required'
        ]);
        
        $time = explode(" - ", $request->input('time'));
        
        $event                  = new Event;
        $event->name            = $request->input('name').' - '.$request->input('phonenumber') ;
        $event->title           = $request->input('title');
        $event->start_time      = $this->change_date_format($time[0]);
        $event->end_time        = $this->change_date_format($time[1]);
        $event->save();
        
         return redirect()
            ->route('event-calendar')
            ->with('info','The event was successfully saved!');
    }

   
    public function show($id)
    {
        $event = Event::findOrFail($id);
        
        $first_date = new DateTime($event->start_time);
        $second_date = new DateTime($event->end_time);
        $difference = $first_date->diff($second_date);

        $data = [
            'page_title'    => $event->title,
            'event'         => $event,
            'duration'      => $this->format_interval($difference)
        ];
        
        return view('event/view', $data);
    }

   
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $event->start_time =  $this->change_date_format_fullcalendar($event->start_time);
        $event->end_time =  $this->change_date_format_fullcalendar($event->end_time);
        
        $data = [
            'page_title'    => 'Edit '.$event->title,
            'event'         => $event,
        ];
        
        return view('event/edit', $data);
    }

 
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'required|min:5|max:15',
            'title' => 'required|min:5|max:100',
            'time'  => 'required|available|duration'
        ]);
        
        $time = explode(" - ", $request->input('time'));
        
        $event                  = Event::findOrFail($id);
        $event->name            = $request->input('name');
        $event->title           = $request->input('title');
        $event->start_time      = $this->change_date_format($time[0]);
        $event->end_time        = $this->change_date_format($time[1]);
        $event->save();
        
        return redirect('events');
    }


    public function deleteappointmentfromevent()
    {
            if(Input::get("ID"))
            {
                    $ID = Input::get("ID");
                    $affectedRows = Event::where('id', '=', $ID)->delete();

                if($affectedRows > 0)
                {
                    $ini   = array('OK'=>'OK');
                    return  Response::json($ini);
                }
            
                 else
                {
                    $ini   = array('No Data'=>$ID);
                    return  Response::json($ini);
                }
            }
                else
               {
                    $ini   = array('No Data'=>'No Data');
                    return  Response::json($ini);
                }

    }
    
    public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
    }
    
    public function change_date_format_fullcalendar($date)
    {
        $time = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        return $time->format('d/m/Y H:i:s');
    }
    
    public function format_interval(\DateInterval $interval)
    {
        $result = "";
        if ($interval->y) { $result .= $interval->format("%y year(s) "); }
        if ($interval->m) { $result .= $interval->format("%m month(s) "); }
        if ($interval->d) { $result .= $interval->format("%d day(s) "); }
        if ($interval->h) { $result .= $interval->format("%h hour(s) "); }
        if ($interval->i) { $result .= $interval->format("%i minute(s) "); }
        if ($interval->s) { $result .= $interval->format("%s second(s) "); }
        
        return $result;
    }
}
