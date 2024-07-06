@extends('layouts.admin')

@section('title', 'قائمة مهام المقاولات')

@section('contentheader')
    قائمة مهام المقاولات
@endsection

@section('contentheaderactivelink')
    <a href="{{ route('contractings.index') }}">المهام</a>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            @can('إضافة مهمة جديدة')
                <a href="{{ route('contractings.create') }}" class="btn btn-primary float-right">إضافة مهمة جديدة</a>
            @endcan
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>العنوان</th>
                        <th>الوصف</th>
                        <th>وقت التاسك</th>
                        <th>التقييم ( 1 إلى 5)</th>
                        <th>حالة التاسك</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contractings as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->admin->name }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                <span id="timer-{{ $task->id }}">{{ $task->timer }}</span>
                            </td>
                            <td>{{ $task->review ?? 'لم يتم تقييم التاسك' }}</td>
                            <td>{{ $task->status }}</td>

                            @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager())
                                <td>
                                    @if($task->status === "pending")
                                    <button type="button" class="btn btn-primary" id="reviewBtn-{{ $task->id }}" data-toggle="modal" data-target="#reviewModal{{ $task->id }}" {{ $task->review ? 'disabled' : '' }}>
                                        تقييم التاسك
                                    </button>
                                    @endif
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#extensionDetailsModal{{ $task->id }}">
                                        عرض تفاصيل التمديد
                                    </button>
                                </td>
                            @else
                                <td>
                                    @if ($task->status === 'closed')
                                        <button type="button" class="btn btn-warning" disabled>تمديد الوقت</button>
                                    @else
                                        <button type="button" class="btn btn-success start-timer-btn" data-task-id="{{ $task->id }}" {{ $task->review ? 'disabled' : '' }}>ابدأ المؤقت</button>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#extendModal{{ $task->id }}">تمديد الوقت</button>
                                        <form action="{{ route('contractings.update', $task->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger stop-timer-btn d-none" id="completeBtn-{{ $task->id }}" data-task-id="{{ $task->id }}" {{ $task->review ? 'disabled' : '' }}> الإنتهاء من التاسك</button>
                                            <input type="hidden" name="timer" id="hidden-timer-{{ $task->id }}" value="{{ $task->timer }}">
                                        </form>

                                    @endif
                                </td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($contractings as $task)
        <div class="modal fade" id="reviewModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel{{ $task->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewModalLabel{{ $task->id }}">تقييم المهمة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('contractings.review', $task->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="reviewScore">التقييم (من 1 إلى 5)</label>
                                <input type="number" name="review_score" id="reviewScore" class="form-control" min="1" max="5" required>
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ التقييم</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="extendModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="extendModalLabel{{ $task->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="extendModalLabel{{ $task->id }}">تمديد الوقت</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('contractings.extend', $task->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="extraTime">أدخل الوقت المطلوب بالساعة (على سبيل المثال 05 )</label>
                                <input type="number" name="extra_time" id="extraTime" class="form-control" min="1" required>
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ الوقت</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager())
            <div class="modal fade" id="extensionDetailsModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="extensionDetailsModalLabel{{ $task->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="extensionDetailsModalLabel{{ $task->id }}">تفاصيل التمديد للمهمة: {{ $task->title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if ($task->timeExtensions->isEmpty())
                                <p>لا يوجد تمديد لهذه المهمة.</p>
                            @else
                                <h4>تفاصيل التمديد للمهمة:</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>تمديد رقم</th>
                                            <th>عدد الساعات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalHours = 0;
                                        @endphp
                                        @foreach ($task->timeExtensions as $extension)
                                            <tr>
                                                <td>{{ $extension->id }}</td>
                                                <td>{{ $extension->extra_time }}</td>
                                            </tr>
                                            @php
                                                $totalHours += $extension->extra_time;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td><strong>إجمالي الساعات</strong></td>
                                            <td><strong>{{ $totalHours }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endforeach

@endsection

@section('script')
    <script>
        var timers = {};
        function startTimer(taskId) {
            var timerText = $('#timer-' + taskId).text().trim();
            var parts = timerText.split(':');

            var hours = parseInt(parts[0]) || 0;
            var minutes = parseInt(parts[1]) || 0;
            var seconds = parseInt(parts[2]) || 0;

            var timerSeconds = (hours * 3600) + (minutes * 60) + seconds;

            timers[taskId] = setInterval(function() {
                if (timerSeconds > 0) {
                    timerSeconds--;
                    hours = Math.floor(timerSeconds / 3600);
                    minutes = Math.floor((timerSeconds % 3600) / 60);
                    seconds = timerSeconds % 60;
                    $('#timer-' + taskId).text(formatTime(hours, minutes, seconds));
                } else {
                    clearInterval(timers[taskId]);
                    if ({{ auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager() ? 'true' : 'false' }}) {
                        $('#reviewBtn-' + taskId).removeClass('d-none');
                    }
                }
            }, 1000);
        }

        function stopTimer(taskId) {
            clearInterval(timers[taskId]);
            $('#hidden-timer-' + taskId).val($('#timer-' + taskId).text());

            if ({{ auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager() ? 'true' : 'false' }}) {
                $('#reviewBtn-' + taskId).removeClass('d-none');
            }
        }

        function formatTime(hours, minutes, seconds) {
            return hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
        }
        $(document).on('click', '.start-timer-btn', function() {
            var taskId = $(this).data('task-id');
            $('#completeBtn-' + taskId).removeClass('d-none'); 
            startTimer(taskId); 
        });


        $(document).on('click', '.stop-timer-btn', function() {
            var taskId = $(this).data('task-id');
            stopTimer(taskId);

            $(this).closest('form').submit();
        });
    </script>
@endsection
