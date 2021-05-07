@extends('layouts.app')

@section('content')
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		{{ Breadcrumbs::render('home') }}
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Calendario de Vencimientos</div>

                <div class="card-body">
                   <div id="calendario-iva" ></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}

var hoy = new Date();
var dd = hoy.getDate();
if(dd<10) {
    dd='0'+dd;
} 
 
if(mm<10) {
    mm='0'+mm;
}

var mm = hoy.getMonth()+1;
var yyyy = hoy.getFullYear();

dd=addZero(dd);
mm=addZero(mm);

    var calendarEl = document.getElementById('calendario-iva');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'dayGrid', 'bootstrap' ],
      timeZone: 'UTC',
     defaultView: 'dayGridMonth',
      locale: 'es',
      header: {
        left: '',
        center: 'title',
        right: ''
      },
      weekNumbers: true,
      eventLimit: true, // allow "more" link when too many events
   
      eventRender: function (info) {
  $(info.el).tooltip({ title: info.event.extendedProps.description });     
},
      events:[
            {
                title: 'uno',
                description: 'Lorem ipsum 1...',
                start: yyyy+'-'+mm+'-01',
                color: '#3A87AD',
                textColor: '#ffffff',
            },
            {
                title: 'Long Event',
                description: 'Lorem ipsum 2...',
                start:  yyyy+'-'+mm+'-07',
                end:  yyyy+'-'+mm+'-10',
                color: '#3A87CF',
                textColor: '#ffffff',
            },
            {
                title: 'Repeating Event',
                description: 'Lorem ipsum 3...',
                start:  yyyy+'-'+mm+'-09T16:00:00',
                color: '#3A82AD',
                textColor: '#ffffff',
            },
            {
                title: 'Repeating Event',
                description: 'Lorem ipsum 4...',
                start:  yyyy+'-'+mm+'-16T16:00:00',
                color: '#aaa',
                textColor: '#ffffff',
            },
            {
                title: 'Conference',
                description: 'Lorem ipsum 5...',
                start:  yyyy+'-'+mm+'-11',
                end:  yyyy+'-'+mm+'-13',
                color: '#3A87AD',
                textColor: '#ffffff',
            },
            {
                title: 'Meeting',
                description: 'Lorem ipsum 6...',
                start:  yyyy+'-'+mm+'-12T10:30:00',
                end:  yyyy+'-'+mm+'-12T12:30:00',
                color: '#3A87AD',
                textColor: '#ffffff',
            },
            {
                title: 'Lunch',
                description: 'Lorem ipsum 7...',
                start:  yyyy+'-'+mm+'-12T12:00:00',
                color: '#3A87AD',
                textColor: '#ffffff',
            },
            {
                title: 'Meeting',
                description: 'Lorem ipsum 8...',
                start:  yyyy+'-'+mm+'-12T14:30:00',
                color: '#3A87AD',
                textColor: '#ffffff',
            },
            {
                title: 'Happy Hour',
                description: 'Lorem ipsum 9...',
                start:  yyyy+'-'+mm+'-12T17:30:00',
                color: '#3A87AD',
                textColor: '#ffffff',
            },
            {
                title: 'Dinner',
                description: 'Lorem ipsum 10...',
                start:  yyyy+'-'+mm+'-12T20:00:00',
                color: '#3A87AD',
                textColor: '#ffffff',
            },
            {
                title: 'Birthday Party',
                description: 'Lorem ipsum 11...',
                start:  yyyy+'-'+mm+'-13T07:00:00',
                color: '#3A87AD',
                textColor: '#ffffff',
            },
            {
                title: 'Event with link',
                description: 'Lorem ipsum 12...',
                url: 'http://www.jose-aguilar.com/',
                start:  yyyy+'-'+mm+'-28',
                color: '#3A87AD',
                textColor: '#ffffff',
            }
        ]


    });

    calendar.render();

@endsection