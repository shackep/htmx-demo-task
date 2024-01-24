<div id="forms__select">
    <label for="select">Show</label>
    <select id="select" hx-get="" hx-on="htmx:configRequest: event.detail.path = this.value" hx-trigger='change' hx-select='#task-list' hx-target='#task-list' hx-swap='outerHTML'>
          <optgroup label="Option Group">
            <option value="{{ route('tasks.index') }}/{{ session('group_key')}}">
              All
            </option>
            <option value="{{ route('tasks.index') }}/{{ session('group_key')}}?filter=remaining">
              Remaining
            </option>
            <option value="{{ route('tasks.index') }}/{{ session('group_key')}}?filter=done">
              Done
            </option>
          </optgroup>
    </select>
</div>

<table>
    <thead>
        <tr>
          <th>Item</th>
          <th>Action</th>
        </tr>
    </thead>
        <tbody id='task-list'>    
            @foreach ($tasks as $task)
                @include('tasks.task')
            @endforeach 
        </tbody>
    </form>
</table>