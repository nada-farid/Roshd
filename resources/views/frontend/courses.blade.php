@extends('layouts.frontend')

@section('content')
    <div class="courses-second-section section container">
        <div class="row">
            <div class="row">
                @foreach ($groups as $group)
                    @php
                        if ($group->photo) {
                            $group_image = $group->photo->getUrl('preview2');
                        } else {
                            // $group_image = asset('frontend/img/activ01.png');
                            $group_image = '';
                        }
                    @endphp

                    <div class="col-lg-4 course-row">
                        <div class="course-wrap">
                            <img class="course-img" src="{{ $group_image }}">
                        </div>
                        <div class="course-info">
                            <p class="item-info">{{ $group->title }}</p>
                            <p class="course-tutor">{{ $group->user->name }}</p>
                            <p class="date">
                                <i class="far fa-calendar-alt"></i>
                                من {{ $group->start_date }}
                            </p>
                            <p class="date">
                                <i class="far fa-calendar-alt"></i>
                                إلى {{ $group->end_date }}
                            </p>
                        </div>
                        <a class="btn shadow-none blue-btn" href="{{ route('frontend.course', $group->id) }}">المزيد</a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <div style=" width:100%;
        display: flex;justify-content:center;">
        {{ $groups->links() }}
    </div>
@endsection
