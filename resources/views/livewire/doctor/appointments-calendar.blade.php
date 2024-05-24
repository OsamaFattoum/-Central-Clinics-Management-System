@section('css')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
@endsection

<div class="row row-sm">
    <div wire:ignore class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    @include('livewire.doctor.edit-appointment')
</div>


@section('js')

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

<script>
    $(function(){
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                buttonText:{
                    today:    @json(__('site.today')),
                    month:    @json(__('site.month')),
                    day:      @json(__('site.day')),
                },
                views: {
                    timeGrid: {
                        allDayText: @json(__('site.all-day'))  // Customize the all-day text
                    }
                },
                eventClassNames: function(arg) {
                    return ['fc-event-custom']; // Add custom class to all events
                },
                initialView: 'dayGridMonth',
                locale: @json(app()->getLocale()),
                direction: @json(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'),
                events: @json($appointments),
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridDay'
                },
                eventClick: function(info) {
                    @this.call('edit', info.event.id);
                },

                
            });
            calendar.render();

            @this.on('openModal',()=>{
                $('#editAppointmentModal').modal('show');
            });

            @this.on('appointmentsRefreshed', (appointments) => {
                
                $('#editAppointmentModal').modal('hide');
                calendar.removeAllEvents();
                appointments[0].forEach(appointment => {                   
                    calendar.addEvent({
                        id: appointment.id,
                        title: appointment.title,
                        start: appointment.start,
                        color: appointment.color,
                        display: appointment.display
                    });
                });
             
                notif({
                    msg: "{{ __('messages.status') }}",
                    type: "success"
                });
            });

           


    });
</script>

@endsection