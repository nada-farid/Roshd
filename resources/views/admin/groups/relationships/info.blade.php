<div class="card">

    <div class="card-body">

        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.id') }}
                        </th>
                        <td>
                            {{ $group->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.title') }}
                        </th>
                        <td>
                            {{ $group->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.start_date') }}
                        </th>
                        <td>
                            {{ $group->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.end_date') }}
                        </th>
                        <td>
                            {{ $group->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.course_hours') }}
                        </th>
                        <td>
                            {{ $group->course_hours }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.course_cost') }}
                        </th>
                        <td>
                            {{ $group->course_cost }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Group::STATUS_RADIO[$group->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.user') }}
                        </th>
                        <td>
                            {{ $group->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.photo') }}
                        </th>
                        <td>
                            @if ($group->photo)
                                <a href="{{ $group->photo->getUrl() }}" target="_blank"
                                    style="display: inline-block">
                                    <img src="{{ $group->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.description') }}
                        </th>
                        <td>
                            {{ $group->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
