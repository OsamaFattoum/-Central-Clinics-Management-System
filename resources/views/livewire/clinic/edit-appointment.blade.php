<div wire:ignore class="modal fade" id="editAppointmentModal" tabindex="-1" aria-labelledby="editAppointmentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAppointmentModalLabel">@lang('modal.edit')
                    @lang('appointments.appointment')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit="updateStatus">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="department">@lang('appointments.department')</label>
                            <input type="text" id="department" readonly class="form-control" wire:model="department">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="doctor">@lang('appointments.doctor')</label>
                            <input type="text" id="doctor" readonly class="form-control" wire:model="doctor">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="date">@lang('appointments.date')</label>
                            <input type="date" id="date" readonly class="form-control" wire:model="date">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="time">@lang('appointments.time')</label>
                            <input type="time" id="time" readonly class="form-control" wire:model="time">
                        </div>
                    </div>
                    <div class="form-group"  wire:loading.attr='readonly'>
                        <label for="status">@lang('appointments.status')</label>
                        <select id="status" class="form-control" wire:model="status">
                            <option value="0">@lang('appointments.pending')</option>
                            <option value="1">@lang('appointments.confirmed')</option>
                            <option value="2">@lang('appointments.cancelled')</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer" wire:loading.class='d-none'>
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">@lang('modal.btn_close')</button>
                    <button type="submit" wire:submit.prevent="updateStatus" class="btn btn-primary">@lang('modal.btn_submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>