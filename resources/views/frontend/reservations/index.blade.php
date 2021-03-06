@extends('layouts.frontend')
@section('content')
    <div class="account-settings-section">
        <div class="container">
            <div class=" row">
                @include('frontend.partial.menue')
                <div class="col-lg-8 ">
                    <a class="btn btn-info text-white" href="{{ route('frontend.reservations.create') }}">حجز موعد</a>
                    <table id="booking-table">
                        <thead>

                            <tr>
                                <th scope="col">اسم الاستشاري</th>
                                <th scope="col">اسم العيادة</th>
                                <th scope="col">التاريخ</th>
                                <th scope="col">الساعة</th>
                                <th scope="col">حالة الحجز</th>
                                <th scope="col">سعر الحجز</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $key => $reservation)
                                <tr>
                                    <td data-label="اسم المستشار"> {{ $reservation->doctor->user->name ?? '' }} </td>
                                    <td data-label="اسم المستشار"> {{ $reservation->clinic->clinic_name ?? '' }} </td>
                                    <td class="booking-time" data-label="التاريخ">
                                        {{ $reservation->reservation_date ?? '' }}</td>
                                    <td class="booking-time" data-label="الساعة">
                                        {{ $reservation->reservation_time ?? '' }}</td>
                                    <td class="" data-label="حالة الحجز">
                                        {{ App\Models\Reservation::STATUSE_SELECT[$reservation->statuse] ?? '' }}</td>
                                    <td class="" data-label="سعر الحجز">
                                        {{ $reservation->cost ?? '' }}</td>
                                    <td class="" data-label="تعديل/حذف">
                                        <button class="btn btn-success btn-sm text-white"
                                            onclick="payment_model('{{ $reservation->id }}','Reservation')">الدفع</button>
                                        @if ($reservation->frontend_delatable())
                                            <div class="delete-ediy-buttons">
                                                <form
                                                    action="{{ route('frontend.reservations.destroy', $reservation->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                    style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button class="btn btn-icon btn-sm btn-danger" style="float: none;">
                                                        <span><strong>حذف</strong></span>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $reservations->links() }}
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection
