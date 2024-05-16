<input id="dob" type="date" wire:model="form.dob"
class="form-control @error('form.dob') parsley-error @enderror">
@include('components.input-error',['input'=> 'form.dob'])