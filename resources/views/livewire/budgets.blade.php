<div>
    <h1>Meus orcamentos</h1>
    <form wire:submit="create()">
        <label>
            <span>Para qual mes deseja criar um orcamento?</span>
            <input wire:model="reference" type="date" required autofocus>
            @error('reference') <em> {{ $message }} </em> @enderror
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
                <th>Referencia</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr wire:key="{{ $row->id }}">
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->cod }}</td>
                    <td>{{ $row->reference }}</td>
                    <td>
                        <button 
                            type="button"
                            wire:click="delete({{$row->id}})"
                            wire:confirm="Deseja realmente excluir?"
                        >Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
