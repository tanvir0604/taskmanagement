<x-layout>
    <x-slot:title>
        Task Manager | Create New Project
    </x-slot>
    <h2></h2>


    <div class="card" style="">
        <div class="card-body">
          <h5 class="card-title">Create New Project</h5>
          <form method="POST">
            @csrf
            <div class="mb-3">
                <label for="projectName" class="form-label">Name</label>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="text" class="form-control" id="projectName" name="name" value="{{old('name')}}" aria-describedby="nameHelp">
                <div id="nameHelp" class="form-text">Project name should be unique</div>
                
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
      </div>
    
    
</x-layout>