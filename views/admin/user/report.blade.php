<div class="row">
    <div class="col-md-12">
        <h3>{{ $points > 0 ? $points : 0 }} Points</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h4>History</h4>
        <table class="table table-bordered">
            <thead>
                <th>ID</th>
                <th>Rule</th>
                <th>Warner</th>
                <th>Post</th>
                <th>Points</th>
                <th>Warned</th>
            </thead>
            <tbody>
                @foreach ($warnings as $warning)
                <tr>
                    <td>{{ $warning->getId() }}</td>
                    <td>{{ $warning->getRule()->getRule() }}</td>
                    <td>{{ $warning->getAuthor()->getUsername() }}</td>
                    <td>
                        <a href="{{ $warning->getPost()->getUrl() }}">
                            {{ $warning->getPost()->getUrl() }}
                        </a>
                    </td>
                    <td>{{ $warning->getPoints() }}</td>
                    <td>{{ $warning->getCreatedAt() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
