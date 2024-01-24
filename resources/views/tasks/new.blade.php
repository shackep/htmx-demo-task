<form id="task-form" autocomplete="off">
        <input type="text" name="name" placeholder="New Task" autocomplete="off" required>
        <input type="hidden" name="group_key" value="{{ session('group_key') }}">
        <input type="hidden" name="list_name" value="{{ $list_name }}">
        <button hx-indicator="#spinner" type="button" hx-post="{{ route('tasks.store') }}" hx-target='#task-list' hx-swap='afterbegin'>Add Item <span id='spinner' class="htmx-indicator">⏳</span></button>
    </form>
<script>
        // Clear the form input after successful post
        document.getElementById('task-form').addEventListener('htmx:afterRequest', function (event) {
            this.reset(); // Reset the form input
        });
</script>