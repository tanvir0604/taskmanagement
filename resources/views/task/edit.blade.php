<x-layout>
    <x-slot:title>
        Task Manager | Edit Task
    </x-slot>
    <h2></h2>


    <div class="card" style="">
        <div class="card-body">
          <h5 class="card-title">Edit Task</h5>
          <form method="POST">
            @csrf

            <div class="mb-3">
                <label for="taskName" class="form-label">Project</label>
                @error('project')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <select name="project" class="form-select" aria-label="Default select example">
                    <option value="">Select Project</option>
                    @foreach ($projects as $item)
                        <option {{$item->id == $task->project_id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="taskName" class="form-label">Name</label>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="text" class="form-control" id="taskName" name="name" value="{{$task->name}}" aria-describedby="nameHelp">
                <div id="nameHelp" class="form-text">Task name should be unique</div>
            </div>

            {{-- <div class="mb-3">
                <label for="taskPriority" class="form-label">Priority</label>
                @error('priority')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="number" class="form-control" id="taskPriority" name="priority" value="{{$task->priority}}" aria-describedby="priorityHelp">
            </div> --}}
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
      </div>
    
    
</x-layout>