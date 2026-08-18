<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $exam->title }} - Live Exam</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0B0B0C] text-gray-200 antialiased font-sans select-none" oncontextmenu="return false;">

    <!-- Top bar with timer -->
    <div class="bg-[#121214] border-b border-white/[0.05] p-4 flex justify-between items-center sticky top-0 z-10 shadow-xl backdrop-blur-md bg-opacity-95">
        <div>
            <h1 class="font-serif font-bold text-lg sm:text-xl text-white tracking-wide">{{ $exam->title }}</h1>
        </div>
        <div id="timer" class="text-lg sm:text-xl font-mono bg-rose-500/10 border border-rose-500/30 text-rose-400 px-4 py-1.5 rounded-xl shadow-[0_0_15px_rgba(244,63,94,0.1)]">
            --:--
        </div>
    </div>

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 space-y-6">

        <!-- Question navigator grid -->
        <div class="bg-[#121214] border border-white/[0.05] rounded-2xl p-4 shadow-xl flex flex-wrap gap-2.5" id="question-nav">
            @foreach ($exam->questions as $index => $q)
                <button type="button"
                        class="nav-btn w-10 h-10 rounded-xl border border-white/[0.08] bg-[#1A1A1E] text-gray-400 hover:text-white hover:border-amber-400/40 text-sm font-semibold transition-all duration-200 shadow-sm cursor-pointer"
                        data-index="{{ $index }}"
                        onclick="goToQuestion({{ $index }})">
                    {{ $index + 1 }}
                </button>
            @endforeach
        </div>

        <!-- Main Question Card -->
        <div class="bg-[#121214] border border-white/[0.05] rounded-2xl p-6 sm:p-8 shadow-2xl relative">
            @foreach ($exam->questions as $index => $q)
                <div class="question-block {{ $index === 0 ? '' : 'hidden' }}" data-question-index="{{ $index }}" data-question-id="{{ $q->id }}">
                    
                    <!-- Card Top Tracker info -->
                    <div class="flex justify-between items-center mb-6">
                        <p class="font-medium text-xs sm:text-sm text-gray-400 uppercase tracking-wider">
                            Question <span class="text-white font-bold">{{ $index + 1 }}</span> of {{ $exam->questions->count() }}
                        </p>
                        <button type="button"
                                class="bookmark-btn text-xl sm:text-2xl text-gray-500 hover:text-amber-400 transition-colors transform active:scale-90 cursor-pointer"
                                data-question-id="{{ $q->id }}"
                                onclick="toggleBookmark({{ $q->id }}, this)">
                            {{ in_array($q->id, $bookmarkedIds) ? '⭐' : '☆' }}
                        </button>
                    </div>

                    <!-- Main Question Body -->
                    <p class="text-lg sm:text-xl font-serif text-white leading-relaxed mb-8">{{ $q->question_text }}</p>

                    <!-- MCQ Dynamic Options List -->
                    <div class="space-y-3.5">
                        @foreach ($q->options as $key => $optionText)
                            <label class="flex items-center p-4 border border-white/[0.04] bg-white/[0.01] rounded-xl cursor-pointer hover:bg-white/[0.03] hover:border-amber-400/30 transition-all duration-200 group option-label relative overflow-hidden">
                                <input type="radio"
                                       name="question_{{ $q->id }}"
                                       value="{{ $key }}"
                                       class="w-4 h-4 mr-4 text-amber-500 bg-[#1A1A1E] border-white/[0.1] focus:ring-amber-400/30 focus:ring-offset-[#121214] answer-radio"
                                       data-question-id="{{ $q->id }}"
                                       {{ ($savedAnswers[$q->id] ?? null) === $key ? 'checked' : '' }}
                                       onchange="saveAnswer({{ $q->id }}, '{{ $key }}')">
                                <span class="text-gray-300 group-hover:text-white transition-colors text-sm sm:text-base">
                                    <strong class="text-amber-400/80 group-hover:text-amber-400 mr-1 font-mono">{{ $key }}.</strong> {{ $optionText }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    <!-- Clear Response Trigger -->
                    <div class="mt-5 flex justify-start">
                        <button type="button" class="text-xs font-semibold text-rose-400/70 hover:text-rose-400 uppercase tracking-wider bg-rose-500/5 hover:bg-rose-500/10 px-3 py-1.5 rounded-lg border border-rose-500/10 transition-all cursor-pointer" onclick="clearAnswer({{ $q->id }})">
                            Clear Answer
                        </button>
                    </div>
                </div>
            @endforeach

            <!-- Footer Pagination Action Buttons -->
            <div class="flex justify-between mt-8 pt-5 border-t border-white/[0.05] gap-4">
                <button type="button" id="prevBtn" onclick="prevQuestion()"
                        class="bg-[#1A1A1E] border border-white/[0.05] text-gray-300 px-5 py-2.5 rounded-xl hover:text-white hover:bg-white/[0.03] text-sm font-semibold transition-all cursor-pointer">
                    ← Previous
                </button>
                <button type="button" id="nextBtn" onclick="nextQuestion()"
                        class="bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] text-black px-6 py-2.5 rounded-xl text-sm font-bold shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:from-white hover:to-[#E2B767] transition-all transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer">
                    Next →
                </button>
            </div>
        </div>

        <!-- Big Form Master Submit Trigger -->
        <button type="button" onclick="confirmSubmit()"
                class="w-full mt-4 flex justify-center items-center py-4 border border-transparent rounded-2xl text-base font-serif font-bold text-black bg-gradient-to-r from-emerald-400 to-teal-400 hover:from-emerald-300 hover:to-teal-300 shadow-[0_4px_25px_rgba(16,185,129,0.15)] hover:shadow-[0_4px_30px_rgba(16,185,129,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer">
            Submit Exam
        </button>
    </div>

    <!-- Hidden submit form -->
    <form id="submitForm" action="{{ route('exams.submit', $attempt) }}" method="POST" class="hidden">
        @csrf
    </form>

    <!-- Aesthetic Anti-Cheat Warning Modal -->
    <div id="cheatModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-[#121214] border border-rose-500/20 rounded-2xl p-6 sm:p-8 max-w-sm w-full text-center shadow-2xl transform scale-95 transition-all">
            <div class="w-14 h-14 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                <span class="text-2xl leading-none">⚠️</span>
            </div>
            <h2 class="text-xl font-serif font-bold text-white mb-2">Exam Cancelled</h2>
            <p class="text-gray-400 text-sm leading-relaxed">You switched tabs or left the live window. Your current attempt has been automatically submitted and locked due to security parameters.</p>
            <div class="mt-6">
                <a href="{{ route('exams.result', $attempt) }}" class="w-full block text-center bg-rose-600 hover:bg-rose-500 text-white font-semibold py-3 px-4 rounded-xl shadow-[0_4px_15px_rgba(225,29,72,0.2)] transition-all transform hover:-translate-y-0.5">
                    View Results
                </a>
            </div>
        </div>
    </div>


 <script>
        const attemptId = {{ $attempt->id }};
        const totalQuestions = {{ $exam->questions->count() }};
        let currentIndex = 0;
        let remainingSeconds = Math.floor({{ $remainingSeconds }});
        let examEnded = false;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // ===== Timer =====
       function formatTime(seconds) {
    const totalSecs = Math.floor(seconds);
    const m = Math.floor(totalSecs / 60).toString().padStart(2, '0');
    const s = (totalSecs % 60).toString().padStart(2, '0');
    return `${m}:${s}`;
}

        function updateTimerDisplay() {
            document.getElementById('timer').textContent = formatTime(remainingSeconds);
            if (remainingSeconds <= 60) {
                document.getElementById('timer').classList.add('animate-pulse');
            }
        }

        updateTimerDisplay();

        const timerInterval = setInterval(() => {
            remainingSeconds--;
            updateTimerDisplay();
            if (remainingSeconds <= 0) {
                clearInterval(timerInterval);
                autoSubmit();
            }
        }, 1000);

        function autoSubmit() {
            if (examEnded) return;
            examEnded = true;
            alert('Time is up! Your exam is being submitted automatically.');
            document.getElementById('submitForm').submit();
        }

        // ===== Question Navigation =====
        function goToQuestion(index) {
            document.querySelectorAll('.question-block').forEach(el => el.classList.add('hidden'));
            document.querySelector(`[data-question-index="${index}"]`).classList.remove('hidden');
            currentIndex = index;
            updateNavHighlight();
            document.getElementById('prevBtn').style.visibility = index === 0 ? 'hidden' : 'visible';
            document.getElementById('nextBtn').textContent = (index === totalQuestions - 1) ? 'Finish' : 'Next →';
        }

        function nextQuestion() {
            if (currentIndex < totalQuestions - 1) {
                goToQuestion(currentIndex + 1);
            }
        }

        function prevQuestion() {
            if (currentIndex > 0) {
                goToQuestion(currentIndex - 1);
            }
        }

        function updateNavHighlight() {
            document.querySelectorAll('.nav-btn').forEach(btn => {
                const idx = parseInt(btn.dataset.index);
                btn.classList.remove('bg-blue-600', 'text-white', 'bg-gray-300');
                if (idx === currentIndex) {
                    btn.classList.add('bg-blue-600', 'text-white');
                }
            });
            refreshAnsweredMarks();
        }

        function refreshAnsweredMarks() {
            document.querySelectorAll('.question-block').forEach((block, idx) => {
                const answered = block.querySelector('.answer-radio:checked');
                const btn = document.querySelector(`.nav-btn[data-index="${idx}"]`);
                if (answered && idx !== currentIndex) {
                    btn.classList.add('bg-green-100');
                } else if (idx !== currentIndex) {
                    btn.classList.remove('bg-green-100');
                }
            });
        }

        // ===== Save Answer (AJAX) =====
        function saveAnswer(questionId, selectedOption) {
            fetch(`/attempts/${attemptId}/save-answer`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ question_id: questionId, selected_option: selectedOption }),
            });
            refreshAnsweredMarks();
        }

        function clearAnswer(questionId) {
            document.querySelectorAll(`input[name="question_${questionId}"]`).forEach(el => el.checked = false);
            saveAnswer(questionId, null);
        }

        // ===== Bookmark =====
        function toggleBookmark(questionId, btnEl) {
            fetch(`/bookmark/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ question_id: questionId }),
            })
            .then(res => res.json())
            .then(data => {
                btnEl.textContent = data.bookmarked ? '⭐' : '☆';
            });
        }

        // ===== Submit =====
        function confirmSubmit() {
            const answeredCount = document.querySelectorAll('.answer-radio:checked').length;
            const unanswered = totalQuestions - answeredCount;
            const msg = unanswered > 0
                ? `You have ${unanswered} unanswered question(s). Are you sure you want to submit?`
                : 'Are you sure you want to submit the exam?';

            if (confirm(msg)) {
                examEnded = true;
                document.getElementById('submitForm').submit();
            }
        }

        // ===== Anti-Cheat: Tab switch / minimize detection =====
        document.addEventListener('visibilitychange', function () {
            if (document.hidden && !examEnded) {
                reportViolation();
            }
        });

        window.addEventListener('blur', function () {
            if (!examEnded) {
                reportViolation();
            }
        });

        let violationReported = false;
        function reportViolation() {
            if (violationReported || examEnded) return;
            violationReported = true;
            examEnded = true;
            clearInterval(timerInterval);

            fetch(`/attempts/${attemptId}/violation`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({}),
            }).finally(() => {
                document.getElementById('cheatModal').classList.remove('hidden');
            });
        }

        // Prevent accidental navigation
        window.addEventListener('beforeunload', function (e) {
            if (!examEnded) {
                e.preventDefault();
                e.returnValue = '';
            }
        });

        // Init
        goToQuestion(0);
    </script>
</body>
</html>