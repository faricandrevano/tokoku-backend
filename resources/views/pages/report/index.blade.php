@extends('layouts.dashboard')

@section('main')
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-8">

            {!! $chart->container() !!}
            {!! $chart1->container() !!}

            <script src="{{ $chart->cdn() }}"></script>
            {{ $chart->script() }}
            <script src="{{ $chart1->cdn() }}"></script>
            {{ $chart1->script() }}
        </div>
    </section>
@endsection
