@extends('layouts.patient')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('patient.reservations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.reservation.title_singular') }}
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.reservation.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Reservation">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.reservation.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.reservation.fields.reservation_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.reservation.fields.statuse') }}
                            </th>
                            <th>
                                {{ trans('cruds.reservation.fields.cost') }}
                            </th>
                            <th>
                                {{ trans('cruds.reservation.fields.doctor') }}
                            </th>
                            <th>
                                {{ trans('cruds.reservation.fields.clinic') }}
                            </th>
                            <th>
                                {{ trans('cruds.reservation.fields.payment_status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $key => $reservation)
                            <tr data-entry-id="{{ $reservation->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $reservation->id ?? '' }}
                                </td>
                                <td>
                                    <span class="badge badge-dark">{{ $reservation->reservation_date ?? '' }}</span>
                                    <br>
                                    <span class="badge badge-light">{{ $reservation->reservation_time ?? '' }}</span>
                                </td>
                                <td>
                                    {{ App\Models\Reservation::STATUSE_SELECT[$reservation->statuse] ?? '' }}
                                </td>
                                <td>
                                    {{ $reservation->cost ?? '' }}
                                </td>
                                <td>
                                    {{ $reservation->doctor->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $reservation->clinic->clinic_name ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Reservation::PAYMENT_STATUS_SELECT[$reservation->payment_status] ?? '' }}
                                </td>
                                <td>

                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('patient.reservations.show', $reservation->id) }}">
                                        {{ trans('global.view') }}
                                    </a>

                                    {{-- <a class="btn btn-xs btn-info" href="{{ route('patient.reservations.edit', $reservation->id) }}">
                                    {{ trans('global.edit') }}
                                </a> --}}

                                    <form action="{{ route('patient.reservations.destroy', $reservation->id) }}"
                                        method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                            value="{{ trans('global.delete') }}">
                                    </form>


                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons) 

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-Reservation:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
