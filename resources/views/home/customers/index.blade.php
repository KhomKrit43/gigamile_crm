@extends('../layout')

@section('title', 'Customers')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">
                            Customers
                        </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('customers.index') }}">
                                        Customers
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        {{-- Btn Add --}}
                        <div class="d-flex m-3">
                            <a href="{{ route('customers.create') }}" class="btn btn-primary">
                                Add Customer
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Address</th>
                                            <th scope="col" style="width: 125px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($customers->isEmpty())
                                            <tr>
                                                <td colspan="5" class="text-center">No customers found.</td>
                                            </tr>
                                        @else
                                            @foreach ($customers as $customer)
                                                <tr id="customer_{{ $customer->id }}">
                                                    <td>{{ $customer->name }}</td>
                                                    <td>{{ $customer->email }}</td>
                                                    <td>{{ $customer->phone }}</td>
                                                    <td>
                                                        {{--  show only first 20 characters if address has more than 20 characters, add "..." --}}
                                                        {{ Str::limit($customer->address, 20, '...') }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('customers.edit', $customer->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            Edit
                                                        </a>
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="deleteItem({{ $customer->id }})">
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                {{ $customers->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function deleteItem(id) {
            console.log(id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5e72e4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var is_url = "{{ route('customers.destroy', ':id') }}";
                    $.ajax({
                        url: is_url.replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: $("input[name=_token]").val()
                        },
                        success: function(response) {
                            // if close popup reload page
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled!',
                        'Customer not deleted.',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection

@section('scripts')

@endsection
