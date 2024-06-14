<div>
    <h1>Minhas contas</h1>
    <form wire:submit="create()">
        <label>
            <span>Description</span>
            <input wire:model="description" type="text" required autofocus>
            @error('description') <em> {{ $message }} </em> @enderror
        </label>
        <button type="submit">Criar</button>
    </form>
    <br>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Codigo</th>
                <th>Description</th>
                <th>Orcamentos</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accounts as $account)
                <tr wire:key="{{ $account->id }}">
                    <td>{{ $account->id }}</td>
                    <td>{{ $account->cod }}</td>
                    <td>{{ $account->description }}</td>
                    <td>
                        <a wire:navigate href="/accounts/{{$account->id}}/budgets">Orcamentos</a>
                    </td>
                    <td>
                        <button 
                            type="button"
                            wire:click="delete({{$account->id}})"
                            wire:confirm="Deseja realmente excluir?"
                        >Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
