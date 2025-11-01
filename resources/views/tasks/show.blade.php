<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $task->title }}</h2>
                        <div class="flex items-center space-x-4 mt-2">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $task->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $task->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                {{ $task->priority === 'high' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $task->priority === 'medium' ? 'bg-orange-100 text-orange-800' : '' }}
                                {{ $task->priority === 'low' ? 'bg-gray-100 text-gray-800' : '' }}">
                                {{ ucfirst($task->priority) }} Priority
                            </span>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('tasks.edit', $task) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition text-sm font-medium">
                            Edit
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition text-sm font-medium">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Task Details -->
            <div class="p-6 space-y-6">
                <!-- Description -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Description</h3>
                    <div class="text-gray-800 whitespace-pre-wrap bg-gray-50 rounded-lg p-4">
                        {{ $task->description ?: 'No description provided.' }}
                    </div>
                </div>

                <!-- Task Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Owner -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Task Owner</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-800 font-medium">{{ $task->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $task->user->email }}</p>
                            <span class="inline-block mt-2 px-2 py-1 text-xs rounded-full 
                                {{ $task->user->isAdmin() ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($task->user->role) }}
                            </span>
                        </div>
                    </div>

                    <!-- Due Date -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Due Date</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($task->due_date)
                                <p class="text-gray-800 font-medium">{{ $task->due_date->format('F d, Y') }}</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    @if($task->due_date->isPast())
                                        <span class="text-red-600">Overdue by {{ $task->due_date->diffForHumans() }}</span>
                                    @else
                                        <span class="text-green-600">Due {{ $task->due_date->diffForHumans() }}</span>
                                    @endif
                                </p>
                            @else
                                <p class="text-gray-500 italic">No due date set</p>
                            @endif
                        </div>
                    </div>

                    <!-- Created At -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Created</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-800">{{ $task->created_at->format('F d, Y') }}</p>
                            <p class="text-sm text-gray-600">{{ $task->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <!-- Last Updated -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Last Updated</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-800">{{ $task->updated_at->format('F d, Y') }}</p>
                            <p class="text-sm text-gray-600">{{ $task->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <a href="{{ route('tasks.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                    ← Back to Tasks
                </a>
            </div>
        </div>
    </div>
</x-app-layout>