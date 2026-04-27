<table border="1">
    <thead style="background-color: #f2f2f2;">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>NIM</th>
            <th>Jenis Pendaftaran</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pendaftar as $index => $p)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->email }}</td>
            <td>{{ $p->nim }}</td>
            <td>{{ ucfirst($p->jenis_pendaftaran) }}</td>
            <td>{{ ucfirst($p->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>