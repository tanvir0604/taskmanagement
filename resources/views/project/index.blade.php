<x-layout>
    <x-slot:title>
        Task Manager | Project Management
    </x-slot>

    <div class="float-end">
        <a href="{{route('new-project')}}" class="btn btn-primary">Create New Project</a>
    </div>
    <h2>Project List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Total Tasks</th>
                <th>Create Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-striped">
            @foreach ($projects as $project)
            <tr>
                <td>{{$project->name}}</td>
                <td><a href="{{route('task', ['project' => $project->id])}}">{{$project->tasks_count}}</a></td>
                <td>{{$project->created_at}}</td>
                <td>
                    <a href="{{route('edit-project', ['id' => $project->id])}}">Edit</a>
                    <a onclick="return confirm('Are you sure to delete this item?')" href="{{route('delete-project', ['id' => $project->id])}}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>