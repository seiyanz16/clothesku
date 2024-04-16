@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Admin Profile</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="" method="post" id="changeProfileForm" name="changeProfileForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input value="{{$admin->name}}" type="text" name="name" id="name" class="form-control"
                                        placeholder="Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input value="{{$admin->email}}" type="email" name="email" id="email" class="form-control"
                                        placeholder="Email">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="phone">Phone</label>
                                    <input value="{{$admin->phone}}" type="tel" name="phone" id="phone" class="form-control"
                                        placeholder="Phone">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@push('scripts')
    <script>
        $('#changeProfileForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{route('admin.updateProfile')}}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        $('#name').removeClass('is-invalid').siblings('p').html('')
                            .removeClass(
                                'invalid-feedback');
                        $('#email').removeClass('is-invalid').siblings('p').html('')
                            .removeClass(
                                'invalid-feedback');

                        window.location.href = '{{ route('admin.profile') }}';
                    } else {
                        var errors = response.errors;
                        if (errors.name) {
                            $('#name').addClass('is-invalid').siblings('p').html(errors
                                .name).addClass(
                                'invalid-feedback');
                        } else {
                            $('#name').removeClass('is-invalid').siblings('p').html('')
                                .removeClass(
                                    'invalid-feedback');
                        }

                        if (errors.email) {
                            $('#email').addClass('is-invalid').siblings('p').html(errors
                                    .email)
                                .addClass('invalid-feedback');
                        } else {
                            $('#email').removeClass('is-invalid').siblings('p').html('')
                                .removeClass(
                                    'invalid-feedback');
                        }
                    }
                }
            })
        })
    </script>
@endpush
