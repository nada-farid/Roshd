@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.clinic.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clinics.update", [$clinic->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="clinic_number">{{ trans('cruds.clinic.fields.clinic_number') }}</label>
                <input class="form-control {{ $errors->has('clinic_number') ? 'is-invalid' : '' }}" type="number" name="clinic_number" id="clinic_number" value="{{ old('clinic_number', $clinic->clinic_number) }}" step="1" required>
                @if($errors->has('clinic_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clinic_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.clinic_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="clinic_name">{{ trans('cruds.clinic.fields.clinic_name') }}</label>
                <input class="form-control {{ $errors->has('clinic_name') ? 'is-invalid' : '' }}" type="text" name="clinic_name" id="clinic_name" value="{{ old('clinic_name', $clinic->clinic_name) }}" required>
                @if($errors->has('clinic_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clinic_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.clinic_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.clinic.fields.start_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time', $clinic->start_time) }}" required>
                @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.clinic.fields.end_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time', $clinic->end_time) }}" required>
                @if($errors->has('end_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="specializations">{{ trans('cruds.clinic.fields.specialization') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('specializations') ? 'is-invalid' : '' }}" name="specializations[]" id="specializations" multiple required>
                    @foreach($specializations as $id => $specialization)
                        <option value="{{ $id }}" {{ (in_array($id, old('specializations', [])) || $clinic->specializations->contains($id)) ? 'selected' : '' }}>{{ $specialization }}</option>
                    @endforeach
                </select>
                @if($errors->has('specializations'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specializations') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clinic.fields.specialization_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection