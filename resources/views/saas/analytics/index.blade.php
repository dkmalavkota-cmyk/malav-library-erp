<x-layouts.saas :title="__('Analytics')">

    <style>
        .analytics-page {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .eyebrow {
            margin: 0 0 7px;
            color: #8493aa;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            color: #f5f7fb;
            font-size: 29px;
            line-height: 1.15;
            font-weight: 760;
            letter-spacing: -.03em;
        }

        .page-description {
            margin: 8px 0 0;
            color: #7f8da2;
            font-size: 13px;
            line-height: 1.6;
            max-width: 700px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 12px;
        }

        .summary-card {
            padding: 16px;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 15px;
            background:
                linear-gradient(145deg, rgba(255,255,255,.045), rgba(255,255,255,.018)),
                rgba(9,15,27,.72);
        }

        .summary-label {
            color: #6f7e94;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .summary-value {
            margin-top: 7px;
            color: #edf2f8;
            font-size: 22px;
            line-height: 1;
            font-weight: 760;
        }

        .summary-meta {
            margin-top: 7px;
            color: #69788e;
            font-size: 10px;
            line-height: 1.4;
        }

        .table-card {
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 17px;
            background: rgba(9,15,27,.72);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 20px;
            border-bottom: 1px solid rgba(255,255,255,.06);
        }

        .section-title {
            margin: 0;
            color: #e5ebf3;
            font-size: 14px;
            font-weight: 750;
        }

        .section-description {
            margin: 5px 0 0;
            color: #69788e;
            font-size: 10px;
            line-height: 1.5;
        }

        .results-count {
            padding: 6px 9px;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 999px;
            background: rgba(255,255,255,.025);
            color: #7b899d;
            font-size: 9px;
            font-weight: 700;
            white-space: nowrap;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .analytics-table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        .analytics-table th {
            padding: 13px 15px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            color: #68778d;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .08em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .analytics-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255,255,255,.045);
            color: #cbd5e1;
            font-size: 12px;
            vertical-align: middle;
        }

        .analytics-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .analytics-table tbody tr:hover {
            background: rgba(255,255,255,.018);
        }

        .library-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 200px;
        }

        .library-avatar {
            width: 35px;
            height: 35px;
            flex: 0 0 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 10px;
            background: linear-gradient(145deg,#202c42,#121a29);
            color: #dce5f2;
            font-size: 12px;
            font-weight: 800;
        }

        .library-name {
            color: #e2e8f1;
            font-size: 12px;
            font-weight: 700;
        }

        .library-code {
            margin-top: 3px;
            color: #65748a;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .metric-value {
            color: #dce4ee;
            font-size: 12px;
            font-weight: 750;
        }

        .metric-label {
            margin-top: 3px;
            color: #647389;
            font-size: 9px;
        }

        .usage-bar {
            width: 100%;
            min-width: 90px;
            max-width: 130px;
            height: 4px;
            margin-top: 6px;
            overflow: hidden;
            border-radius: 999px;
            background: rgba(255,255,255,.055);
        }

        .usage-fill {
            height: 100%;
            border-radius: inherit;
            background: rgba(142,166,255,.55);
        }

        .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 42px;
            height: 42px;
            margin: 0 auto 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 12px;
            background: rgba(255,255,255,.025);
            color: #68778d;
        }

        .empty-icon svg {
            width: 19px;
            height: 19px;
        }

        .empty-title {
            margin: 0;
            color: #e3e9f2;
            font-size: 16px;
            font-weight: 700;
        }

        .empty-text {
            margin: 7px 0 0;
            color: #6d7b90;
            font-size: 12px;
        }

        @media (max-width: 1200px) {
            .summary-grid {
                grid-template-columns: repeat(3, minmax(0,1fr));
            }
        }

        @media (max-width: 700px) {
            .summary-grid {
                grid-template-columns: repeat(2, minmax(0,1fr));
            }

            .page-title {
                font-size: 25px;
            }
        }

        @media (max-width: 430px) {
            .summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="analytics-page">

        {{-- Header --}}
        <div class="page-header">
            <div>
                <p class="eyebrow">Platform Intelligence</p>

                <h1 class="page-title">
                    Analytics
                </h1>

                <p class="page-description">
                    Monitor platform adoption, student activity and examination usage across every customer library.
                </p>
            </div>
        </div>

        {{-- Summary --}}
        <div class="summary-grid">

            <div class="summary-card">
                <div class="summary-label">Libraries</div>

                <div class="summary-value">
                    {{ number_format($summary['libraries']) }}
                </div>

                <div class="summary-meta">
                    Active customer base
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Students</div>

                <div class="summary-value">
                    {{ number_format($summary['students']) }}
                </div>

                <div class="summary-meta">
                    Total registered students
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Exam Students</div>

                <div class="summary-value">
                    {{ number_format($summary['exam_students']) }}
                </div>

                <div class="summary-meta">
                    Students using examinations
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Exams</div>

                <div class="summary-value">
                    {{ number_format($summary['exams']) }}
                </div>

                <div class="summary-meta">
                    Platform exam inventory
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Questions</div>

                <div class="summary-value">
                    {{ number_format($summary['questions']) }}
                </div>

                <div class="summary-meta">
                    Central question inventory
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Attempts</div>

                <div class="summary-value">
                    {{ number_format($summary['attempts']) }}
                </div>

                <div class="summary-meta">
                    Total exam attempts
                </div>
            </div>

        </div>

        {{-- Library Usage --}}
        <section class="table-card">

            <div class="section-header">

                <div>
                    <h2 class="section-title">
                        Library Usage
                    </h2>

                    <p class="section-description">
                        Compare examination activity and platform usage customer by customer.
                    </p>
                </div>

                <div class="results-count">
                    {{ $libraryUsage->count() }} libraries
                </div>

            </div>

            @if($libraryUsage->count())

                @php
                    $maxAttempts = max(
                        1,
                        $libraryUsage->max('attempts')
                    );
                @endphp

                <div class="table-wrap">

                    <table class="analytics-table">

                        <thead>
                            <tr>
                                <th>Library</th>
                                <th>Students</th>
                                <th>Exam Students</th>
                                <th>Exams</th>
                                <th>Questions</th>
                                <th>Attempts</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($libraryUsage as $item)

                                @php
                                    $library = $item['library'];

                                    $initial = strtoupper(
                                        mb_substr(
                                            $library->name ?: 'L',
                                            0,
                                            1
                                        )
                                    );

                                    $attemptPercentage = min(
                                        100,
                                        ($item['attempts'] / $maxAttempts) * 100
                                    );
                                @endphp

                                <tr>

                                    {{-- Library --}}
                                    <td>

                                        <div class="library-cell">

                                            <div class="library-avatar">
                                                {{ $initial }}
                                            </div>

                                            <div>
                                                <div class="library-name">
                                                    {{ $library->name }}
                                                </div>

                                                <div class="library-code">
                                                    {{ $library->code }}
                                                </div>
                                            </div>

                                        </div>

                                    </td>

                                    {{-- Students --}}
                                    <td>

                                        <div class="metric-value">
                                            {{ number_format($item['students']) }}
                                        </div>

                                        <div class="metric-label">
                                            Registered
                                        </div>

                                    </td>

                                    {{-- Exam Students --}}
                                    <td>

                                        <div class="metric-value">
                                            {{ number_format($item['exam_students']) }}
                                        </div>

                                        <div class="metric-label">
                                            Exam enabled
                                        </div>

                                    </td>

                                    {{-- Exams --}}
                                    <td>

                                        <div class="metric-value">
                                            {{ number_format($item['exams']) }}
                                        </div>

                                        <div class="metric-label">
                                            Created exams
                                        </div>

                                    </td>

                                    {{-- Questions --}}
                                    <td>

                                        <div class="metric-value">
                                            {{ number_format($item['questions']) }}
                                        </div>

                                        <div class="metric-label">
                                            Question bank
                                        </div>

                                    </td>

                                    {{-- Attempts --}}
                                    <td>

                                        <div class="metric-value">
                                            {{ number_format($item['attempts']) }}
                                        </div>

                                        <div class="metric-label">
                                            Exam attempts
                                        </div>

                                        <div class="usage-bar">
                                            <div
                                                class="usage-fill"
                                                style="width: {{ $attemptPercentage }}%;"
                                            ></div>
                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M4 19V5"></path>
                            <path d="M4 19h16"></path>
                            <path d="M8 16v-5"></path>
                            <path d="M12 16V8"></path>
                            <path d="M16 16v-3"></path>
                        </svg>
                    </div>

                    <h3 class="empty-title">
                        No analytics data available
                    </h3>

                    <p class="empty-text">
                        Platform activity will appear here as customers use the system.
                    </p>

                </div>

            @endif

        </section>

    </div>

</x-layouts.saas>