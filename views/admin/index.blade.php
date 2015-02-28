@include('meta')
@include('header')

<div class="row">
    <div class="col-md-12">
        <h3>Warnings</h3>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped">
            <thead>
                <th>ID</th>
                <th>Rule</th>
                <th>Warner</th>
                <th>Offender</th>
                <th>Post</th>
                <th>Points</th>
                <th>Warned</th>
            </thead>
            <tbody>
                @foreach ($warnings as $warning)
                <tr>
                    <td>{{ $warning->getId() }}</td>
                    <td>{{ $warning->getRule()->getRule() }}</td>
                    <td>
                        <a href="{{ url('/admin/users/manage/' . $warning->getAuthor()->getId()) }}">
                            {{ $warning->getAuthor()->getUsername() }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ url('/admin/users/manage/' . $warning->getOffender()->getId()) }}">
                            {{ $warning->getOffender()->getUsername() }}
                        </a>
                    </td>
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

@include('footer')
