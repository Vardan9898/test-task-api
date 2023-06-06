@extends('app.layout')

@section('content')
    <div class="flex flex-col ml-20 justify-center mt-4">
        <div class="flex items-center mb-4">
            <label for="status-filter" class="mr-2">Status:</label>
            <select id="status-filter" class="px-2 py-1 border border-gray-300 rounded">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="blocked">Blocked</option>
                <option value="all">All</option>
            </select>
            <label for="date-filter" class="ml-2">Created date</label>
            <input type="date" id="date-filter" class="px-2 py-1 border border-gray-300 rounded" />
            <button id="apply-filter-btn" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded hover:bg-blue-600">Apply
                Filter
            </button>
        </div>

        <table class="bg-white mx-auto w-full border border-gray-300 divide-y divide-gray-200">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-100 text-left text-sm font-medium text-gray-700">ID</th>
                <th class="px-6 py-3 bg-gray-100 text-left text-sm font-medium text-gray-700">Name</th>
                <th class="px-6 py-3 bg-gray-100 text-left text-sm font-medium text-gray-700">Email</th>
                <th class="px-6 py-3 bg-gray-100 text-left text-sm font-medium text-gray-700">Status</th>
                <th class="px-6 py-3 bg-gray-100 text-left text-sm font-medium text-gray-700">Created</th>
            </tr>
            </thead>
            <tbody id="table-body">
            <!-- Table rows will be dynamically added here -->
            </tbody>
        </table>
    </div>

    <script>
      $(document).ready(function () {
        $('#apply-filter-btn').on('click', function () {
          applyFilter();
        });

        function fetchData () {
          $.ajax({
            url: '{{ route('users.index') }}',
            type: 'GET',
            dataType: 'json',
            headers: {
              'Authorization': 'Bearer ' + '{{ $token }}'
            },
            success: function (response) {
              var tableBody = $('#table-body');
              response.users.forEach(function (user) {
                var row = $('<tr>');
                var idCell = $('<td>').text(user.id);
                var nameCell = $('<td>').text(user.name);
                var emailCell = $('<td>').text(user.email);
                var statusCell = $('<td>').text(user.status);
                var createdCell = $('<td>').text(new Date(user.created_at).toLocaleDateString());

                row.append(idCell);
                row.append(nameCell);
                row.append(emailCell);
                row.append(statusCell);
                row.append(createdCell);

                tableBody.append(row);
              });
            },
            error: function (error) {
              // Handle the error
              console.log(error);
            }
          });
        }

        fetchData();

        function applyFilter () {
          var status = $('#status-filter').val();
          var created = $('#date-filter').val();

          // Construct the filter object
          var filters = {
            status: status,
            created: created,
          };

          $.ajax({
            url: '{{ route('users.index') }}',
            type: 'GET',
            dataType: 'json',
            data: {
              filters: filters
            },
            headers: {
              'Authorization': 'Bearer ' + '{{ $token }}'
            },
            success: function (response) {
              var tableBody = $('#table-body');
              tableBody.empty();

              response.users.forEach(function (user) {
                var row = $('<tr>');
                var idCell = $('<td>').text(user.id);
                var nameCell = $('<td>').text(user.name);
                var emailCell = $('<td>').text(user.email);
                var statusCell = $('<td>').text(user.status);
                var createdCell = $('<td>').text(new Date(user.created_at).toLocaleDateString());

                row.append(idCell);
                row.append(nameCell);
                row.append(emailCell);
                row.append(statusCell);
                row.append(createdCell);

                tableBody.append(row);
              });
            },
            error: function (error) {
              // Handle the error
              console.log(error);
            }
          });
        }
      });
    </script>
@endsection