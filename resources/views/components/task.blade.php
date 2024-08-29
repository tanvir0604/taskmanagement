<div class="{{$class}} bg-white border rounded p-3 row {{isset($task->id)?'fw-normal':'fw-bold'}}" id="item_{{$task->priority??''}}s{{$task->id??''}}">
    <span class="col-3">{{$task->name??'Name'}}</span>
    <span class="col-3">{{$task->project->name??'Project'}}</span>
    <span class="col-1">{{$task->priority??'Priority'}}</span>
    <span class="col-2">{{$task->created_at??'Create Date'}}</span>
    <span class="col-3 text-end">
        @if (isset($task->id))
            <a href="{{route('edit-task', ['id' => $task->id])}}">Edit</a>
            <a onclick="return confirm('Are you sure to delete this item?')" href="{{route('delete-task', ['id' => $task->id])}}">Delete</a>
        @else
            Action    
        @endif
        
    </span>
</div>