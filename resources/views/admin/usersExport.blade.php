<table>
    <thead>
        <tr>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>EMAIL</th>
            <th>ORGANIZATION CODE</th>
            <th>STATUS</th>
            <th>CLASSESS</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->fname }}</td>
            <td>{{ $user->lname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->org_code }}</td>
            <td>{{ $user->status }}</td>
            <td>
                @foreach($user->categories as $cat)
                {{ $cat->title.', ' }}
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
