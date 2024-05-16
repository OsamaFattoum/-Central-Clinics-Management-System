<input id="job_number" type="text" wire:model='form.job_number'
class="form-control @error('form.job_number') parsley-error @enderror">
@include('components.input-error',['input'=> 'form.job_number'])