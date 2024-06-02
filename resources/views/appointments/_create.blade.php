<div class="modal  fade" id="create" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">@lang('appointments.btn_add_appointment')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('appointments.store',['patient' => $patient->id]) }}" method="post"
                autocomplete="off" >
                @csrf
                <div class="modal-body">
                    @auth('doctor')
                     <input type="hidden" name="clinic" value="{{ auth()->user()->clinic->id }}">
                     <input type="hidden" name="department" value="{{ auth()->user()->department->id }}">
                     <input type="hidden" name="doctor" value="{{ auth()->user()->id }}">
                    @else
                    @livewire('appointment')
                    @endauth
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="date">@lang('appointments.date')</label>
                            <input id="date" type="date" name="date" value="{{ old('date') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="time">@lang('appointments.time')</label>
                            <input id="time" type="time" name="time" value="{{ old('time') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes">@lang('appointments.notes')</label>
                        <textarea style="resize: none" name="notes" rows="5"
                            class="form-control">{{ old('notes') }}</textarea>
                    </div>
                </div>
                    <div class="modal-footer justify-content-between">
                    <div class="">
                        <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">@lang('modal.btn_close')</button>
                    <button type="submit" class="btn btn-primary">@lang('modal.btn_submit')</button>

                    </div>
                </div> 
            </form>

        </div>
    </div>
</div>