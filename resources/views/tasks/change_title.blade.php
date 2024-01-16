<form>
    <input type="text" name="list_name" value="{{$list_name ?? 'Task List'}}" autocomplete="off" required>
    <input type="hidden" name="group_key" value="{{ $group_key }}">
    <button type="button" hx-post="{{ route('tasks.namelist', ['group_key' => $group_key]) }}" hx-target="h1" hx-select="h1"
            hx-swap="outerHTML">Save</button>
</form>