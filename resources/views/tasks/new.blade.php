<form id="task-form" autocomplete="off">
        <input type="text" name="name" placeholder="New Task" autocomplete="off" required>
        <input type="hidden" name="group_key" value="{{ session('group_key') }}">
        <button hx-indicator="#spinner" type="button" hx-post="{{ route('tasks.store') }}" hx-target='#task-list' hx-swap='afterbegin'>Add Task</button>
    </form>
<script>
        // Clear the form input after successful post
        document.getElementById('task-form').addEventListener('htmx:afterRequest', function (event) {
            this.reset(); // Reset the form input
        });
</script>