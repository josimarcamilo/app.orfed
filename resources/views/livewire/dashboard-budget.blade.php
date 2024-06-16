<div>
    <h1>Dashboard Budget {{ $budget->id }}</h1>
    <h2>Categorias</h2>
    <div>
        <form wire:submit="createCategory()">
            <label>
                <span>Descricao</span>
                <input wire:model="categoryDescription" type="text" required>
                @error('categoryDescription') <em> {{ $message }} </em> @enderror
            </label>
            <button type="submit">Criar</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Descricao</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr wire:key="{{ $category->id }}">
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->cod }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <button 
                                type="button"
                                wire:click="deleteCategory({{$category->id}})"
                                wire:confirm="Deseja realmente excluir?"
                            >Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h2>Receitas</h2>
    <div>
        <form wire:submit="createEntry()">
            <label>
                <span>Descricao</span>
                <input wire:model="entryDescription" type="text" required>
                @error('entryDescription') <em> {{ $message }} </em> @enderror
            </label>
            <label>
                <span>Descricao</span>
                <input wire:model="entryAmount" type="text" required>
                @error('entryAmount') <em> {{ $message }} </em> @enderror
            </label>
            <button type="submit">Criar</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Descricao</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entries as $entry)
                    <tr wire:key="{{ $entry->id }}">
                        <td>{{ $entry->id }}</td>
                        <td>{{ $entry->description }}</td>
                        <td>{{ $entry->amount }}</td>
                        <td>
                            <button 
                                type="button"
                                wire:click="deleteExtract({{$entry->id}})"
                                wire:confirm="Deseja realmente excluir?"
                            >Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <h2>Despesas</h2>
    <h2>Despesas por categoria</h2>
    <h2>Gráfico</h2>
</div>
