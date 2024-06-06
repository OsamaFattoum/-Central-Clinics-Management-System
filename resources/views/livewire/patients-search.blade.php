<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card custom-card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-11">
                        <input type="text" wire:model="searchTerm" class="form-control @error('searchTerm') parsley-error @enderror" placeholder="{{ __('users.placeholder_search_patient') }}">
                        @include('components.input-error',['input'=> 'searchTerm'])
                    </div>
                    <div class="col-lg-1 mt-2 mt-lg-0">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <button wire:click="search" class="btn btn-primary" type="button">@lang('site.search')</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="">
                        @permission('create-patients')
                        <a href="{{route('patients.create')}}" class="btn btn-primary">
                            @lang('patients.btn_create_patient')
                        </a>
                        @endpermission
                        @permission('delete-patients')
                        <button type="button" class="btn btn-danger"
                            id="btn_delete_all">@lang('delete.btn_delete_selected_data')</button>
                        @endpermission
                    </div>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body p-3">

                @include('components.custom-loader')

                <div class="table-responsive" wire:loading.class='d-none'>
                    <table class="table text-md-nowrap table-bordered" id="example1">
                        <thead>
                            <tr>
                                <th class="pr-2 wd-5p"> <label class="ckbox"><input type="checkbox"
                                            name="select_all"><span></span></label>
                                </th>
                                <th class="pr-2">@lang('patients.name_patient')</th>
                                <th class="pr-2">@lang('users.civil_id')</th>
                                <th class="pr-2">@lang('users.phone')</th>
                                <th class="pr-2">@lang('users.gender')</th>
                                <th class="pr-2">@lang('users.city')</th>
                                <th class="pr-2">@lang('users.status')</th>
                                <th class="pr-2">@lang('dropdown_op.processes')</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @forelse ($patients as $patient)
                            <tr>
                                <td class="pr-2">
                                    <label class="ckbox">
                                        <input type="checkbox" name="delete_select" value="{{ $patient->id }}">
                                        <span></span>
                                    </label>
                                </td>
                                <td class="pr-2"><a href="{{ route('patients.show',$patient->id) }}">{{
                                        $patient->profile->name }}</a></td>

                                <td class="pr-2">{{ $patient->civil_id }}</td>
                                <td class="pr-2"><a href="tel:{{ $patient->profile->phone }}">{{ $patient->profile->phone }}</a></td>
                                <td class="pr-2"><span class="badge badge-{{ $patient->profile->gender == '1' ? 'primary' : 'pink' }}">{{ $patient->gender }}</span></td>
                                <td class="pr-2"><span class="badge badge-dark">{{ $patient->city_name }}</span> </td>

                                <td class="pr-2">
                                    <span class="badge badge-{{ $patient->status ? 'success' : 'danger' }}">{{
                                        $patient->status ? __('users.enabled') : __('users.not_enabled')}}
                                    </span>
                                </td>
                                <td class="pr-2">
                                    @if (Auth::user()->hasPermission('update-patients') ||
                                    Auth::user()->hasPermission('delete-patients') )

                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                            class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                            type="button">@lang('dropdown_op.processes')<i
                                                class="fas fa-caret-down mx-1"></i></button>
                                        <div class="dropdown-menu tx-13">
                                            @permission('update-patients')
                                            <a class="dropdown-item" href="{{route('patients.edit',$patient->id)}}"><i
                                                    style="color: #0ba360"
                                                    class="text-success ti-pencil-alt"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_edit')</a>
                                            @endpermission
                                            @permission('delete-patients')
                                            <a class="dropdown-item" href="{{route('patients.status',$patient->id)}}"><i
                                                    class="text-warning ti-back-right"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_status')</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete{{$patient->id}}"><i
                                                    class="text-danger  ti-trash"></i>&nbsp;&nbsp;@lang('dropdown_op.drop_down_delete')</a>
                                            @endpermission
                                        </div>
                                    </div>
                                    @else
                                    <span class="text-center">-</span>
                                    @endif
                                </td>
                                @permission('delete-patients')
                                @include('components.delete',['id'=>$patient->id,'name' =>
                                $patient->name,'route'=>'patients','parameters'=>$patient->id])
                                @endpermission
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">@lang('data_table.emptyTable')</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>