@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.editor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.editors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.editor.fields.id') }}
                        </th>
                        <td>
                            {{ $editor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.editor.fields.city') }}
                        </th>
                        <td>
                            {{ $editor->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.editor.fields.work') }}
                        </th>
                        <td>
                            {{ $editor->work }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.editor.fields.user') }}
                        </th>
                        <td>
                            {{ $editor->user->email ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.editors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection