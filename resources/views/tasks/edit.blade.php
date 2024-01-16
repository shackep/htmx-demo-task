<form>
<input type="text" name="name" value="{{$task->name}}" autocomplete="off" required>
<button hx-indicator="#spinner" type="button" hx-patch="{{ route('tasks.update', $task) }}" hx-target="closest tr"
            hx-swap="outerHTML">Save <span id='spinner' class="htmx-indicator">⏳</span></button>
</form>