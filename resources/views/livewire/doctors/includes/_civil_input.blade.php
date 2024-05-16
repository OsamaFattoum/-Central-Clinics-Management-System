<input id="civil_input" type="text" wire:model='form.civil_id'
class="form-control @error('form.civil_id') parsley-error @enderror">
 @include('components.input-error',['input'=> 'form.civil_id'])