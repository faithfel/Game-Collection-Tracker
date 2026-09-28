<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Collection Tracker</title>
    <script src="https://jsdelivr.net"></script>
    <link rel="stylesheet" href="css/styles.css">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">
        
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white p-6 rounded-lg mb-8">
           <h1 class="text-center text-3xl font-bold mb-6 text-black border-b border-gray-300   "> Game Collection Tracker</h1> 
            <h2 class="text-xl font-semibold mb-4">Add New Game</h2>
            <form action="{{ route('games.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Game Title</label>
                    <input type="text" name="title" required class="mt-1 block w-full rounded border-gray-300 p-2 border">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Platform</label>
                    <input type="text" name="platform" placeholder="PC, PS5, Switch" required class="mt-1 block w-full rounded border-gray-300 p-2 border">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 block w-full rounded border-gray-300 p-2 border">
                        <option value="Backlog">Backlog</option>
                        <option value="Playing">Playing</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <button type="submit" class="bg-amber-400 text-white px-4 py-2 rounded hover:bg-amber-500 h-11">Add Game</button>
            </form>
        </div>

     
        <div class="bg-white rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="p-4">Title</th>
                        <th class="p-4">Platform</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($games as $game)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4 font-medium">{{ $game->title }}</td>
                            <td class="p-4"><span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-sm">{{ $game->platform }}</span></td>
                            <td class="p-4">
            
                                <form action="{{ route('games.update', $game) }}" method="POST" class="flex gap-2 items-center">
                                    @csrf @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="text-sm rounded border p-1">
                                        <option value="Backlog" {{ $game->status == 'Backlog' ? 'selected' : '' }}>Backlog</option>
                                        <option value="Playing" {{ $game->status == 'Playing' ? 'selected' : '' }}>Playing</option>
                                        <option value="Completed" {{ $game->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </form>
                            </td>
                            <td class="p-4">
                                <form action="{{ route('games.destroy', $game) }}" method="POST" onsubmit="return confirm('Remove this game?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
