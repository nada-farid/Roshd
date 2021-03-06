<form method="POST" action="{{ route('admin.reservations.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="choosen_time" id="choosen_time">
    <input type="hidden" name="choosen_date" id="choosen_date">
    
    <div class="row">
        <div class="form-group col-md-4">
            <label class="required" for="doctor_id">{{ trans('cruds.reservation.fields.doctor') }}</label>
            <select class="form-control select2 {{ $errors->has('doctor') ? 'is-invalid' : '' }}" name="doctor_id"
                id="doctor_id" required>
                @foreach ($doctors as $id => $entry)
                    <option value="{{ $id }}" {{ old('doctor_id') == $id ? 'selected' : '' }}>
                        {{ $entry }}</option>
                @endforeach
            </select>
            @if ($errors->has('doctor'))
                <div class="invalid-feedback">
                    {{ $errors->first('doctor') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.reservation.fields.doctor_helper') }}</span>
        </div>


        <div class="form-group col-md-4" id="patients_select">
            <label class="required" for="user_id">{{ trans('cruds.patients.title_singular') }}</label>
            <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id"
                required>
                @foreach ($users as $id => $entry)
                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>
                        {{ $entry }}</option>
                @endforeach
            </select>
            @if ($errors->has('user'))
                <div class="invalid-feedback">
                    {{ $errors->first('user') }}
                </div>
            @endif 
        </div>
        <div class="form-group">
            <br>
            <button class="btn btn-danger" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
    </div>
</form>
