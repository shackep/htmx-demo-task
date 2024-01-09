
<tr>
    <td>@if($task->done) ✅ @endif <span class='name'>{{ $task->name }}</span> </td>
    <td>
        <button class="delete" role="button"
            hx-delete="{{ route('tasks.destroy', $task) }}"
            hx-target="closest tr"
            hx-swap="delete"
            >
        Delete
        </button>

        <button class="done" role="button"
            hx-patch="{{ route('tasks.update', $task) }}"
            hx-target="closest tr"
            hx-swap="outerHTML"
            >
        @if($task->done)
        Undo
        @else
        Done
        @endif
        </button>
        <button class='edit' role="button"
            hx-get="{{ route('tasks.edit', $task) }}"
            hx-target="previous span.name"
            hx-swap="outerHTML"
            hx-trigger="click"
            >
        Edit    
        </button>
    </td>
</tr>

@if ($task->count)
    @include('tasks.count')
@endif
   