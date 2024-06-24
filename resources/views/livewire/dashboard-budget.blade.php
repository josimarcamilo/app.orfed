<div>
    <h1>Dashboard Budget {{ $budget->id }}</h1>
    <h2>Saldo: {{ $balance }}</h2>
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
                    <th>Valor gasto</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr wire:key="{{ $category->id }}">
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->cod }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->real ?? '0,00' }}</td>
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

    <h2>Importar extrato</h2>
    <div>
        <form wire:submit="importExtract()">
            <label for="bank">Instituição financeira:</label>

            <select name="bank" id="bank">
                <option value="nubank">Nubank</option>
            </select>
            <label>
                <span>Selecione um extrato .csv</span>
                <input wire:model="extractFile" type="file" accept=".csv" required>
                @error('extractFile') <em> {{ $message }} </em> @enderror
            </label>
            <button type="submit">Criar</button>
        </form>
    </div>


    <h2>Receitas | {{ $budget->entries()->sum('amount') }}</h2>
    <div>
        <form wire:submit="createEntry()">
            <label>
                <span>Descricao</span>
                <input wire:model="entryDescription" type="text" required>
                @error('entryDescription') <em> {{ $message }} </em> @enderror
            </label>
            <label>
                <span>Valor em centavos</span>
                <input wire:model="entryAmount" type="text" required>
                @error('entryAmount') <em> {{ $message }} </em> @enderror
            </label>
            <button type="submit">Criar</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Data</th>
                    <th>Descricao</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entries as $entry)
                    <tr wire:key="{{ $entry->id }}" x-data="{ editDescription: false, editAmount: false, model: {{$entry}}, update() {$wire.updateExtract(this.model.id, this.model); this.editDescription = false; this.editAmount = false;} }">
                        <td>{{ $entry->id }}</td>
                        <td>{{ $entry->date?->format('d/m/Y') }}</td>
                        <td x-show="!editDescription" x-on:click="editDescription = !editDescription" x-text="model.description"></td>
                        <td x-show="editDescription"><input @keydown.enter="update()" @click.outside="update()" x-model="model.description" style="width: 100%;" type="text" x-text="model.description"></td>
                        <td x-show="!editAmount" x-on:click="editAmount = !editAmount" x-text="model.amount"></td>
                        <td x-show="editAmount"><input @keydown.enter="update()" @click.outside="update()" x-model="model.amount" type="text" x-text="model.amount"></td>
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

    <h2>Despesas | {{ $budget->exits()->sum('amount') }}</h2>
    <div>
        {{-- <form wire:submit="createEntry()">
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
        </form> --}}
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody x-data="{ categories: {{$categories}}}">
                @foreach ($exits as $entry)
                    <tr wire:key="{{ $entry->id }}" x-data="{ editDescription: false, editAmount: false, model: {{$entry}}, update() {$wire.updateExtract(this.model.id, this.model); this.editDescription = false; this.editAmount = false;} }">
                        <td>{{ $entry->id }}</td>
                        <td>{{ $entry->date?->format('d/m/Y') }}</td>
                        <td x-show="!editDescription" x-on:click="editDescription = !editDescription" x-text="model.description"></td>
                        <td x-show="editDescription"><input @keydown.enter="update()" @click.outside="update()" x-model="model.description" style="width: 100%;" type="text" x-text="model.description"></td>
                        <td>
                            <select x-model="model.category_id" x-on:change="update()">
                                <option>selecione</option>
                                <template x-for="category in categories" :key="category.id">
                                    <option :selected="category.id == model.category_id" :value="category.id" x-text="category.description"></option>
                                </template>
                            </select>
                        </td>
                        <td x-show="!editAmount" x-on:click="editAmount = !editAmount" x-text="model.amount"></td>
                        <td x-show="editAmount"><input @keydown.enter="update()" @click.outside="update()" x-model="model.amount" type="text" x-text="model.amount"></td>
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
    <h2>Despesas por categoria</h2>
    <h2>Gráfico</h2>
</div>
