@extends('layouts.admin')

@section('title', 'قائمة المهام')

@section('contentheader')
    قائمة المهام
@endsection

@section('contentheaderactivelink')
    <a href="{{ route('tasks.index') }}">المهام</a>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            @can('إضافة مهمة جديدة')
                <a href="{{ route('tasks.create') }}" class="btn btn-primary float-right">إضافة مهمة جديدة</a>
            @endcan
        </div>
        <!-- /.card-header -->
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
                        @if ((auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()))
                        <th>الإجراءات</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->admin->name }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                <span id="timer-{{ $task->id }}">{{ $task->timer }}</span>
                            </td>
                            <td>{{ $task->review ?? 'لم يتم تقييم التاسك' }}</td>
                            <td>{{ $task->status  }}</td>

                            @if ((auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()))
                            <td>
                                <button type="button" class="btn btn-success start-timer-btn" data-task-id="{{ $task->id }}" {{ $task->review ? 'disabled' : '' }}>ابدأ المؤقت</button>
                                <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger stop-timer-btn" data-task-id="{{ $task->id }}" {{ $task->review ? 'disabled' : '' }}>إيقاف المؤقت</button>
                                    <input type="hidden" name="timer" id="hidden-timer-{{ $task->id }}" value="{{ $task->timer }}">
                                </form>
                                @if (($task->timer === "00:00:00" || session('timer_stopped')) && (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()))
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reviewModal{{ $task->id }}" {{ $task->review ? 'disabled' : '' }}>
                                        تقييم التاسك
                                    </button>
                                @endif
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($tasks as $task)
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
                        <form action="{{ route('tasks.review', $task->id) }}" method="POST">
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
            startTimer(taskId);
        });

        $(document).on('click', '.stop-timer-btn', function() {
            var taskId = $(this).data('task-id');
            stopTimer(taskId);

            $('#hidden-timer-' + taskId).val($('#timer-' + taskId).text());

            $(this).closest('form').submit();
        });
    </script>
@endsection
