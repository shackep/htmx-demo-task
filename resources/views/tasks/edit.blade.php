<form>
<input type="text" name="name" value="{{$task->name}}" autocomplete="off" required>
<button type="button" hx-patch="{{ route('tasks.update', $task) }}" hx-target="closest tr"
            hx-swap="outerHTML">Save</button>
</form>