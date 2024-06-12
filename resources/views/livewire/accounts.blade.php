<div>
    <h1>Minhas contas</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accounts as $account)
                <tr>
                    <td>{{ $account->id }}</td>
                    <td>{{ $account->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
