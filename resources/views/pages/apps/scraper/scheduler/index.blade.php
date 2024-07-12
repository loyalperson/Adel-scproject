<x-default-layout>
    @section('title')
        Scraping Scheduler
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('scraper.scheduler') }}
    @endsection

    <h1>Scraping Scheduler</h1>
    <div class="container">
        <form action="{{ route('scraper.schedule') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="query">Search Query</label>
                <input type="text" class="form-control" id="query" name="query" required>
            </div>
            <div class="form-group">
                <label for="frequency">Frequency</label>
                <select class="form-control" id="frequency" name="frequency" required onchange="updateScheduleTimesLabel()">
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div>
            <div class="form-group">
                <label for="schedule_times" id="schedule_times_label">Times (HH:MM, separated by commas, NOTE: Use 24 Hour Time, i.e. 16:24, 22:45)</label>
                <input type="text" class="form-control" id="schedule_times" name="schedule_times" required>
            </div>
            <button type="submit" class="btn btn-primary">Schedule Search</button>
        </form>
    </div>

    <script>
        function updateScheduleTimesLabel() {
            const frequency = document.getElementById('frequency').value;
            const scheduleTimesLabel = document.getElementById('schedule_times_label');

            if (frequency === 'daily') {
                scheduleTimesLabel.innerText = 'Times (HH:MM, separated by commas)';
            } else if (frequency === 'weekly') {
                scheduleTimesLabel.innerText = 'Days (e.g., Monday, Tuesday, etc. separated by commas)';
            } else if (frequency === 'monthly') {
                scheduleTimesLabel.innerText = 'Days of the month (e.g., 13, 23, 45, etc. separated by commas)';
            }
        }

        // Call the function initially to set the correct label on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateScheduleTimesLabel();
        });
    </script>
</x-default-layout>