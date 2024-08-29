<x-layout>
    <x-slot:title>
        Taskmanagement | Task List
    </x-slot>
    <div class="float-end">
        <form action="" class="d-inline me-4">
            <select onchange="this.form.submit()" name="project" class="form-select d-inline w-auto">
                <option value="">Select Project</option>
                @foreach ($projects as $project)
                    <option {{request()->get('project') == $project->id ? 'selected' : ''}} value="{{$project->id}}">{{$project->name}}</option>
                @endforeach
            </select>
        </form>

        <a href="{{route('new-task')}}" class="btn btn-primary row d-inline">Create New Task</a>
        
    </div>
    <h2>Task List</h2>
    
    <x-task class="mb-1" :task="new stdClass()" />
    <div class="d-grid gap-1 draggable">
        @foreach ($tasks as $task)
            <x-task class="draggable-item" :task="$task" />
        @endforeach
    </div>
    @section('script')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src= "https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


    <script type="text/javascript">

    function updateDb(){
        let sortedItems = $('.draggable').sortable("serialize");
        $.ajax({
            url: "<?php echo route('update-priority') ?>",
            data: sortedItems+'&project=<?php echo request()->get('project'); ?>',
            type: "get",
            success: function (data) {
                window.location.reload();
            }
        });
    }

    $(function(){
        $('.draggable').sortable({
            opacity: 0.6,
            connectWith: '.draggable',
            ghostClass: "blue-background-class",
            cursor: 'move',
            stop: function(e, ui){
                updateDb();    
            }
            
        });
    });
    </script>
    @endsection
</x-layout>